<h3>Database Read Page</h3>

<table border="1">
<tr>
    <th>ID</th>
    <th>name</th>
    <th>title</th>
    <th>photo</th>
    <th>content</th>
    <th></th>
    <th></th>
</tr>
@foreach($data as $answer)
<tr>
    <td>{{$answer->id}}</td>
    <td>{{$answer->name}}</td>
    <td>{{$answer->title}}</td>
    <td>{{$answer->photo}}</td>
    <td>{{$answer->content}}</td>
    <td><a href="{{url('delete/'.$answer->id)}}">Delete</a></td>
    <td><a href="{{url('update/'.$answer->id)}}">Update</a></td>
</tr>
@endforeach
</table>