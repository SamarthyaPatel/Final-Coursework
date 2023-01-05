<!DOCTYPE html>
<html>

<head>
    <title>Laravel Ajax Request example</title>
    <meta charset="utf-8">
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container">
        <h1>Laravel Ajax Request example</h1>
        <form>
            <div class="form-group">
                <strong>Comment:</strong>
                <input type="text" name="comment" class="comment form-control" placeholder="Comment">
            </div>
            <div class="form-group">
                <button class="btn btn-success submit">Submit</button>
            </div>
        </form>
    </div>
</body>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".submit").click(function (e) {
        e.preventDefault();
        var comment = $("input[comment]").val();
        $.ajax({
            type: 'POST',
            url: "{{ route('ajaxRequest.post') }}",
            data: {
                comment: comment
            },
            success: function (data) {
                alert(data.success);
            }
        });
    });

</script>

</html>
