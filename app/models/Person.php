<?php

class Person extends Eloquent
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id', 'master_id');

    public function user()
    {
        return $this->hasOne('User');
    }

    public function orders()
    {
        return $this->hasMany('Order');
    }

    public function payments()
    {
        return $this->hasMany('Payment');
    }

    public static function create(array $values)
    {
        $person = parent::create($values);

        if ( ! array_get($values, 'master_id'))
        {
            try
            {
                $person->master_id = $person->id;

                $person->save();
            }
            catch (\Exception $e)
            {
                $person->forceDelete();

                throw $e;
            }
        }

        return $person;

    }

    public static function insertGetId(array $values, $sequence = null)
    {
        $person = static::create($values);

        return $person->id;
    }

    public function isMaster()
    {
        return $this->id === $this->master_id;
    }
}
