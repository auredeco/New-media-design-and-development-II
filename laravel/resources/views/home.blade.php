<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <meta name='csrf-token' content='{{ csrf_token() }}'>
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!}
    </script>

</head>
<body>

<div id="app">
    {{--<p v-text="message"></p>--}}
    <navigation></navigation>
    <vuehead></vuehead>
    <transition name="slide">
        <router-view></router-view>
    </transition>
</div>

<script src="{{ URL::asset('js/vue.js') }}" ></script>
<script src="{{ URL::asset('js/main.js') }}" ></script>


</body>
</html>