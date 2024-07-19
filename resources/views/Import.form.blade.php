<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import</title>
</head>
<body>
<h1>Import Form</h1>
    <form action="{{ route('import-Form') }}" method="get" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
