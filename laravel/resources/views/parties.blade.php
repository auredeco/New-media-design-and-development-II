<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parties
    </title>
</head>
<body>
Parties
<ul>
    @foreach($parties as $item)
        <li><a href="/parties/{{$item->id}}">{{$item->name}}</a></li>
    @endforeach
</ul>
</body>
</html>