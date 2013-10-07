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

    public function postNew()
    {
        if ( ! $season = Season::create(Input::get()))
        {
            return Redirect::to('/admin/seasons/new')
                ->with('error', Lang::get('alerts.error'))
                ->withInput(Input::except('_token'));
        }

        return Redirect::to('/admin/seasons/edit/'.$season->id)
            ->with('message', 'Your season has been saved');
    }

    public function getEdit($id)
    {
        $season = Season::findOrFail($id);

        return View::make('admin.seasons.form', array(
            'season' => $season,
            'programs' => Program::get()
        ));
    }

    public function postProgram()
    {
        $result = 'error';
        $id = null;

        $program = new Program(Input::only('name','gender'));

        if ($program->save())
        {
            $result = 'success';
            $id = $program->id;
        }

        return Response::json(array('result' => $result, 'id' => $id));
    }
}
