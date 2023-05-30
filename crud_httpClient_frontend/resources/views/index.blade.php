<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        .action-buttons {
            display: flex;
            gap: 5px;
        }
    </style>
    <title>Posts</title>
</head>
<body>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<h1>Posts</h1>
<a href="/home2" class="btn btn-primary">HOME</a>
<a href="{{ route('create') }}" class="btn btn-info">Create</a>
<a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
@if (isset($yol))
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Mail</th>
                <th>Explanation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($yol as $post)
                <tr>
                    <td class="col-1">{{ $post['id'] }}</td>
                    <td class="col-1">{{ $post['mail'] }}</td>
                    <td class="col-1">{{ $post['name'] }}</td>
                    <td class="col-1">{{ $post['explanation'] }}</td>
                    <td class="col-5 ">
                        <div class="action-buttons">
                            <form action="{{ route('edit', $post['id']) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                            </form>
                            <form action="{{ route('show', $post['id']) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm">Show</button>
                            </form>
                            <form action="{{ route('delete', $post['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No posts found.</p>
@endif
</body>
</html>
