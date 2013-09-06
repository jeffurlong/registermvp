<?php
class PagesController extends BaseController
{
    public function index()
    {
        $pages = Page::orderBy('updated_at', 'desc')->get();

        return View::make('admin.pages', array('pages' => $pages));
    }

    public function edit($id)
    {
        return View::make('admin.pages-edit', array('page' => Page::find($id)));
    }
}
