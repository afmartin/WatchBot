@if(count($videos) == 0)
   <b><p>The user has no videos shared.</p></b>
@else
   <table>
            <tr>
                <th>Thumbnail</th>
                <th>Title</th>
                <th>View Count</th>
                <th>From</th>
                <th>Owner?</th>
            </tr>
    @foreach($videos as $video)

        <tr>
            <td><img src="http://i.ytimg.com/vi/{{{ $video->video }}}/default.jpg"></td>
            <td><a href="{{{ url("videos/show/" . $video->id) }}}">{{{ $video->title }}}</a></td>
            <td>{{{ $video->views }}}</td>
            <td><a href="{{{ url("/videos/from/" .  $video->user->username) }}}">{{{ $video->user->username }}}</a></td>
            <td>
            @if(Auth::user() == $video->user)
                <a href="{{{ url("videos/edit/" .  $video->id) }}}">Edit</a>
            @endif
            </td>
        </tr>

        @endforeach
        </table>

@endif

<a href="{{{ url("/videos/new") }}}">Add a Video</a>