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
        <h1>Create New Project</h1>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Project Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Project Description</label>
                        <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Project</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
