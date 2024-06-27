<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .chat-container {
            max-width: 600px;
            margin: auto;
        }

        .card-body {
            overflow-y: scroll;
        }

        .bg-body-tertiary {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    @include('layouts.header')
    <section>
        <div class="container py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">

                    <div class="card chat-container">
                        <div class="card-header d-flex justify-content-between align-items-center p-3" style="border-top: 4px solid #ffa900;">
                            <h5 class="mb-0">Chat messages</h5>
                            <div class="d-flex flex-row align-items-center">
                                <span class="badge bg-warning me-3">20</span>
                                <i class="fas fa-minus me-3 text-muted fa-xs"></i>
                                <i class="fas fa-comments me-3 text-muted fa-xs"></i>
                                <i class="fas fa-times text-muted fa-xs"></i>
                            </div>
                        </div>
                        <div class="card-body" style="position: relative; height: 400px">

                            @php
                            $messages = $chats ? DB::table('messages')->select('*')->where('chat_id', $chats->id)->get() : collect();
                            @endphp

                            @if($messages->isNotEmpty())
                            @foreach($messages as $message)
                            @if($message->sender_id == $sender_id)
                            <div class="d-flex justify-content-between">
                                <p class="small mb-1 text-muted">{{ \Carbon\Carbon::parse($message->created_at)->format('d M h:i a') }}</p>
                            </div>
                            <div class="d-flex flex-row justify-content-start mb-4 pt-1">
                                <img src="{{ asset('storage/' . $avatar) }}" alt="Avatar" style="width: 45px; height: 100%;">
                                <div>
                                    <p class="small p-2 ms-3 mb-3 rounded-3 bg-body-tertiary">{{ $message->text }}</p>
                                </div>
                            </div>
                            @else
                            <div class="d-flex justify-content-between">
                                <p class="small mb-1 text-muted">{{ \Carbon\Carbon::parse($message->created_at)->format('d M h:i a') }}</p>
                            </div>
                            <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                <img src="{{ asset('storage/' . $receiverAvatar) }}" alt="Avatar" style="width: 45px; height: 100%;">
                                <div>
                                    <p class="small p-2 me-3 mb-3 rounded-3 bg-body-tertiary">{{ $message->text }}</p>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endif

                        </div>
                        <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                            <form action="{{ route('sendMessages', ['id' => $chats->id]) }}" method="POST" style="width: 100%; display: flex;">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Type message" name="text" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-warning" type="submit" id="button-addon2">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>