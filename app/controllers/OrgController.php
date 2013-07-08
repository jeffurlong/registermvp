<?php

class OrgController extends BaseController
{

    public function getIndex()
    {
        if ( ! Session::get('org.payment_processor')) {
            die('soon');
        }

        $template = Session::get('org.template') ?: 'org.home';

        $about = DB::table('org')->select('v')->whereK('description')->first()->v;

        return View::make($template, array(
            'about'     => nl2br($about),
            'events'    => array(),
            'has_hero'  => true
        ));
    }

    public function getSignin()
    {
        die('signin');
    }

    public function getSetup()
    {
        die('setup');
    }

    public function getSignup()
    {
        die('signup');
    }

    public function getForgot()
    {
        die('forgot');
    }


    public function getReset()
    {
        die('reset');
    }
}
