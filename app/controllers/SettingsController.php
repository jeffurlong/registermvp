<?php
class SettingsController extends BaseController
{
    /**
     * Show general settings
     * @return View
     */
    public function getGeneral()
    {
        return View::make('admin.settings.general', array(
            'org' => Org::all(),
            'states' => form_states()
        ));
    }

    /**
     * Update general settings
     * @return RredirectResponse
     */
    public function putGeneral()
    {
        Org::update(Input::except('_method'));
        return Redirect::to('/admin/settings/general')
            ->with('message', 'Your settings have been saved');
    }

    /**
     * Show paymantes settings
     * @return View
     */
    public function getPayments()
    {
        $data = Org::getAuthnetCredentials();

        return View::make('admin.settings.payments', array(
            'client_id'                 => Config::get('payments.stripe.client_id'),
            'authnet_api_login'         => $data['authnet_api_login'],
            'authnet_transaction_key'   => $data['authnet_transaction_key'],
        ));
    }

    /**
     * Update payments settings
     * @return RedirectResponse
     */
    public function putPayments()
    {
        Org::update(Input::except('_method'));

        Session::put('org', Org::getSessionData());

        return Redirect::to('/admin/settings/payments')
            ->with('message', 'Your settings have been saved');
    }

    /**
     * Deactivate payment method
     * @return JsonResponse
     */
    public function deletePayments()
    {
        try
        {
            Org::update(Input::except('_method'));

            Session::put('org', Org::getSessionData());
        }
        catch (Exception $e)
        {
            return Response::json(array('result' => 'error'));
        }
        Session::flash('message', 'Your payment method has been deactivated');

        return Response::json(array('result' => 'success'));
    }

    /**
     * Show notifications settings
     * @return View
     */
    public function getNotifications()
    {
        return View::make('admin.settings.notifications', array(
            'subscriptions' => Subscription::where('type', 'order')->get()
        ));
    }

    /**
     * Create notification subscription
     * @return JsonResponse
     */
    public function postNotifications()
    {
        $result = 'error';

        $sub = new Subscription(Input::only('type','address'));

        if ($sub->save())
        {
            $result = 'success';

            Session::flash('message', 'Your notification has been saved');
        }

        return Response::json(array('result' => $result));
    }

    /**
     * Delete notification subscription
     * @param  int $id subscription id
     * @return JsonResponse
     */
    public function deleteNotifications($id)
    {
        $result = 'error';

        $sub = Subscription::find($id);

        if ($sub->delete())
        {
            $result = 'success';

            Session::flash('message', 'Your notification has been deleted');
        }

        return Response::json(array('result' => $result));
    }

    /**
     * Show account settings
     * @return View
     */
    public function getAccount()
    {

        $admins = Person::with(array('user' => function($query)
        {
            $query->where('role_id', '>=', Config::get('auth.role.admin'));
        }))->get();

        return View::make('admin.settings.account', array('admins' => $admins));
    }
}
