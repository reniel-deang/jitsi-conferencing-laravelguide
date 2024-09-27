<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all(); // Fetch all rooms
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_name' => 'required|unique:rooms',
        ]);

        Room::create([
            'room_name' => $request->room_name,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully');
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        
        // Add participant to the room if not already
        if (!Participant::where('room_id', $id)->where('user_id', Auth::id())->exists()) {
            Participant::create([
                'room_id' => $id,
                'user_id' => Auth::id(),
            ]);
        }
    
        $isModerator = $room->created_by == Auth::id(); // Check if the user is the room creator
    
        return view('rooms.show', compact('room', 'isModerator'));
    }
    

}
