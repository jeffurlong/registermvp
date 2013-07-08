<?php

class MemberEventController extends BaseController
{
    public function getIndex()
    {
        Return Redirect::to('member/event/list');
    }

    public function getList()
    {
        die('list');
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
