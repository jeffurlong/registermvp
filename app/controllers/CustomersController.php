<?php
class CustomersController extends BaseController
{

    public function getIndex()
    {
        $customers = Person::join('users', 'users.person_id', '=', 'people.id')
            ->where('users.role_id', '=', 1)
            ->get();

        return View::make('admin.customers.index', array('customers' => $customers));
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
        if ( ! AccountController::createAccount(
            Input::get(),
            Config::get('auth.role.member'),
            Config::get('auth.newcustomer.email')
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
