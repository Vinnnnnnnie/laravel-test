<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Home Lab / Bikes</title>
</head>
<body>
<h2>List of all Bikes</h2>
<ul>
    @foreach($bikes as $bike)
        <li>
            <h3>{{ $bike['year'] }} {{ $bike['make'] }} {{ $bike['model'] }}</h3>
            <a href="bikes/{{ $bike['id'] }}">More</a>
        </li>
    @endforeach
</ul>
</body>
</html>
