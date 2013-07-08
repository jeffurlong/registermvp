<?php

class AdminEventController extends BaseController
{
    public function getIndex()
    {
        Return Redirect::to('admin/event/list');
    }

    public function getList()
    {
        die('list');
    }

    public function getView($org, $id)
    {
        die('show '.$id);
    }

}
