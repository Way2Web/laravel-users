<?php

namespace IntoTheSource\Users;

/**
 *
 * @author Gertjan Roke <gjroke@intothesource.com>
 */

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class UsersServiceProvider extends ServiceProvider
{
    /**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		$this->loadViewsFrom(realpath(__DIR__.'/views'), 'UMViews');
		$this->setupRoutes($this->app->router);
		/**
         * Add all the Models
         */
        $this->publishes([
            __DIR__.'/Models/app/Role.php' => app_path('Role.php')
        ], 'models');
        /**
         * Add all the config files
         */
        $this->publishes([
            __DIR__.'/config/source.usermanager.php' => config_path('source.usermanager.php')
        ], 'config');
        /**
         * Add all the request files
         */
        $this->publishes([
            __DIR__.'/Http/Requests' => app_path('/Http/Requests')
        ], 'requests');
        /**
         * Add all the style and script files
         */
        $this->publishes([
            __DIR__.'/assets/css/user-manager.css' => public_path('/assets/css/user-manager.css'),
            __DIR__.'/assets/js/user-manager.js' => public_path('/assets/js/user-manager.js')
        ], 'styles and scripts');
        /**
         * Add all the migrations
         */
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations')
        ], 'migrations');
        }
	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function setupRoutes(Router $router)
	{
		$router->group(['namespace' => 'IntoTheSource\Users\Http\Controllers'], function($router)
		{
			require __DIR__.'/Http/routes.php';
		});
	}
	public function register()
	{
		$this->registerUsermanager();
		config([
				'config/source.usermanager.php',
		]);
	}
	private function registerUsermanager()
	{
		$this->app->bind('usermanager',function($app){
			return new Usermanager($app);
		});
	}
}