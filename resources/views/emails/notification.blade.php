
<div style="background-color: skyblue; min-width: 60%; height: 400px; border-radius: 20px; text-align: center; padding-top: 40px;">
    
    <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"> {{$commenter}} commented <a style="color: white">{{$comment}}</a> on your Post. </h1>

    <div>
        <p style="font-size: 2em;"> {{$post->caption}} </p>
    </div>

    <br><br><br><br>    

    <a href="{{ route('show', ['id' => $post->id]) }}" target="_blank" style="border-width:3px; border-style:solid; text-decoration: none; color: white; background-color:skyblue; border-color: white; padding: 10px; font-size: 2em;">
        Go to Post
    </a>
</div>
