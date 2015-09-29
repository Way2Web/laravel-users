<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CMS | User Management</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('/assets/css/user-manager.css') }}">
        @yield('link')
        <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
        @yield('script')
    </body>
</html>