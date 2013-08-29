<?php

class AccountController extends BaseController
{
    /**
     * Get the Signup view
     * @return View
     */
    public function getSignup()
    {
        return View::make('org.signup');
    }

    /**
     * [postSignup description]
     * @return [type] [description]
     */
    public function postSignup()
    {
        if ($this->userExists(Input::get('email')))
        {
            return Redirect::to('/account/signup')
                    ->with('error', true)
                    ->with('reason', 'alerts.signup_duplicate');
        }

        try
        {
            $password = Input::get('password');

            $data = Input::except(array('password', 'confirm_password', '_token'));

            $person = Person::create($data);

            $user = new User;
            $user->username = $person->email;
            $user->password = Hash::make($password);
            $user->person_id = $person->id;
            $user->role_id = Config::get('auth.role.member');
            $user->save();

            $params = array(
                'org' => Session::get('org.name'),
                'url' => Request::server('SERVER_NAME'),
                'email' => $person->email,
            );

            Mail::send(Config::get('auth.signup.email'), $params, function($m)  use ($person, $params)
            {
                $m->to($person->email, $person->first_name.' '.$person->last_name)
                    ->subject($params['org'].' Account');
            });
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

        Auth::login($user);

        return Redirect::to('member');
    }

    public function getLogin()
    {
        return View::make('org.login', array('email' => Input::old('email')));
    }

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

    public function getForgot()
    {
        if ( Session::has('success'))
        {
            return Redirect::to('account/logout')->with('reset', true);
        }

        return View::make('org.forgot');
    }

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

    public function getReset($token)
    {
        return View::make('org.reset')->with('token', $token);
    }

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

    public function getLogout()
    {
        Auth::logout();

        return View::make('org.logout');
    }

    protected function userExists($email)
    {
        return (User::where('username', $email)->first() !== null);
    }

    protected function loginIsValid()
    {
        $data = array('username' => Input::get('email'), 'password' => Input::get('password'));

        return Auth::attempt($data);
    }

    protected function userIsAdmin()
    {
        return Auth::user()->role_id >= 50;
    }

    public static function signup($data, $user, $person)
    {
        if (User::where('username', $data['email'])->first() !== null)
        {
            return false;
        }
    }

}
