<?php
class SeasonsController extends BaseController
{

    public function getIndex()
    {
        return View::make('admin.seasons.index', array(
            'seasons' => Season::get()
        ));
    }

    public function getNew()
    {
        return View::make('admin.seasons.form', array(
            'season' => new Season,
            'programs' => Program::get()
        ));
    }
}
