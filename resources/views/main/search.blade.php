<!DOCTYPE html>
<html>
@extends ('style')
<body id="perpus">
    <nav class="navbar fixed-top">
        <!-- Logo user -->
            <div id="logo">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                        @endauth
                    </div>
                @endif
            </div>
        <!-- Logo user -->
        <!-- search bar -->
        <div class="search-bar">
            <form action="/main/search" method="post">
                @csrf
                <input class="form-control mr-sm-2 " placeholder="Cari Judul Buku" type="text" name="q" />
                <button id="searchbtn" class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        <!-- search bar -->
    </nav>

    <div id="perpus">
        <div id="ribbon">
            <h3>(ribbon)</h3>
        </div>
            <div class="cards-array">
                <!-- cards array -->
                @foreach($books as $book)
                    <div class="card">
                        <a href="/books/{{$book->id}}/show" class="">
                            <img class="card-img-top" src="{{ asset('storage/' . $book->photo) }}" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{$book->title}}</h5>
                            <p class="card-text">{{$book->writer}}</p>
                        <!--<p class="card-text">{{$book->description}}</p> -->
                        </div>
                    </div>
                @endforeach
                <!-- cards array -->
            </div>
        </div>
    </div>
    <div class="footer">
        <p>&copy; Pojok Baca Kelapa Dua</p>
    </div>
</body>
</html>