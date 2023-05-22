<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('role_id', '!=', 1)->where('status', 'active')->get();
        $books = Book::get();
        return view('book-rent', ['users' => $user, 'books' => $books]);
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
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();
        
        $book = Book::findOrFail($request->book_id)->only('status');
        
        if ($book['status'] != 'in stock'){
            
            Session::flash('message', 'Cannot Rent, The Book is Not Available');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book-rent');
        }
        else {
            $count = RentLogs::where([
                'user_id' => $request->user_id,
                'actual_return_date' => null
            ])->count();
            
            if ($count >= 3){
                Session::flash('message', 'Cannot Rent, User has reach limit of rent book');
                Session::flash('alert-class', 'alert-danger');
                return redirect('book-rent');
            }
            else {
                try {
                    DB::beginTransaction();
                    // proses insert to rent logs table
                    RentLogs::create($request->all());
                    // process update book table
                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not available';
                    $book->save();
                    DB::commit();
    
                    Session::flash('message', 'Rent Book Success');
                    Session::flash('alert-class', 'alert-success');
                    return redirect('book-rent');
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
            
        }

    }

    /**
     * Display the specified resource.
     */
    public function returnBook()
    {
        $user = User::where('role_id', '!=', 1)->where('status', 'active')->get();
        $books = Book::get();
        return view('return-book', ['users' => $user, 'books' => $books]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function saveReturnBook(Request $request)
    {
        $rent = RentLogs::where('user_id', $request->user_id)->where('book_id', $request->book_id)->where('actual_return_date', null);
        $rentData = $rent->first();
        $countData = $rent->count();
        

        if ($countData == 1){
            $rentData->actual_return_date = Carbon::now()->toDateString();
            $rentData->save();

            Session::flash('message', 'Return Book Success');
            Session::flash('alert-class', 'alert-success');
            return redirect('book-return');
        }
        else {
            Session::flash('message', 'There is Error in Process');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book-return');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
