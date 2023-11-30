<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Auth;
use File;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class AdminController extends Controller
{
    public function adminIndex()
    {
        $countAvailable = Room::all()->where('state', 'available')->count();
        $countRented = Room::all()->where('state', 'rented')->count();
        $countAll = Room::all()->count();
        if ($countAll > 0 || $countAvailable > 0 || $countRented > 0) {
            $percentRented = ($countRented / $countAll) * 100;
            $percentAvailable = ($countAvailable / $countAll) * 100;
        } else {
            $percentRented = 0;
            $percentAvailable = 0;
        }
        $currentYear = date("Y");
        $countRentMonth1 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '01')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        $countRentMonth2 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '02')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        $countRentMonth3 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '03')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        $countRentMonth4 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '04')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        $countRentMonth5 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '05')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        $countRentMonth6 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '06')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        $countRentMonth7 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '07')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        $countRentMonth8 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '08')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        $countRentMonth9 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '09')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        $countRentMonth10 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '10')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        $countRentMonth11 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '11')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        $countRentMonth12 = DB::table("rooms")
            ->where('state', '=', 'rented')
            ->whereMonth('updated_at', '=', '12')
            ->whereYear('updated_at', '=', $currentYear)
            ->count();
        return view('admin.index', compact('countAvailable', 'countRented', 'countAll', 'percentRented', 'percentAvailable', 'countRentMonth1', 'countRentMonth2', 'countRentMonth3', 'countRentMonth4', 'countRentMonth5', 'countRentMonth6', 'countRentMonth7', 'countRentMonth8', 'countRentMonth9', 'countRentMonth10', 'countRentMonth11', 'countRentMonth12', ));
    }
    public function viewProfile()
    {
        return view('admin.accounts.view');
    }
    public function editProfile($id_user)
    {
        $user = User::findOrFail($id_user);
        return view('admin.accounts.edit', compact('user'));
    }
    public function updateProfile(Request $request, $id_user)
    {
        $this->validate($request, [
            'avatar' => 'image|max:2048'
        ]);
        $user = User::findOrFail($id_user);
        $user->fullname = $request->input('fullname');
        $user->username = $request->input('username');
        if ($request->hasfile('avatar')) {
            $des = 'assets/img/avatar/' . $user->avatar;
            File::delete($des);
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->extension();
            $file->move('assets/img/avatar', $filename);
            $user->avatar = $filename;
        }
        $user->update();
        return redirect()->route('viewProfile', ['id' => $user->userID]);
        ;
    }
    public function manageRoom()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }
}
