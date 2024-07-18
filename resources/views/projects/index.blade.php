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


   




    <h1>Your Projects</h1>

    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Create New Project</a>

    
    <table class="table">
  <thead>
    <tr>
      <th scope="col">name</th>
      <th scope="col">description</th>
   
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($projects as $project)
    <tr>
      <th scope="row">{{ $project->name }}</th>
      <td>{{ $project->description }}</td>
     
      <td style ="display:flex">
      <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>
