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
		$this->setupRoutes($this->app->router);
		/**
         * Add all the Models
         */
        $this->publishes([
            __DIR__.'/Models/app' => app_path()
        ], 'models');
        /**
         * Add all the config files
         */
        $this->publishes([
            __DIR__.'/config' => config_path()
        ], 'config');
        /**
         * Add all the request files
         */
        $this->publishes([
            __DIR__.'/Http/Requests' => app_path('/Http/Requests')
        ], 'requests');
        /**
         * Add all the view files
         */
        $this->publishes([
            __DIR__.'/views' => base_path('/resources/views/intothesource/usersmanager')
        ], 'requests');
        /**
         * Add all the style and script files
         */
        $this->publishes([
            __DIR__.'/assets/css' => public_path('/assets/css'),
            __DIR__.'/assets/js' => public_path('/assets/js')
        ], 'styles and scripts');
        /**
         * Add all the migrations
         */
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations')
        ], 'migrations');
        /**
         * Add all the database seeds
         */
        $this->publishes([
            __DIR__.'/database/seeds' => database_path('seeds')
        ], 'seeds');
        /**
         * Add all the controllers
         */
        $this->publishes([
            __DIR__.'/Http/Controllers' => app_path('/Http/Controllers/Intothesource/Users')
        ], 'controllers');
    }
	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function setupRoutes(Router $router)
	{
        $routesFile = app_path().'/Http/routes.php';

        $currentRoutes = file_get_contents($routesFile);

        if(strstr($currentRoutes,"USERS ROUTES") == false){
            $token = '';
            $routes = "\n //USERS ROUTES \n//Prefix for the paths below.
            Route::group(['namespace' => 'App\Http\Controllers\IntoTheSource\Users', 'prefix' => config('intothesource.usermanager.prefix'), 'middleware' => config('intothesource.usermanager.middleware')], function() {
                /**
                 * All the routes for the users
                 */
                Route::get('users', ['as' => 'user.manager.index', 'uses' => 'UsersController@index']);
                Route::post('users', ['as' => 'user.manager.store', 'uses' => 'UsersController@store']);
                Route::get('users/create', ['as' => 'user.manager.create', 'uses' => 'UsersController@create']);
                Route::delete('users/{users}', ['as' => 'user.manager.destroy', 'uses' => 'UsersController@destroy']);
                Route::put('users/{users}', ['as' => 'user.manager.update', 'uses' => 'UsersController@update']);
                Route::patch('users/{users}', 'UsersController@update');
                Route::get('users/{users}/edit', ['as' => 'user.manager.edit', 'uses' => 'UsersController@edit']);
                Route::post('users/{users}/restore', ['as' => 'user.manager.restore', 'uses' => 'UsersController@restore']);
                Route::delete('users/{users}/permanently-destroy', ['as' => 'user.manager.permanentlyDestroy', 'uses' => 'UsersController@permanentlyDestroy']);

                /**
                 * All the routes for the roles
                 */
                Route::get('roles', ['as' => 'role.manager.index', 'uses' => 'RolesController@index']);
                Route::post('roles', ['as' => 'role.manager.store', 'uses' => 'RolesController@store']);
                Route::get('roles/create', ['as' => 'role.manager.create', 'uses' => 'RolesController@create']);
                //Route::get('roles/{roles}', ['as' => 'role.manager.show', 'uses' => 'RolesController@show']);
                Route::delete('roles/{roles}', ['as' => 'role.manager.destroy', 'uses' => 'RolesController@destroy']);
                Route::put('roles/{roles}', ['as' => 'role.manager.update', 'uses' => 'RolesController@update']);
                Route::patch('roles/{roles}', 'RolesController@update');
                Route::get('roles/{roles}/edit', ['as' => 'role.manager.edit', 'uses' => 'RolesController@edit']);
            });\n";


        file_put_contents($routesFile, $routes, FILE_APPEND | LOCK_EX);
        }
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