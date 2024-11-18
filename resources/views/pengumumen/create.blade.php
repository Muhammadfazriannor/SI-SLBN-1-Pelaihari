<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Pengumuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <!-- Form for creating new Pengumuman -->
                        <form action="{{ route('pengumumen.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Foto Field -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Foto</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                                 
                                @error('foto')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Judul Field -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" placeholder="Masukkan Judul Pengumuman">
                                 
                                @error('judul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Isi Field (with CKEditor for rich text) -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Isi</label>
                                <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" rows="5" placeholder="Masukkan Isi Pengumuman">{{ old('isi') }}</textarea>
                                 
                                @error('isi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Tanggal Field -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}">
                                 
                                @error('tanggal')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">Simpan Pengumuman</button>
                            <button type="reset" class="btn btn-md btn-warning">Reset</button>
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
