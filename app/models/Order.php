<?php

class Order extends Eloquent {

    public function person()
    {
        return $this->belongsTo('person');
    }

    public function payments()
    {
        return $this->hasMany('Payment');
    }

}
