<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
</head>
<body>
    <a href="{{route('logout')}}">Logout</a> <br>
    <h1>Insert Page</h1>
    <form action="{{route('insert')}}" method="POST">
        @csrf 
        Name <input type="text" name="name"> <br>
        Title <input type="text" name="title"> <br>
        Photo <input type="text" name="photo"> <br>
        Content <textarea name="content" cols="30" rows="10"></textarea> <br>
        <input type="Submit" value="Save">
    </form>
</body>
</html>