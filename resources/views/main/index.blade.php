<!DOCTYPE html>
<html >
    @extends ('style')
    <body id="mainindex">
        <!-- Logo user -->
        <div id="maincontent">
            <div id="logo">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>

            <!-- Logo user -->
            
            <div class="container">
                <div class="container">
                    <h1>Selamat Datang</h1>
                    <br>
                    <button class="btn btn-outline-info" onclick="window.location.href='/main/perpus'">Ke Pojok Baca Sekarang</button>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>&copy; Pojok Baca Kelapa Dua</p>
        </div>

    </body>

</html>