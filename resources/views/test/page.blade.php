<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
</head>
<body>
 <!-- <form action="{{route('register')}}" method="post"> -->
    <form action="" method="post">
     @foreach($errors->all() as $error)

        <p style="color:red;">{{$error}}</p>

     @endforeach
     @csrf
     Name <input type="text" name="name"> <br>
     Email <input type="email" name="email"> <br>
     Password <input type="password" name="password"> <br>
     Confirm Password <input type="password" name="confirm"> <br>
     <input type="submit" value="Register">
 </form> 
</body>
</html>