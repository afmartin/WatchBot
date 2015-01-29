
    <table>
        <tr>
            <th>Thumbnail</th>
            <th>Title</th>
            <th>View Count</th>
            <th>From</th>
            <th>Edit</th>
        </tr>
@foreach($videos as $video)

    <tr>
        <td>IMAGE HERE</td>
        <td><a href="{{ url("videos/show/" . $video->id) }}">{{ $video->title }}</a></td>
        <td>{{ $video->views }}</td>
        <td><a href="{{ url("/videos/from/" .  $video->user->username) }}">{{ $video->user->username }}</a></td>
        <td>
        @if ($owner)
            <a href="{{ url("videos/edit/" .  $video->id) }}">Edit</a>
        @endif
        </td>
    </tr>

    @endforeach
    </table>