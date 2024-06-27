<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="{{ asset('css/user-profile.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>

<body>
    @include('layouts.header')
    <div class="container height-100 d-flex justify-content-center align-items-center">

        <div class="card text-center">

            <div class="py-4 p-2">

                <div>
                    <img src="{{ asset($user_get->avatar) }}" class="rounded" width="100">
                </div>
                <div class="mt-3 d-flex flex-row justify-content-center">
                    <h5>{{ $user_get->name }}</h5>
                    <span class="dots"><i class="fa fa-check"></i></span>
                </div>

                <div class="mt-3 d-flex align-items-center justify-content-center">
                    <form method="GET" action="{{ route('request', ['id' => $user_get->id]) }}" class="mb-0">
                        <button class="btn btn-danger me-2">
                            @if(!$follow)
                            Follow
                            @elseif($follow->status == 1 && $my_id == $follow->sender_id)
                            Requested
                            @elseif($follow->status == 2 && $follow->sender_id == $my_id)
                            Following
                            @elseif($follow->status == 2 && $my_id == $follow->receiver_id)
                            Follow Back
                            @endif
                        </button>
                    </form>
                    <form action="{{ route('chats', ['id' => $user_get->id]) }}" method="GET" class="mb-0">
                        <button class="btn btn-danger me-2">
                            Messages
                        </button>
                    </form>
                    <button onclick="showFollowers(`{{ $user_get->id }}`)" class="btn btn-outline-secondary"><i class="fa fa-users"></i> {{$followersCount}} </button>
                </div>


            </div>

            <div>
                <ul class="list-unstyled list">
                    <form  id="post-form" action="{{route('userPosts',['id'=>$user_get->id])}}" method="POST">
                        @csrf
                        <li id="post-list-item">
                            <span class="font-weight-bold">Post</span>
                            <div>
                                <span class="mr-1">{{$postsCount}}</span>
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </li>
                    </form>
                    <li onclick="showFollowing(`{{ $user_get->id }}`)">
                        <span class="font-weight-bold">Following</span>
                        <div>
                            <span class="mr-1">{{$followingCount}}</span>
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