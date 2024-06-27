<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('layouts.header')
    
    </div>
</body>

</html>

<script src="{{ asset('js/like.js')}}"></script>
<script src="{{ asset('js/save.js')}}"></script>
<script src="{{ asset('js/post.js')}}"></script>
<script src="{{ asset('js/search.js') }}"></script>