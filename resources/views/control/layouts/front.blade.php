<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta name="description" content="@yield('description')">
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

<style type="text/css">
  @media only screen and (max-width: 600px) {
    .note-video-clip {
      width: 100%;
      height: 100%;
    }
  }

  @media only screen and (min-width: 800px) {
    .note-video-clip {
      height: 360px;
    }
  }
</style>
</head>

<body style="background-color: #f8fafc;">
	<div class="container-fluid">
    <div class="row">
      <div class="col-md-7 offset-md-1 col-12">
        @yield('content1')
      </div>
      <div class="col-md-3 col-12">
        @yield('content2')
      </div>
    </div>
  </div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
</body>

</html>