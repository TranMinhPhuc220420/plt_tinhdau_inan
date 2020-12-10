<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('client.layouts.head')
</head>

<body>

<div id="root">
    @include('client.layouts.nav')

    @yield('carousel')

    @yield('content')

    @include('client.layouts.footer')

</div>


@include('client.layouts.script')
</body>

</html>
