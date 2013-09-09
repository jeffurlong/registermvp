<?php
class PagesController extends BaseController
{

    public function index()
    {
        $pages = Page::orderBy('updated_at', 'desc')->get();

        foreach ($pages as $page)
        {
            $page->preview = substr(strip_tags(str_replace ('>', '> ', $page->content)), 0, 150).'...';
        }

        return View::make('admin.pages', array('pages' => $pages));
    }

    public function edit($id)
    {
        return View::make('admin.pages-edit', array('page' => Page::findOrFail($id)));
    }

    public function update($id)
    {
        $page = Page::find(Input::get('page_id'))->fill(Input::only('name', 'content'));

        $result = ($page->save()) ? 'success' : 'error';

        return Response::json(array('result' => $result));
    }
}
