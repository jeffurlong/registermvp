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

    public function update($id)
    {
        $data = Input::only('name', 'content');

        $result = (Page::find($id)->save($data)) ? 'success' : 'error';

        return Response::json(array('result' => $result));
    }
}
