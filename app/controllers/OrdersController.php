<?php
class OrdersController extends BaseController
{

    public function getIndex()
    {
        $orders = Order::with('payment')->orderBy('updated_at', 'desc')->get();

        return View::make('admin.orders.index', array('orders' => $orders));
    }
}
