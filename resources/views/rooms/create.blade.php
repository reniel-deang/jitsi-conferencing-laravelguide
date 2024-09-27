<h1>Create a Room</h1>
<form action="{{ route('rooms.store') }}" method="POST">
    @csrf
    <label for="room_name">Room Name:</label>
    <input type="text" name="room_name" id="room_name" required>
    <button type="submit">Create Room</button>
</form>
