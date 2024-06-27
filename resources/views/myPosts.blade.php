<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/posts.css') }}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="col-md-12 col-lg-12">
            @foreach($allPosts as $key => $post)
            <article class="post vt-post">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4">
                        <div class="post-type post-img">
                            @foreach($post->postUrl as $key=>$img)
                            <a><img src="{{ asset('storage/uploads/' . $img->url) }}" class="img-responsive" alt="image post"></a>
                            @endforeach

                        </div>
                        <div class="author-info author-info-2">
                            <ul class="list-inline">
                                <li>
                                    <div class="info">
                                        <p>Posted on:</p>
                                        @php
                                        $createdAt = $post['created_at'] ?? now();
                                        if (is_string($createdAt)) {
                                        $createdAt = \Carbon\Carbon::parse($createdAt);
                                        }
                                        @endphp
                                        <strong>{{ $createdAt->format('M d, Y') }}</strong>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-8">
                        <div class="caption">
                            <h3 class="md-heading"><a>{{ $post['title'] ?? 'The Heading Text Size Should Match'}}</a>
                            </h3>
                            <i style="cursor: pointer;" onclick="like(`{{ $post['id'] }}`)" id="likesIcon{{ $post['id'] }}" class="bi {{ auth()->user()->hasLiked($post['id']) ? 'bi-heart-fill' : 'bi-heart' }}" aria-hidden="true">
                                <input type="hidden" id="likes{{ $post['id'] }}" value="{{ route('likes', ['post_id' => $post['id']]) }}">
                                <input type="hidden" id="reqLikes{{ $post['id'] }}" value="{{ route('reqLike', ['post_id' => $post['id']]) }}">
                            </i>
                            <span id="likesCount{{ $post['id'] }}">{{ $postLikeCounts[$post['id']]}}</span>
                            <form action="{{ route('deletePosts', ['post_id' => $post['id']]) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach

            <div class="pagination-wrap">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</body>

</html>

<script src="{{ asset('js/like.js')}}"></script>