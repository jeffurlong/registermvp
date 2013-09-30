<?php
class CustomersController extends BaseController
{
    protected $account;

    public function __construct()
    {
        $this->account = new AccountController;
    }

    public function getIndex()
    {
        $customers = Person::join('users', 'users.person_id', '=', 'people.id')
            ->where('users.role_id', '=', 1)
            ->select('people.*')
            ->get();

        return View::make('admin.customers.index', array('customers' => $customers));
    }

    public function getShow($id)
    {
        $customer = Person::findOrFail($id);

        if ( ! $customer->isMaster())
        {
            App::abort(404);
        }

        return View::make('admin.customers.view', array(
            'customer' => $customer,
            'history' => null,
            'members' => Person::where('master_id', $customer->master_id)->orderBy('dob')->get(),
        ));
    }

    public function getNew()
    {
        $customer = new Person;

        if (Session::has('_old_input'))
        {
            $customer->fill(Session::get('_old_input'));
        }

        return View::make('admin.customers.form', array('customer' => $customer));
    }

    public function postNew()
    {
        if ( ! $this->account->create(
            Input::get(),
            Config::get('auth.role.member'),
            Config::get('auth.created.email')
        ))
        {
            return Redirect::to('/admin/customers/new')
                ->with('error', 'That account email already exists.')
                ->withInput(Input::except('_token'));
        }

        return Redirect::to('/admin/customers')
            ->with('message', 'Your customer has been saved');
    }
}
