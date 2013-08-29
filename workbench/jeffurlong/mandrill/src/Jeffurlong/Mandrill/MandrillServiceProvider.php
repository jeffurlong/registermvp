<?php namespace Jeffurlong\Mandrill;

use Illuminate\Support\ServiceProvider;

class MandrillServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('jeffurlong/mandrill');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->app['mandrill'] = $this->app->share(function($app)
		{
		    $mandrill = new Mandrill($app['view']);

		    $mandrill->setLogger($app['log'])->setQueue($app['queue']);

			$mandrill->setContainer($app);

			$from = $app['config']['mail.from'];

			if (is_array($from) and isset($from['address'])) {
				$mandrill->alwaysFrom($from['address'], $from['name']);
			}

			$pretend = $app['config']->get('mail.pretend', false);

			$mandrill->pretend($pretend);

			return $mandrill;
		});

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('mandrill');
	}

}
