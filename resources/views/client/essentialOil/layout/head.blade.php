@if (!empty($listImage))
  <meta property="og:image" content="{{ asset('/storage/images/essential-oil/product/'. $idProduct .'/'. $listImage[0]->idImage .'.png') }}">
  <link rel="shortcut icon" href="{{ asset('/storage/images/essential-oil/product/'. $idProduct .'/'. $listImage[0]->idImage .'.png') }}" type="image/x-icon">
@else
  <meta property="og:image" content="{{ asset('/images/logo.jpg') }}">
  <link rel="shortcut icon" href="{{ asset('/images/logo.jpg') }}" type="image/x-icon">
@endif

<link rel="icon" href="{{ asset('/images/logo.jpg') }}" type="image/icon type">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('css/client/dist/bootstrap/bootstrap.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('dist/fontawesome-free-5.15.1-web/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('css/client/dist/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('css/client/style.css') }}">


<script !src="">
  const IN_PRINT_STORE = false;
</script>
