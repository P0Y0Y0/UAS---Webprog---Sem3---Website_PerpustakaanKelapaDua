<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function perpus()
    {
        $books = Book::all();
        $title = "INDEX";
        $photos = $books->map(function ($book) {
        return Storage::url($book->photo);
    });
        return view('main.perpus', ['books' => $books, 'title' => $title, 'photos' => $photos]);
    }

    public function index()
    {
        $books = Book::all();
        $title = "INDEX";
    $photos = $books->map(function ($book) {
        return Storage::url($book->photo);
    });

    return view('books.index', ['books' => $books, 'title' => $title, 'photos' => $photos]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $path = $request->file('photo')->storePublicly('photos', 'public');
        $ext = $request->file('photo')->extension();
        $book = new Book();
        $book->title = $request->title;
        $book->writer = $request->writer;
        $book->description = $request->description;
        //$book->user_id = $request->user()->id;
        //$book->user_id = Auth::id();
        $book->photo = $path;
        $book->save();
        return redirect('/books');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $book = Book::findOrFail($id);
        $photo = Storage::url($book->photo);
        return view('books.show', ['book' => $book, 'photo' => $photo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $book = Book::find($id);
            return view('books.edit', ['books'=>$book]);
    }

    public function search(Request $request)
    {
        //
        $title = "Search Results";
        $query = $request->input('q');
        $books = Book::where('title', 'like', "%$query%")->get();
        return view('books.search', compact('title', 'books', 'query'));
    }

    public function mainsearch(Request $request)
    {
        //
        $title = "Search Results";
        $query = $request->input('q');
        $books = Book::where('title', 'like', "%$query%")->get();
        return view('main.search', compact('title', 'books', 'query'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $path = $request->file('photo')->storePublicly('photos', 'public');
        $book = Book::findOrfail($id);
        $book->title = $request->title;
        $book->writer = $request->writer;
        $book->description = $request->description;
        $book->photo = $path;
        $book->save();
        return redirect ('/books');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $book = Book::find($id);
        $book->delete();
        return redirect('/books');
    }

    public function borrow($id)
    {
        $book = Book::findOrFail($id);

        return view('books.borrow', ['book' => $book]);
    }

public function borrowval(Request $request, $id)
{
    $book = Book::findOrFail($id);
    $book->status_buku = 2;
    $book->tempstatus = 3;
    $book->user_id = $request->user()->id;
    $book->tanggal_pinjam = $request->input('temppinjam');
    $book->tanggal_kembali = $request->input('tempkembali');
    // You can remove the following line if you want to use the user ID from $request
    // $book->user_id = Auth::id();
    $book->save();

    $user_id = auth()->user()->id;

    // Retrieve books for the authenticated user
    
    $dash = null;
    if (auth()->check()) {
        if (auth()->user()->roleid === 1) {
            // Admin
            $books = Book::where('status_buku', 2)->get();
            $dash = "main.admindash";
        } elseif (auth()->user()->roleid === 2) {
            // Member
            $books = Book::where('user_id', $user_id)->get();
            $dash = "main.memberdash";
        } else {
            // Other roles or default layout
            //$dash = 'main.defaultLayout';
        }
    } else {
        // Guest
        //$dash = 'main.guestLayout';
    }

    return view('dashboard', compact('book','books', 'dash', 'user_id'));

    //return view('dashboard', ['book' => $book]);
    // If you want to redirect, uncomment the following line
    // return redirect('/dashboard');
}

public function layout()
{
    $user_id = auth()->user()->id;
    
    $dash = null;
    if (auth()->check()) {
        if (auth()->user()->roleid === 1) {
            // Admin
            $books = Book::where('status_buku', 2)->get();
            $dash = "main.admindash";
        } elseif (auth()->user()->roleid === 2) {
            // Member
            $books = Book::where('user_id', $user_id)->get();
            $dash = "main.memberdash";
        } else {
            // Other roles or default layout
            //$dash = 'main.defaultLayout';
        }
    } else {
        // Guest
        //$dash = 'main.guestLayout';
    }

    return view('dashboard', compact('books', 'dash', 'user_id'));
}


//ini member yg return
public function return($id){
    $book = Book::findOrFail($id);

    return view('main.return', ['book' => $book]);

}

public function returnconfirm(Request $request, $id){
    $book = Book::findOrFail($id);
    $book->tempstatus = 2;
    $book->save();

    $user_id = auth()->user()->id;
    $dash = null;
    if (auth()->check()) {
        if (auth()->user()->roleid === 1) {
            // Admin
            $books = Book::where('status_buku', 2)->get();
            $dash = "main.admindash";
        } elseif (auth()->user()->roleid === 2) {
            // Member
            $books = Book::where('user_id', $user_id)->get();
            $dash = "main.memberdash";
        } else {
            // Other roles or default layout
            //$dash = 'main.defaultLayout';
        }
    } else {
        // Guest
        //$dash = 'main.guestLayout';
    }

    return view('dashboard', compact('book','books', 'dash', 'user_id'));
}

//ini admin yg return
public function returnval(Request $request, $id){
    $book = Book::findOrFail($id);
    $book->status_buku = 1;
    $book->tempstatus = null;
    $book->user_id = null;
    $book->tanggal_pinjam = null;
    $book->tanggal_kembali = null;
    // You can remove the following line if you want to use the user ID from $request
    // $book->user_id = Auth::id();
    $book->save();

    $user_id = auth()->user()->id;
    $dash = null;
    if (auth()->check()) {
        if (auth()->user()->roleid === 1) {
            // Admin
            $books = Book::where('status_buku', 2)->get();
            $dash = "main.admindash";
        } elseif (auth()->user()->roleid === 2) {
            // Member
            $books = Book::where('user_id', $user_id)->get();
            $dash = "main.memberdash";
        } else {
            // Other roles or default layout
            //$dash = 'main.defaultLayout';
        }
    } else {
        // Guest
        //$dash = 'main.guestLayout';
    }

    return view('dashboard', compact('book','books', 'dash', 'user_id'));

}

public function user()
{
    return $this->belongsTo(User::class);
}
    
}

