<?php
class PagesController extends BaseController
{

    public function index()
    {
        $pages = Page::orderBy('updated_at', 'desc')->get();

        return View::make('admin.pages.index', array('pages' => $pages));
    }

    public function create()
    {
        return View::make('admin.pages.form', array('page' => new Page));
    }

    public function store()
    {
        $result = 'error';

        $page = new Page(Input::only('name', 'content', 'visible'));

        $page = $this->addMetaData($page);

        if ($page->save())
        {
            $result = 'success';

            Session::flash('message', 'Your page has been saved');
        }

        return Response::json(array('result' => $result));
    }

    public function edit($id)
    {
        return View::make('admin.pages.form', array('page' => Page::findOrFail($id)));
    }

    public function update($id)
    {
        $page = Page::find(Input::get('page_id'))->fill(Input::only('name', 'content', 'visible'));

        $page = $this->addMetaData($page);

        $result = ($page->save()) ? 'success' : 'error';

        return Response::json(array('result' => $result));
    }

    public function destroy($id)
    {
        $result = 'error';

        $page = Page::findOrFail($id);

        if ($page->delete())
        {
            $result = 'success';

            Session::flash('message', 'Your page has been deleted');
        }

        return Response::json(array('result' => $result));
    }

    protected function addMetaData($page)
    {
        $page->slug = strtolower(str_replace(" ", "-", preg_replace("/[^A-Za-z0-9 ]/", '', $page->name)));

        $page->description = substr(strip_tags(str_replace ('>', '> ', $page->content)), 0, 147).'...';

        return $page;
    }
}
