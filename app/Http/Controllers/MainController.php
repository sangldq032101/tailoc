<?php

namespace App\Http\Controllers;

use App\Models\Pending;
use App\Models\Rented;
use App\Models\Room;
use Auth;
use DB;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $rooms = DB::table('rooms')->where('state', 'available')->inRandomOrder()->limit('4')->get();
        $countAvailable = Room::all()->where('state', 'available')->count();
        return view('guest.index', compact('rooms', 'countAvailable'));
    }
    public function allRoom($room_state = null)
    {
        $countRented = DB::table('rooms')->where('state', "rented")->count();
        $countAvailable = DB::table('rooms')->where('state', "available")->count();
        $countAll = DB::table('rooms')->count();
        if ($room_state == null) {
            return redirect('/rooms/all');
        }
        if ($room_state == 'all') {
            if (Auth::check()) {
                $rooms = DB::table('rooms')->paginate(8);
                $count = DB::table('rooms')->where('state', $room_state)->count();
                $count = DB::table('rooms')->where('state', $room_state)->count();
                $count = DB::table('rooms')->count();
                $heading = __("All rooms");
            } else {
                return redirect('/rooms/available');
            }
        }
        if ($room_state == "rented") {
            if (Auth::check()) {
                $rooms = DB::table('rooms')->where('state', $room_state)->paginate(8);
                $count = DB::table('rooms')->where('state', $room_state)->count();
                $heading = __("Rented rooms");
            } else {
                return redirect('/rooms/available');
            }
        }
        if ($room_state == "available") {
            $rooms = DB::table('rooms')->where('state', $room_state)->paginate(8);
            $count = DB::table('rooms')->where('state', $room_state)->count();
            $heading = __("Available rooms");
        }
        return view('guest.rooms.index', compact('rooms', 'heading', 'count', 'countAll', 'countAvailable', 'countRented'));
    }
    // public function search(Request $request)
    // {
    //     $search = $request->input('keyword');
    //     if (!Auth::check()) {
    //         $results = Room::query()
    //             ->where('roomNo', 'LIKE', "%{$search}%")
    //             ->where('state', 'available')
    //             // ->orWhere('roomFloor', 'LIKE', "%{$search}%")
    //             ->get();
    //         $count = Room::query()
    //             ->where('roomNo', 'LIKE', "%{$search}%")
    //             ->where('state', 'available')
    //             // ->orWhere('roomFloor', 'LIKE', "%{$search}%")
    //             ->count();
    //     } else {
    //         $results = Room::query()
    //             ->where('roomNo', 'LIKE', "%{$search}%")
    //             // ->orWhere('roomFloor', 'LIKE', "%{$search}%")
    //             ->get();
    //         $count = Room::query()
    //             ->where('roomNo', 'LIKE', "%{$search}%")
    //             // ->orWhere('roomFloor', 'LIKE', "%{$search}%")
    //             ->count();
    //     }
    //     return view('guest.rooms.search', compact('results', 'search', 'count'));
    // }
    public function viewRoom($id_room)
    {
        $room = Room::findOrFail($id_room);
        return view('guest.rooms.view', compact('room'));
    }
    public function getRentRoom($id_room)
    {
        $room = Room::findOrFail($id_room);
        return view('guest.rooms.rent', compact('room'));
    }
    public function postRentRoom(Request $request, $id_room)
    {
        $this->validate($request, [
            'rentalName' => 'required',
            'phoneNumber' => 'required',
        ]);
        $pending = new Pending;
        $pending->pendingID = $id_room;
        $pending->rentalName = $request->input('rentalName');
        $pending->phoneNumber = $request->input('phoneNumber');
        $room = Room::findOrFail($id_room);
        if ($room->state == "available") {
            $room->state = 'pending';
        }
        $pending->save();
        $room->update();
        return redirect('/rooms/all');
    }
    public function pendingRoom()
    {
        $pendings = DB::table('pending')
            ->select('pending.pendingID')
            ->join('rooms', 'rooms.roomID', '=', 'pending.pendingID')
            ->select('pending.*', 'rooms.*')
            ->get();
        return view('guest.rooms.pending', compact('pendings'));
    }
    // public function changeLanguage($language)
    // {
    //     \Session::put('locale', $language);

    //     return redirect()->back();
    // }
    public function confirmPending($id_pending)
    {
        $pending = Pending::findOrFail($id_pending);
        $rented = new Rented;
        $rented->rentedID = $id_pending;
        $rented->rentalName = $pending->rentalName;
        $rented->phoneNumber = $pending->phoneNumber;
        $rented->save();
        $pending->delete();
        $room = Room::findOrFail($id_pending);
        if ($room->state == "pending") {
            $room->state = 'rented';
        } else {
            $room->state = 'rented';
        }
        $room->update();
        return redirect('/rooms/status/pending');
    }
    public function deletePending($id_pending)
    {
        $pending = Pending::findOrFail($id_pending);
        $pending->delete();
        $room = Room::findOrFail($id_pending);
        if ($room->state == "pending") {
            $room->state = 'available';
        } else {
            $room->state = 'available';
        }
        $room->update();
        return redirect('/rooms/status/pending');
    }
}
