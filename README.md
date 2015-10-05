# Users
User manager with roles (single and multiple)

## Install
```bash
composer require intothesource/users
```

This package also uses the [Entrance package](https://github.com/intothesource/entrance), for more information about that package go to that repositorie.

## After install

#### ServiceProvider
Add the following line to "config/app.php"

at "providers":

```bash
IntoTheSource\Users\UsersServiceProvider::class,
Illuminate\Html\HtmlServiceProvider::class,
```

And at "aliases":

```bash
'Form'      => Illuminate\Html\FormFacade::class,
'HTML'      => Illuminate\Html\HtmlFacade::class,
```

#### Creating the files
Run the following command:

```bash
php artisan vendor:publish
```

#### Migration

Run the command: 
```bash
php artisan migrate
```

#### Middleware

Add the following lines to the '$routeMiddleware' array in the file 'App/Http/Kernel.php'

```bash
'sourceOrAdmin' => \IntoTheSource\Users\Http\Middleware\IfSourceOrAdmin::class,
```

If you go to the user index you first need a role that sign in the [config file](https://github.com/intothesource/users/blob/master/src/config/intothesource.usermanager.php) at 'Middleware'

#### Database Seed

If you want to at basic roles, do the following thinks.<br>
@note: if you want to use this be sure that you also included the database seeding of the [Entrance package](https://github.com/intothesource/entrance)

Add to your 'DatabaseSeeder.php' file in the 'database/seeds' folder
```bash
$this->call(RoleTableSeeder::class);
$this->call(RoleUserTableSeeder::class);
```
After that run the next command:
```bash
php artisan db:seed
```

####### Or
if you don't want to do that run the following commands:
```bash
first: php artisan db:seed --class=RoleTableSeeder
second: php artisan db:seed --class=RoleUserTableSeeder
```
