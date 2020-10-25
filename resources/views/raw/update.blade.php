<form action="{{url('updates')}}" method="POST">
@csrf
<input type="hidden" name="id" value="{{$data[0]->id}}"> <br>
Name <input type="text" name="name" value="{{$data[0]->name}}"> <br>
Title <input type="text" name="title" value="{{$data[0]->title}}"> <br>
Photo <input type="text" name="photo" value="{{$data[0]->photo}}"> <br>
Content <input type="text" name="content" value="{{$data[0]->content}}"> <br>
<input type="Submit" value="Update">

</form>