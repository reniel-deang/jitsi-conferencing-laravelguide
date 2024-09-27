<h1>Rooms</h1>
@foreach ($rooms as $room)
    <div>
        <h3>{{ $room->room_name }}</h3>
        <a href="{{ route('rooms.show', $room->id) }}">Join Room</a>
    </div>
@endforeach

<a href="{{ route('rooms.create') }}" class="btn btn-primary">Create a New Room</a>

