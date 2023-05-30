<!DOCTYPE html>
<html>
<head>
    <title>Yeni Gönderi Oluştur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            width: 300px;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="form-container">
        <h1 class="text-center">Yeni Gönderi Oluştur</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <a href="{{ route('index') }}" class="btn btn-danger">BACK</a>
        <form action="{{ route('store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">İsim:</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Mail:</label>
                <input type="text" id="mail" name="mail" class="form-control">
            </div>
            <div class="mb-3">
                <label for="explanation" class="form-label">Açıklama:</label>
                <textarea id="explanation" name="explanation" class="form-control"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Gönderi Oluştur</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
