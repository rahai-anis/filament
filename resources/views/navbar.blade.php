<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/home">Welcome</a>
    </div>
    <ul class="nav navbar-nav">
      
      <li><a href="/projects">Projects</a></li>
      <li><a href="/tasks">Tasks</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li> 
      <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                        <span class="glyphicon glyphicon-user"></span>  {{ __('Logout') }}
                        </button>
                    </form></li>
      
    </ul>
  </div>
</nav>