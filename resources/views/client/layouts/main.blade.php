<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> @if(empty($title)) Title chưa được set @else {{ $title }} @endif </title>
  <link rel="icon" href="{{ asset('/images/logo-eva-vn-normal.jpg') }}" type="image/icon type">

  @include('client.layouts.head')
</head>

<body>

<div id="root">
  @include('client.layouts.nav')

  @yield('carousel')

  @yield('content')

  @include('client.layouts.footer')

  <div id="loader-wrapper" class="show">
    <div id="loader"></div>
  </div>
@include('client.layouts.script')
</body>

</html>
