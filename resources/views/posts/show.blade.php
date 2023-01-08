<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use Auth;

?>

@extends('layouts.basic')

@section('content')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <div class="container mt-4">

        <div class="card shadow p-1 mb-3 bg-white rounded" style="width: 50%; margin:auto;">
            <div class="card-body">
                <nav class="navbar">
                    <a href=" {{route('index')}} " class="nav-link ps-3" style="font-size: 2em;">🠔 Go Back</a>
                    <div>
                        @if ($user->id == Auth::user()->id)
                            <form action="{{ route('destroy', ['id' => $post->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="nav-link pe-3" style="font-size: 1em; background-color: transparent; border: none;"> 
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAADpklEQVR4nO2aTU8TQRjHHy9qohejFw4mGg8GDxithMBuMbGKMW13ejFRXjURjIhUpWJIJFCbCAln6gETLN7AxPgFOPEZJHrRg8aYiAY8ATszZtotlt3Zvmz3FeefPAmls7P9/55nntlpCiAkJCQkJGS76MXYsW05EVMllFJl9NRSSCjF5mBzQVBEAfapYXRHldEGlhG1I1QZrauy0s/mBr9LlRMDdhk3glD6wc+izYmjdmaeVwnsHuBXbcuJmC5ja1hWZrCsTFuMmcIc/+bcDitR8KtUKT6my9qLeufEMpraBVWKj4FfhSU0uQuAhCb9OKdjwnsdAO2bOIiTz16pqedrZDRDbYmRtF0N8hvrG/TM9f2OAcDJ8TnbjGuB747avFso044BUFNpQ+bp8gqlGFOu2P+XV8oDiPfau1VK6LtjAAjHAN3comW1uWVuvnPQkecFdwEs11gBbM2zsrc5864AUFPpn6bZjPY4ZqjGZvjVkyaIB554bl6LKYe3wfE5biU8nvA6885vg6XiVoGHAMBtEQEgIyqAiCWQET2AiCaYKbsLkBuDlGYX8kG6hyp2czZmZ/zNe8HfBWg2R2nubSHmFynpS5qb70vmx+yMzy4ECMBIujKAIoTeYaP53uHd5vMAcsEBgE3O9aRryGhMB4Frno2pYsn4B0Dc/HRHejgGXy9Rcuth2fcC8ySIqzjX840WzFo1v94apV+aO+jHC5c9ADBS+7meW+oWzf9ouUZXQ5GdcB0AtnhoKUDQZd1C5kvNBwtA9wNj2dcIgJV9IAEQZp6X/VIIZZ4TisHWfOAAEJ55Vgm8JlgBgt687wGQHr55cvsRvzFWgBAoAKRzkG++ZL2zvw2VML+UvzbwAOhsrqpmx4Uwm9sDALILhrI3rRY9BJPDUPCWwMs3+eAdggzjWU8oju+6H3wA2IEQAEKiAqhYAiHRA6hogqE9sgusl3yxwWtw1YTrAFSbfhGq/2LDSnw4H9lwHQCWlHd2ZL5e8yw+hSLvXQdA25TTqox+1QOA98WGhfj9ueXqCdcBMNEwOo5ltMh+xGwFQD1rfjUU+cMy75l5ISEhvQ4AwBEAaACAkwDQCADnAKANAMIA0A4AlwAgAgBXtYhpUXwd0ca0a9e0aXM0anM2aPdg9/JchwHgFAC0AEBHiRm3okO7N/sMh9w2fxYAoh6YNgv2WZrcBND0vwMArey8XAJXvFwCwJFZE2zVNUEWZk2w+H6xCbJrHW2CfwF/njmCysA8mAAAAABJRU5ErkJggg==" width="80%"> 
                                </button>
                            </form>
                        @endif
                    </div>
                </nav>
                
                <div class="card-body">
                    @inject('time', 'App\Http\Controllers\TimeElapsed')
                    <div class="card-title" style="font-weight: bold;">
                        <a href="{{route('getProfile', ['id' => $post->id])}}"> {{$user->name}} </a>
                    </div>
                    <p class="card-text">{{$post->caption}}</p>
                    <p class="card-text" style="text-align: right;"><small>{{ $time::time_elapsed_string($post->created_at) }}</small></p>
                </div>
                @if($post->image != NULL)
                    <div class="card-img-bottom">
                        <img src=" {{ asset('storage/images/'. $post->image) }} " alt="Image posted by {{$user->name}}" class="img-fluid p-3 pt-0">
                    </div>
                @endif

                <div>
                    @livewire('comments', ['online_user' => Auth::user()->id, 'post_id' => $post->id])
                </div>

            </div>
    
            
        </div>
        @livewireScripts
    </div>

@endsection
