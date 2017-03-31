<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/users">Users</a></li>
        <li><a href="/parties">Parties</a></li>
        <li><a href="/referenda">Referenda</a></li>
        <li><a href="/groups">Groups</a></li>
        <li><a href="/elections">Elections</a></li>
        <li><a href="/settings">Settings</a></li>
        <li><a href="/login">Login</a></li>
    </ul>
</nav>
<h1>@yield('title')</h1>
@yield('content')
@yield('footer')
</body>
</html>