<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    @livewireStyles
</head>
<body>
    <div class="container-xl p-2">

        <nav class="navbar navbar-light " style="background-color: #e3f2fd; border-radius: 10px;">
            <ul class="nav nav-fill" style="width:100%;">
                <li class="nav-item">
                    <div class="dropdown" style="position: relative;">
                        <a class="nav-link dropdown-toggle" type="button" id="book-dropdown" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu" aria-labelledby="book-dropdown" style="position: absolute; width: 38%; margin-left: 150px;">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" onclick="event.preventDefault();this.closest('form').submit();"> Log Out</a>
                            </form>
                            
                        </div>
                    </div>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" href=" {{ route('index')}} ">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" {{ route('create')}} ">New Post</a>
                </li>
            </ul>
        </nav>

        <div>
        @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    @livewireScripts
</body>
</html>