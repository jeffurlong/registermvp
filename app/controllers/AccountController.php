<?php

class AccountController extends BaseController
{
    /**
     * Get the Signup view
     *
     * @return View
     */
    public function getSignup()
    {
        return View::make('org.signup');
    }

    /**
     * Creates a new user and person record and sends welcome email
     * @param  array    $data           Person data
     * @param  int      $role           Role id
     * @param  string   $email_template Email template
     * @return bool
     */
    public function createAccount($data, $role, $email_template)
    {
        if ($this->userExists($data['email']))
        {
            return false;
        }

        $password = (isset($data['password'])) ? $data['password'] : Str::random();

        try
        {
            $person = $this->createPerson(Input::except(array('password', 'confirm_password', '_token')));

            $user = $this->createUser($person, $password, $role);

            $this->sendCreateEmail($person, $password, $email_template);
        }
        catch(\Exception $e)
        {
            if (isset($person))
            {
                $person->forceDelete();
            }

            if (isset($user))
            {
                $user->forceDelete();
            }

            throw $e;
        }

        return true;
    }

    /**
     * Create the new User and Person records, send the welcome email, and log
     * the new user in
     *
     * @return Redirect
     */
    public function postSignup()
    {
        if ( ! $this->createAccount(Input::get(), Config::get('auth.role.member'), Config::get('auth.signup.email')))
        {
            return Redirect::to('/account/signup')
                    ->with('error', true)
                    ->with('reason', 'alerts.signup_duplicate');
        }

        Auth::login($user);

        return Redirect::to('member');
    }

    /**
     * Get the login view
     *
     * @return View
     */
    public function getLogin()
    {
        return View::make('org.login', array('email' => Input::old('email')));
    }

    /**
     * Verify login is valid and rediret to appropriate app
     *
     * @return Redirect
     */
    public function postLogin()
    {
        if ( ! $this->loginIsValid())
        {
            return  Redirect::to('account/login')
                        ->with('error', true)
                        ->with('reason', 'alerts.invalid_login')
                        ->withInput();
        }

        if ($this->userIsAdmin())
        {
            return Redirect::intended('admin');
        }

        return Redirect::intended('member');
    }

    /**
     * Get forgot password view
     *
     * @return Redirect|View
     */
    public function getForgot()
    {
        if ( Session::has('success'))
        {
            return Redirect::to('account/logout')->with('reset', true);
        }

        return View::make('org.forgot');
    }

    /**
     * Send password reminder
     *
     * @return Redirect
     */
    public function postForgot()
    {
        return Password::remind(
            array('username' => Input::get('email')),
            function ($message, $user)
            {
                $message->subject('Password reminder');
            }
        );
    }

    /**
     * Get the reset password view
     *
     * @param  string $token
     * @return View
     */
    public function getReset($token)
    {
        return View::make('org.reset')->with('token', $token);
    }

    /**
     * Reset user's password and log them in to appropriate app
     *
     * @param  string $token
     * @return Redirect
     */
    public function postReset($token)
    {
        $data = array('username' => Input::get('email'));

        return Password::reset($data, function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();

            Auth::login($user);

            if ($this->userIsAdmin())
            {
                return Redirect::to('admin');
            }

            return Redirect::to('member');
        });
    }

    /**
     * Log user out
     *
     * @return View
     */
    public function getLogout()
    {
        Auth::logout();

        return View::make('org.logout');
    }

    /**
     * Determine if a user record already exists for given email
     *
     * @param  string $email
     * @return bool
     */
    protected function userExists($email)
    {
        return (User::where('username', $email)->first() !== null);
    }

    /**
     * Determine if user credentials are valid
     *
     * @return bool
     */
    protected function loginIsValid()
    {
        $data = array('username' => Input::get('email'), 'password' => Input::get('password'));

        return Auth::attempt($data);
    }

    /**
     * Determine if user is an admin
     *
     * @return bool
     */
    protected function userIsAdmin()
    {
        return Auth::user()->role_id >= 50;
    }

    /**
     * Create a new Person record
     *
     * @param  array $data
     * @return Person
     */
    protected function createPerson($data)
    {
        return Person::create($data);
    }

    /**
     * Create a new User record
     *
     * @param   Person  $person
     * @param   string  $password
     * @param   int     $role     Role id
     * @return  User
     */
    protected function createUser($person, $password, $role)
    {
        $user = new User;

        $user->username = $person->email;
        $user->password = Hash::make($password);
        $user->person_id = $person->id;
        $user->role_id = $role;

        $user->save();

        return $user;
    }

    /**
     * Send signup email
     *
     * @param  Person $person
     * @return void
     */
    protected function sendCreateEmail($person, $password, $template)
    {
        $params = array(
            'org' => Session::get('org.name'),
            'url' => Request::server('SERVER_NAME'),
            'email' => $person->email,
            'password' => $password
        );

        Mail::send(
            Config::get($template),
            $params,
            function($m)  use ($person, $params)
            {
                $m->to($person->email, $person->first_name.' '.$person->last_name)
                    ->subject($params['org'].' Account');
            }
        );
    }


}
