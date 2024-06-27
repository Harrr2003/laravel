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
    <nav class="navbar bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <button id="drawerBtn" class="btn btn-dark"><i class="bi bi-list"></i></button>
            <div class="d-flex" role="search">
                <form action="{{ route('search') }}" method="POST">
                    @csrf
                    <input id="searchUser" name="text" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>
    </nav>

    <div id="drawer" class="drawer">
        <a href="javascript:void(0)" class="closebtn" onclick="closeDrawer()">&times;</a>
        <a href="{{ route('profile') }}">Profile</a>
        <a href="{{ route('index') }}">Index</a>
    </div>

    <script>
        document.getElementById("drawerBtn").onclick = function() {
            document.getElementById("drawer").style.left = "0";
        };

        function closeDrawer() {
            document.getElementById("drawer").style.left = "-250px";
        }
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<script src="{{ asset('js/search.js') }}"></script>