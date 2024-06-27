<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Upload</title>
</head>

<body>
    <section class="container">
        <header>Upload</header>
        <form action="{{ route('add-post') }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control" type="file" id="formFile" name="files[]" multiple>
            </div>
            <div class="column">
                <div class="input-box">
                    <label>Title</label>
                    <input type="text" placeholder="Title..." required name="title" />
                    @error('title')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit">Upload</button>
        </form>
    </section>
</body>

</html>