<!DOCTYPE html>
<html>
@extends ('style')
<x-app-layout>
    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{$title}}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <!-- table here -->
                        <div class="search-bar">
                            <form action="/books/search" method="post">
                                @csrf
                                <input class="form-control mr-sm-2 " placeholder="Cari Judul Buku" type="text" name="q" />
                                <button id="searchbtn" class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <th scope="col">Judul</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Peminjam</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Tindakan</th>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                <tr scope="row">
                                    <td>{{$book->title}}</td>
                                    <td>{{$book->writer}}</td>
                                    <td>{{$book->description}}</td>
                                    <td>
                                        @if($book->user)
                                            {{$book->user->name}}
                                        @else
                                            No User
                                        @endif</td>
                                    <td>
                                        <div class="container" id="boxfoto">
                                            <img class="fit-image" src="{{ asset('storage/' . $book->photo) }}" />
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-success" href="/books/{{$book->id}}/edit">Edit</a>
                                    </td>
                                    <td>
                                        <form action="/books/{{$book->id}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger" type="submit">DELETE</button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- table here -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>

</html>