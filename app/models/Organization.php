<?php

class Organization
{
    public static function getSessionData()
    {
        $result = array();

        $data = DB::table('org')
            ->select('*')
            ->whereRaw("k IN (
                'name',
                'email',
                'phone',
                'website',
                'theme',
                'template',
                'event_label',
                'event_series_label',
                'event_category_label',
                'event_menu_label',
                'payment_processor')")
            ->get();

        foreach($data as $row) {
            $result[$row->k] = $row->v;
        }

        return $result;
    }
}
