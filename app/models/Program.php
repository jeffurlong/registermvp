<?php

class Program extends Eloquent
{
    protected $guarded = array('id');

    public function seasons()
    {
        $this->hasMany('Seasons');
    }
}
