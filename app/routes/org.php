<?php
Route::group(array('before' => 'org'), function()
{
    Route::get('/', function()
    {
        return View::make('org.home', array(
            'content' => Page::where('name', 'home')->firstOrFail()->content
        ));
    });

    Route::controller('account', 'AccountController');

});

