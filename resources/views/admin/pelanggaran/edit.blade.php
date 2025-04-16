<DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <tittle>Data Pelanggaran</tittle>
    <style type="text/css">
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0px;
        }

        table,
        th,
        td {
            border: 1px solid;
        }
    </style>
</head>

<body>

    <h1>Edit Pelanggaran</h1>
    <a href="{{ route('pelanggaran.index') }}">Kembali</a><br><br>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    <form action="{{ route('pelanggaran.update', $pelanggaran->id ) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2>Data Pelanggaran</h2>
        <label>Jenis Pelanggaran</label><br>
        <textarea id="jenis" name="jenis" rows="7" cols="50" value="{{ old('jenis') }}">{{ $pelanggaran->jenis }}</textarea>
        <br><br>

        <label>Konsekuensi Pelanggaran</label><br>
        <textarea id="konsekuensi" name="konsekuensi" rows="7" cols="50" value="{{ old('konsekuensi') }}">{{ $pelanggaran->kgitonsekuensi }}</textarea>
        <br><br>

        <label>Poin Pelanggaran</label><br>
        <input type="text" id="poin" name="poin" value="{{ $pelanggaran->poin }}">
        <br><br>

        <button type="submit">SIMPAN DATA</button>
        <br><br>
    </form>

</body>

</html>