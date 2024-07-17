<div>
    <h1>Daftar Peminjam Buku</h1>
    <br>
    <table class="table table-bordered">
        <thead>
            <th scope="col">Judul</th>
            <th scope="col">Penulis</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Peminjam</th>
            <th scope="col">Tanggal Pinjam</th>
            <th scope="col">Tanggal Kembali</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr scope="row">
                <td>{{ $book->title }}</td>
                <td>{{ $book->writer}}</td>
                <td>{{ $book->description }}</td>
                <td>{{ $book->user->name}}</td>
                <td>{{ $book->tanggal_pinjam }}</td>
                <td>{{ $book->tanggal_kembali }}</td>
                
                @if(now() >= \Carbon\Carbon::parse($book->tanggal_kembali))
                    <td>Tanggal sudah lewat!</td>
                @else
                @endif
                @if($book->tempstatus == 3)
                    <td>Sedang dipinjam</td>
                @elseif($book->tempstatus == 2)
                    <td>menunggu konfirmasi pengembalian</td>
                    <td>
                    <button class="btn btn-outline-success"  onclick="window.location.href='/main/{{$book->id}}/validasipengembalian'">Konfirmasi</button>
                    </td>
                @else
                    <td>error</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    