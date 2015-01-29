@extends("master")

@section("content")
    <h3>Videos from {{ $username  }}</h3>

    <a href="{{ url("/users/show/" . $username) }}">View Complete Profile</a>
    @include("videos/_list")
@stop