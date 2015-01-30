@extends('master')

@section('content')

<h3>Users</h3>

<table>
<tr>
<th>ID #</th>
<th>Username</th>
<th>Email</th>
</tr>
@foreach($users as $user)
    <tr>
        <td>#{{{ $user->id }}}</td>
        <td><b><a href="{{{ url("users/show/$user->username")}}}">{{{ $user->username }}}</a></b></td>
        <td> | {{{ $user->email }}} </td>
    </tr>
@endforeach
</table>


@stop
