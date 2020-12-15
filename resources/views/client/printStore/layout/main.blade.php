<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> @if(empty($title)) Title chưa được set @else {{ $title }} @endif </title>

    @include('client.printStore.layout.head')
</head>

<body>

<div id="root">
    @include('client.printStore.layout.nav')

    @yield('carousel')

    @yield('content')

    @include('client.printStore.layout.footer')

</div>


@include('client.printStore.layout.script')
</body>

</html>
