@extends('templates.dashboard.app')

@section('content')
<form action="{{ route('dashboard.data-master.user.store') }}" method="post">
    <div class="card-body">
        @csrf

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan nama" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control"
                placeholder="Masukkan konfirmasi password" value="{{ old('password_confirmation') }}">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" class="form-control" required>
                <option>-- Pilih salah satu --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{ route('dashboard.data-master.user.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection