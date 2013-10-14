<?php

class Division extends Eloquent
{
    protected $guarded = array('id');

    protected $dateFields = array('start_dt', 'end_dt', 'reg_start_dt', 'reg_end_dt');

    public function season()
    {
        return $this->belongsTo('Season');
    }

    public function fill(array $data)
    {
        foreach($data as $k => $v)
        {
            if(in_array($k, $this->dateFields))
            {
                $data[$k] = date_formatted($v, 'Y-m-d');
            }
        }
        return parent::fill($data);
    }

}
