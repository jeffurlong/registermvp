<?php

class Order extends Eloquent {

    public function person()
    {
        return $this->belongsTo('person');
    }

}
