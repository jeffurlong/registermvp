<?php

class Org
{
    public static function getSessionData()
    {
        return (array) DB::table('organization')
            ->select(
                'id',
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
                'payment_processor'
            )
            ->first()
    }
}
