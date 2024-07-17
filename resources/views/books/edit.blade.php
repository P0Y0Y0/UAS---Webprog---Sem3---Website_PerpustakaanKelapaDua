<!DOCTYPE html>
<html id="createbody">
    @extends ('style')
    <body id="createbody">
        <x-app-layout>
            <br>
            <div id="createbox" class="container">
                <h1>Edit {{$books->title}}</h1>
                <form action="/books/{{$books->id}}"" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <table class="container">
                        <tbody>
                            <tr>
                                <td class="column1"><p>Judul: </p></td>
                                <td class="column2"><input type="text" name="title" value="{{$books->title}}" required></td>
                            </tr>
                            <tr>
                                <td class="column1"><p>Penulis: </p></td>
                                <td class="column2"><input type="text" name="writer" value="{{$books->writer}}" required></td>
                            </tr>
                            <tr>
                                <td class="column1"><p>Keterangan: </p></td>
                                <td class="column2"><textarea name="description" id="" cols="30" rows="10" required>{{$books->description}}</textarea></td>
                            </tr>
                            <tr>
                                <td class="column1"><p>Foto: </p></td>
                                <td class="column2"><input type="file" name="photo" id="" value="{{ asset('storage/' . $books->photo) }}" required>{{ asset('storage/' . $books->photo) }}</td>
                            </tr>
                            <tr>
                                <td class="column1"></td>
                                <td class="column2"><button id="searchbtn" class="btn btn-outline-success" type="submit">Submit</button></td>
                            </tr>
                        </tbody>
                    </table>
                    
                </form>
            </div>
        </x-app-layout>
    </body>
</html>
