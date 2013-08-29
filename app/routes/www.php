<?php

Route::get('/', function()
{
    return View::make('www.home');
});

Route::get('legal', function()
{
    return View::make('www.legal');
});
