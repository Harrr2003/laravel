<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Profile</title>
</head>

<body>
    @include('layouts.header')

    <div class="container height-100 d-flex justify-content-center align-items-center">

        <div class="card text-center">

            <div class="py-4 p-2">
                <div>
                    <img src="{{session('user')->avatar}}" class="rounded" width="100">
                </div>
                <div class="mt-3 d-flex flex-row justify-content-center">
                    <h5>{{session('user')->name}}</h5>
                    <span class="dots"><i class="fa fa-check"></i></span>
                </div>

                <div class="mt-3 d-flex align-items-center justify-content-center gap-2">
                    <div class="mb-0">
                        <button type="button" class="btn btn-primary" id="notificationsBtn">
                            <i class="bi bi-bell"></i>
                        </button>
                    </div>
                    <form action="{{ route('edit-profile') }}" method="POST" class="mb-0">
                        @csrf
                        <button class="btn btn-danger me-2">
                            Edit
                        </button>
                    </form>
                    <form action="{{ route('showAddPosts') }}" method="POST" class="mb-0">
                        @csrf
                        <button class="btn btn-danger me-2">
                            <i class="bi bi-cloud-arrow-up-fill"></i>
                        </button>
                    </form>
                    <form action="{{ route('logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button class="btn btn-danger me-2">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                    <button class="btn btn-danger me-2">
                        111
                    </button>
                    <button onclick="showFollowersForProfile()" class="btn btn-outline-secondary"><i class="fa fa-users"></i> {{ $followersCount }}</button>
                </div>
            </div>
            <div>
                <ul class="list-unstyled list">
                    <form id="post-form" action="{{route('myPosts')}}" method="POST">
                        @csrf
                        <li id="post-list-item">
                            <span class="font-weight-bold">Post</span>
                            <div>
                                <span  class="mr-1">{{ $postsCount }} </span>
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </li>
                    </form>
                    <li onclick="showFollowingForProfile()">
                        <span class="font-weight-bold">Following</span>
                        <div>
                            <span class="mr-1">{{ $followingCount }}</span>
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </li>
                </ul>
            </div>


        </div>


    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const listItem = document.querySelector('#post-list-item');
            const form = document.querySelector('#post-form');

            listItem.addEventListener('click', function() {
                form.submit();
            });
        });
    </script>
</body>

</html>

<script src="{{ asset('js/followersModal.js') }}"></script>
<script src="{{ asset('js/notifications.js') }}"></script>