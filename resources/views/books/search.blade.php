<!DOCTYPE html>
<html>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1> {{$title}} Buku</h1>
                </div>
            </div>
        </div>
    </div>
<form action="/books/search" method="post">
    @csrf
    <input type="text" name="q" />
    <button type="submit">Search</button>
</form>

<table>
    <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Deskripsi</th>
        <th>User</th>
        <th>Tindakan</th>
    </tr>
    @foreach($books as $book)
    <tr>
        <td>{{$book->title}}</td>
        <td>{{$book->writer}}</td>
        <td>{{$book->description}}</td>
        <td>                @if($book->user)
                    {{$book->user->name}}
                @else
                    No User
                @endif</td>
        <td>
            Photo: <img src="{{ asset('storage/' . $book->photo) }}" />
        </td>
        <td>
            <a href="/books/{{$book->id}}/edit">Edit</a>
        </td>
        <td>
            <form action="/books/{{$book->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">DELETE</button>
                </form>
        </td>

    </tr>
    @endforeach
</table>
</x-app-layout>

</html>