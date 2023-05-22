<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::get();
        return view('book', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('book-add', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|unique:books|max:255'
        ]);


        $newName = '';
        if ($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);

        }
        
        $request['cover'] = $newName;
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        Session::flash('status', 'success');
        Session::flash('message', 'Success Add Data');
        return redirect('books');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $books = Book::where('slug', $slug)->first();
        $categories = Category::get();
        return view('book-edit', ['book' => $books, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        if ($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;

        }
        
        $book = Book::where('slug', $slug)->first();
        $book->update($request->all());

        if ($request->categories){
            $book->categories()->sync($request->categories);
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Success Edit Data');
        return redirect('books');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($slug)
    {
        $book = Book::where('slug', $slug)->first();
        return view('book-delete', ['book' => $book]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $book->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Success Delete Data');
        return redirect('books');
    }

    public function deletedBook()
    {
        $deletedBooks = Book::onlyTrashed()->get();
        return view('book-deleted-list', ['books' => $deletedBooks]);
    }

    public function restore($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        Session::flash('status', 'success');
        Session::flash('message', 'Success Restore Data');
        return redirect('books');

    }
}
