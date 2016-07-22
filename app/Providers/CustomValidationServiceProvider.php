<?php namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class CustomValidationServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{

		$this->app['validator']->extend('my_decimal', function ($attribute, $value, $parameters) {
			return preg_match($parameters, $value);
		}, 'Invalid decimal value');

		$this->app['validator']->extend('passcheck', function ($attribute, $value, $parameters) {
			return Hash::check($value, Auth::user()->getAuthPassword());
		}, 'Old Password is incorrect.');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{

	}

}
