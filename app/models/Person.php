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

    public function fill(array $data)
    {
        if(isset($data['dob']))
        {
            if (empty($data['dob']))
            {
                unset($data['dob']);
            }
            else
            {
                $data['dob'] = date_formatted($data['dob'], 'Y-m-d');
            }
        }

        return parent::fill($data);
    }

    public static function create(array $values)
    {
        $person = parent::create($values);

        // master_id are not mass assignable is not mass assignable
        try
        {
            // If there is no master_id in values, then this is a master record
            $person->master_id = array_get($values, 'master_id') ?: $person->id;

            $person->save();
        }
        catch (\Exception $e)
        {
            $person->forceDelete();

            throw $e;
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
