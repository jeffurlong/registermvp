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
        return View::make('admin.customers.form', array('customer' => new Person));
    }

    public function postNew()
    {
        $customer = new Person(Input::get());
        $customer->save();
        echo '<pre>';
        var_dump($customer);
        die();
    }
}
