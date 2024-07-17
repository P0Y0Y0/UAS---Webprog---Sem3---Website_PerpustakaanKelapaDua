<div>
    <h1>Buku Kamu</h1>
    <br>
    <table class="table table-bordered">
        <thead>
            <th scope="col">Judul</th>
            <th scope="col">Penulis</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Tanggal Pinjam</th>
            <th scope="col">Tanggal Kembali</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </thead>
        <tbody>
            @foreach($books as $book)
                @if($book->status_buku == 2 && $book->user_id == $user_id)
                    <tr scope="row">
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->writer }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->tanggal_pinjam }}</td>
                        <td>{{ $book->tanggal_kembali }}</td>
                        <!-- td status buku -->
                        @if($book->tempstatus == 2)
                            <td class="hl-red">Pengembalian Sedang Diproses</td>
                        @elseif($book->tempstatus == 1)
                            <td class="hl-green">Pengembalian Selesai</td>
                        @else
                            <td></td>
                        @endif
                        <td>
                            <button class="btn btn-outline-success" onclick="window.location.href='/main/{{$book->id}}/pengembalian'">Kembalikan</button>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
