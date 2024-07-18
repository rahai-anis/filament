<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Assuming you use Laravel mix -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
@include('navbar')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                   <a href="/projects">Check your projects here</a>
                </div>
                
               
            </div>
        </div>
    </div>
</body>
</html>
