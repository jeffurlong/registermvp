<?php
class OrdersController extends BaseController
{

    public function getIndex()
    {
        $customers = Person::with(array('user' => function($query)
        {
            $query->where('role_id', '=', 1);
        }))->get();

        return View::make('admin.customers.index', array('customers' => $customers));
    }
}
