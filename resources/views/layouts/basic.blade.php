<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Platform - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body>
    <div class="container-xl p-2">

        <nav class="navbar navbar-light " style="background-color: #e3f2fd; border-radius: 10px;">
            <ul class="nav nav-fill" style="width:100%;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Profile</a>
                      <a class="dropdown-item" href="#">Log Out</a>
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