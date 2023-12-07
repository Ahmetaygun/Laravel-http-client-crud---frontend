<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>SHOW Post</title>
</head>
<body>
    <h1>SHOW POST</h1>
    <a href="{{ route('index') }}" class="btn btn-danger">BACK</a>

    @if ($errors->any())
        <p>Error: {{ $errors->first() }}</p>
    @endif
    <!--kaydedildi mesajı-->
    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    @if(isset($post['id']))
        <form action="{{ route('update', $post['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card" style="width: 18rem;">
    <div class="card-body">
    <h5 class="card-title">name: {{ $post['name'] }}</h5>
    <h5 class="card-subtitle mb-2 text-body-secondary">mail: {{ $post['mail'] }}</h5>
    <p class="card-text">explanation: {{ $post['explanation'] }}</p>
  </div>
</div>
        </form>
    @else
        <p>Post not found.</p>
    @endif
</body>
</html>
