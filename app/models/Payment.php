<?php

class Payment extends Eloquent {

    public function order()
    {
        return $this->belongsTo('Order');
    }

    public function person()
    {
        return $this->belongsTo('Person');
    }

}
