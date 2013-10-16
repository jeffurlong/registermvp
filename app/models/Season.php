<?php

class Season extends Eloquent
{
    protected $guarded = array('id');

    public function divisions()
    {
        return $this->hasMany('Division');
    }


    public function questions()
    {
        return $this->hasMany('Question');
    }

    public function program()
    {
        return $this->belongsTo('Program');
    }
}
