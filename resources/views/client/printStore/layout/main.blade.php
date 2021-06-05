<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title> @if(empty($title)) Title chưa được set @else {{ $title }} @endif </title>
  @if (!empty($listImage))
    <meta property="og:image" content="{{ asset('/storage/images/print-store/product/'. $idProduct .'/'. $listImage[0]->idImage .'.png') }}">
    <link rel="shortcut icon" href="{{ asset('/storage/images/print-store/product/'. $idProduct .'/'. $listImage[0]->idImage .'.png') }}" type="image/x-icon">
  @else
    <meta property="og:image" content="{{ asset('/images/logo.jpg') }}">
    <link rel="shortcut icon" href="{{ asset('/images/logo.jpg') }}" type="image/x-icon">
  @endif

  <link rel="icon" href="{{ asset('/images/logo.jpg') }}" type="image/icon type">

  @include('client.printStore.layout.head')
</head>

<body>

<div id="root">
  @include('client.printStore.layout.nav')

  @yield('carousel')

  @yield('content')

  @include('client.layouts.footer')

</div>

<div id="loader-wrapper" class="show">
  <div id="loader"></div>
</div>

@include('client.printStore.layout.script')
</body>

</html>
