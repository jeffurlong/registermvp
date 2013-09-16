<?php

class Org
{
    /**
     * Get all key value pairs in the table
     * @return array
     */
    public static function all()
    {
        $data = array();

        $rows = DB::table('org')->get();

        foreach($rows as $row)
        {
            $data[$row->k] = $row->v;
        }

        return $data;
    }

    public static function update($data)
    {
        foreach($data as $key => $val)
        {
            DB::table('org')->where('k', $key)->update(array('v' => $val));
        }
    }

    /**
     * Get the key value pairs necessary for the session data
     * @return array
     */
    public static function getSessionData()
    {
        $data = array();

        $rows = DB::table('org')
            ->select('*')
            ->whereRaw("k IN (
                'name',
                'theme',
                'slug',
                'payment_processor')")
            ->get();

        foreach($rows as $row)
        {
            $data[$row->k] = $row->v;
        }

        return $data;
    }

    public static function getAuthnetCredentials()
    {
        $data = array();

        $rows = DB::table('org')
            ->select('*')
            ->whereRaw("k IN ('authnet_api_login', 'authnet_transaction_key')")
            ->get();

        foreach($rows as $row)
        {
            $data[$row->k] = $row->v;
        }

        return $data;
    }

}
