# Users
User manager with roles (single and multiple)

## Install
'composer require intothesource/users'

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
First remove the following files:
- the 'User.php' file from 'App/' folder
- the user table migration from 'database/migrations/' => '2014_10_12_000000_create_users_table.php'

After you removed all the files, that run the following command:

```bash
php artisan vendor:publish
```

#### Migration

Run the command: 'php artisan migrate'