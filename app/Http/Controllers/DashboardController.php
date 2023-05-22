<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index()
     {
        $book_count = Book::count();
        $category_count = Category::count();
        $user_count = User::count();
        $rentlogs = RentLogs::with('user', 'book')->limit(5)->get();
        return view('dashboard', ['book_count' => $book_count, 'category_count' => $category_count, 'user_count' => $user_count, 'rentlogs' => $rentlogs]);
     }


}
