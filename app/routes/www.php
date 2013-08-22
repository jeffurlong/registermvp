<?php

Route::get('/', function()
{
    return subdomain() ?  Redirect::to('org') : View::make('www.home');
});

Route::get('legal', function()
{
    return View::make('www.legal');
});
