<?php

Route::group(array('prefix' => 'member', 'before'=>'auth'), function()
{
    Route::get('/', function()
    {
        die('member index');
    });

});
