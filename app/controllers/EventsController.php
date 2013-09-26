<?php
class EventsController extends BaseController
{

    public function getIndex()
    {
        return View::make('admin.events.index', array('events' => EventModel::get()));
    }

    public function getNew()
    {
        return View::make('admin.events.form', array('event' => new EventModel));
    }
}
