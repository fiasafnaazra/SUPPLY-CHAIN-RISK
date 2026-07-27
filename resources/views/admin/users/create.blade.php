@extends('layouts.admin')

@section('content')

<h3 class="mb-4">

    Tambah User

</h3>

<div class="card">

<div class="card-body">

<form action="{{ route('admin.users.store') }}" method="POST">

@csrf

<div class="mb-3">

<label>Nama</label>

<input
type="text"
name="name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Role</label>

<select
name="role"
class="form-control">

<option value="user">User</option>

<option value="admin">Admin</option>

</select>

</div>

<button class="btn btn-success">

Simpan

</button>

<a href="{{ route('admin.users.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

@endsection