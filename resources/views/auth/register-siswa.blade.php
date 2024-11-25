<form method="POST" action="{{ route('register.siswa') }}">
    @csrf
    <input type="text" name="name" placeholder="Nama" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
    <input type="text" name="kelas" placeholder="Kelas" required>
    <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
    <textarea name="alamat" placeholder="Alamat"></textarea>
    <button type="submit">Daftar</button>
</form>
