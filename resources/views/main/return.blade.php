
<!DOCTYPE html>
<html>
@extends ('style')
    <body>
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
                    <a id="searchbtn" class="btn btn-outline-success" href="/main/perpus">Kembali ke daftar buku</a>
                </form>
            </div>
            <!-- search bar -->
        </nav>

        <div id="showbuku" class="container">
            <!-- detail buku -->
            <div class="container">
                <img src="{{ asset('storage/' . $book->photo) }}" alt=""> <br>
            </div>
            <form class="container" action="/main/{{$book->id}}/konfirmasipengembalian" method="post">
                @csrf
                <div class="container">
                    <div class="container">
                        <h3>Judul: {{$book->title}}</h3>
                    </div>
                    <div class="container">
                        <p>Penulis: {{$book->writer}}</p>
                    </div>
                    <div class="container">
                        <p>deskripsi: {{$book->description}}</p>
                    </div>
                    <div class="container">
                        <p>
                            Tanggal pinjam: {{ $book->tanggal_pinjam }} <br>
                            Tanggal kembali: {{ $book->tanggal_kembali }}
                        </p>
                    </div>
                    <br>
                    <button id="searchbtn" class="btn btn-outline-success" href="/main/perpus" type="submit">kembalikan</button>
                </div>
            </form>
        </div>
    </body>
</html>


