<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function profile()
    {  
        $rentLogs = RentLogs::with(['user', 'book'])->where('user_id', Auth::user()->id)->get();
        return view('profile', ['rentlogs' => $rentLogs]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where([
            'role_id' => 2,
            'status' => 'active'
            ])->get();
        return view('user', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function registeredUsers()
    {
        $regisUser = User::where([
            'role_id' => 2,
            'status' => 'inactive'
        ])->get();

        return view('registered-users', ['registeredUser' => $regisUser]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $rentLogs = RentLogs::with(['user', 'book'])->where('user_id', $user->id)->get();
        return view('user-detail', ['user' => $user, 'rentlogs' => $rentLogs]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Success Approved Data');
        return redirect('user-detail/'.$slug);
        
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function delete($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('user-delete', ['user' => $user]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Success Banned User');
        return redirect('users');
    }

    public function bannedUser()
    {
        $bannedUser = User::onlyTrashed()->get();
        return view('user-deleted-list', ['users' => $bannedUser]);
    }

    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();
        Session::flash('status', 'success');
        Session::flash('message', 'Success Restore User');
        return redirect('users');

    }

}

