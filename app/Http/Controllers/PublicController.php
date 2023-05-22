<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        
        $category = Category::get();
        if ($request->category || $request->title){
            $books = Book::where('title', 'like', '%'.$request->title.'%')
                           ->orWhereHas('categories', function($q) use($request){
                                $q->where('categories.id', $request->category);
                           })->get();
            $books = Book::whereHas('categories', function($q) use($request) {
                $q->where('categories.id', $request->category);
            })->get();
        }
        else {
            $books = Book::get();
        }
        return view('book-list', ['books' => $books, 'categories' => $category]);
    }
}
