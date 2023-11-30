<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\Rented;
use File;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function addRoom()
    {
        return view('admin.rooms.add');
    }
    public function postAddRoom(Request $request)
    {
        $this->validate($request, [
            'roomImg' => 'max:10240'
        ]);
        $room = new Room;
        $room->roomID = date('dmYHis');
        $room->roomNo = $request->input('roomNo');
        $room->roomFloor = $request->input('roomFloor');
        $room->roomPrice = $request->input('roomPrice');
        $room->roomDescription = $request->input('roomDescription');
        $room->state = 'available';
        if ($request->hasfile('roomImg')) {
            $file = $request->file('roomImg');
            $filename = time() . '.' . $file->extension();
            $file->move(public_path('assets/img/rooms'), $filename);
            $room->roomImg = $filename;
        }
        $room->save();
        return redirect('/rooms/all');
    }
    public function edit($id_room)
    {
        $room = Room::findOrFail($id_room);
        return view('admin.rooms.edit', compact('room'));
    }
    public function postEdit(Request $request, $id_room)
    {
        $this->validate($request, [
            'roomImg' => 'max:10240'
        ]);
        $room = Room::findOrFail($id_room);
        $room->roomNo = $request->input('roomNo');
        $room->roomFloor = $request->input('roomFloor');
        $room->roomDescription = $request->input('roomDescription');
        $room->roomPrice = $request->input('roomPrice');
        if ($request->hasfile('roomImg')) {
            $des = 'public/assets/img/rooms/' . $room->roomImg;
            File::delete($des);
            $file = $request->file('roomImg');
            $filename = time() . '.' . $file->extension();
            $file->move(public_path('assets/img/rooms'), $filename);
            $room->roomImg = $filename;
        }
        $room->update();
        return redirect('/rooms/all');
    }
    public function deleteRoom($id_room)
    {
        $room = Room::findOrFail($id_room);
        $rented = Rented::findOrFail($id_room);
        $rented->delete();
        if ($room->state == "rented") {
            $room->state = 'available';
        } else {
            $room->state = 'available';
        }
        $room->update();
        return redirect('/admin/manage/rooms');
    }
    public function getSearchRoomRented()
    {
        return view('guest.rooms.searchRentedRoom');
    }
    public function postSearchRoomRented(Request $request)
    {
        $phone_number = $request->input('phone_number');
        $rooms = DB::table('rooms')->join('rented', 'rooms.roomID', 'rented.rentedID')->where('phoneNumber', $phone_number)->get();
        return view('guest.rooms.searchRentedRoomResult', compact('rooms', 'phone_number'));
    }
}
