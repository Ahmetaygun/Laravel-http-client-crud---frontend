<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Edit Post</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Edit Post</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <p>Error: {{ $errors->first() }}</p>
            </div>
        @endif
        <!-- kaydedildi mesajı -->
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if(isset($post['id']))
            <a href="{{ route('index') }}" class="btn btn-danger">BACK</a>

            <form action="{{ route('update', $post['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" value="{{ $post['name'] }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Mail:</label>
                    <input type="text" name="mail" value="{{ $post['mail'] }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="explanation" class="form-label">Explanation:</label>
                    <input type="text" name="explanation" value="{{ $post['explanation'] }}" class="form-control">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        @else
            <p>Post not found.</p>
        @endif
    </div>
</body>
</html>
