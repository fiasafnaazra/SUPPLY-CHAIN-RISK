@extends('layouts.admin')

@section('content')

<h3 class="mb-4">

Edit User

</h3>

<div class="card">

<div class="card-body">

<form
action="{{ route('admin.users.update',$user->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Nama</label>

<input
type="text"
name="name"
class="form-control"
value="{{ $user->name }}"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="{{ $user->email }}"
required>

</div>

<div class="mb-3">

<label>Role</label>

<select
name="role"
class="form-control">

<option
value="user"
{{ $user->role=='user' ? 'selected' : '' }}>

User

</option>

<option
value="admin"
{{ $user->role=='admin' ? 'selected' : '' }}>

Admin

</option>

</select>

</div>

<button class="btn btn-success">

Update

</button>

<a
href="{{ route('admin.users.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

@endsection