<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Pengumuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('pengumumen.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf
                            @method('PUT')

                            <!-- Foto Field -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">FOTO</label>
                                @if ($pengumuman->foto)
                                    <div class="mb-3">
                                        <label>Foto Sebelumnya:</label>
                                        <img src="{{ Storage::url('public/pengumumen/' . $pengumuman->foto) }}" alt="Foto Pengumuman" class="img-fluid" width="200">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                                <!-- error message untuk foto -->
                                @error('foto')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Judul Field -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">JUDUL</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $pengumuman->judul) }}" placeholder="Masukkan Judul Pengumuman">
                                <!-- error message untuk judul -->
                                @error('judul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Isi Field (with CKEditor for rich text) -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">ISI</label>
                                <textarea name="isi" id="isi" rows="5" class="form-control @error('isi') is-invalid @enderror">
                                    {!! old('isi', $pengumuman->isi) !!}
                                </textarea>
                                <!-- error message untuk isi -->
                                @error('isi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Tanggal Field -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TANGGAL</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal', $pengumuman->tanggal) }}">
                                <!-- error message untuk tanggal -->
                                @error('tanggal')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and CKEditor -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        // Initialize CKEditor on the 'isi' textarea for rich text editing
        CKEDITOR.replace('isi', {
            enterMode: CKEDITOR.ENTER_BR, // Use <br> for line breaks instead of <p>
            shiftEnterMode: CKEDITOR.ENTER_P,
            allowedContent: true, // Allow all basic HTML tags
            forcePasteAsPlainText: true, // Paste as plain text
            removePlugins: 'elementspath', // Remove path under the editor
            disableObjectResizing: true,
            resize_enabled: false
        });
    </script>
</body>
</html>
