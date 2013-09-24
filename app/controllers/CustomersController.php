<?php
class CustomersController extends BaseController
{

    public function getIndex()
    {
        // $customers = Person::join('users', 'users.person_id', '=', 'people.id')
        //     ->join('orders', 'orders.person_id', '=', 'people.id')
        //     ->select('people.*', DB::raw('count(orders.id) as num_orders'))
        //     ->where('role_id', '>', 1)
        //     ->orderBy('last_name')
        //     ->orderBy('first_name')
        //     ->get();
        $customers = Person::join('users', function($join)
        {
            $join->on('users.person_id', '=', 'people.id');
        })
        ->where('users.role_id', '=', 60)
        ->get();


        // select('people.*', DB::raw('count(orders.id) as num_orders'))
        //     ->from('people INNER JOIN users ON (users.person_id = people.id AND users.role_id > 1)
        //         LEFT OUTER JOIN orders ON orders.person_id = people.id')
        //     ->where('role_id', '>', 1)
        //     ->orderBy('last_name')
        //     ->orderBy('first_name')
        //     ->get();
        // $customers = Person::with('user')->where('user.role_id', '>', 1)->get();

        return View::make('admin.customers.index', array('customers' => $customers));
    }
}
