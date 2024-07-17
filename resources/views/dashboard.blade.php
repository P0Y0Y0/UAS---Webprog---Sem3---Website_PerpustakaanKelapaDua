<!DOCTYPE html>
<html id="dashboardbody">
    @extends ('style')
    <x-app-layout>
        <body id="dashboardbody" class="">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Halo') . (' ')  . Auth::user()->name  }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow: auto; shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div>
                                @include($dash)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        <div class="footer">
            <p>&copy; Pojok Baca Kelapa Dua</p>
        </div>
    </x-app-layout>
</html>


