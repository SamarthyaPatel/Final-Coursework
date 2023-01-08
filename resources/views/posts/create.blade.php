@extends('layouts.basic')

@section('title', 'New Post')

@section('content')

    <div class="container" style="width: 50%; margin:auto;">
        
        <div class="container p-2 mt-5 shadow-lg p-1 mb-3 bg-white rounded" style=" border-radius: 20px; height: 400px;">
            <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="pt-3 ps-3 form-label"> Caption </label>
                    <p class="px-2"><input class="form-control" type="text" name="caption"></p>
                </div>
        
                <div class="mb-3">
                    <label for="" class="pt-3 ps-3 form-label"> Picture </label>
                    <p class="px-2 mb-5"><input class="form-control-file" style="width: 100%; padding-top: 0.2em; padding-bottom:0.2em; padding-left:0.2em;" type="file" name="image" accept="image/png, image/jpeg"></p>
                </div>
                
                <div class="mb-3 w-100" style="padding-left: 30%;">
                    <button type="submit" class="btn btn-primary w-50 " style="background-color: rgb(0, 0, 255);">Post</button>
                </div>
            </form>
        
            <form action="{{ route('index') }}" method="GET">
                <div class="mb-3 w-100" style="padding-left: 30%;">
                    <button type="submit" class="btn btn-danger w-50 " style="background-color: brown">Cancel</button>
                </div>
            </form>
        </div>

    </div>

@endsection