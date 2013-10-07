<?php

class Question extends Eloquent
{
    protected $guarded = array('id');

    public function season()
    {
        return $this->belongsTo('Season');
    }

}
