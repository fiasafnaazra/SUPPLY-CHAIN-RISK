@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h3>Kelola User</h3>

    <a href="{{ route('admin.users.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus"></i>
        Tambah User

    </a>

</div>

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<div class="card">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-primary">

                <tr>

                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th width="180">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($users as $user)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                    <td>{{ ucfirst($user->role) }}</td>

                    <td>

                        <a href="{{ route('admin.users.edit',$user->id) }}"
                           class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form
                            action="{{ route('admin.users.destroy',$user->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus user ini?')">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center">

                        Tidak ada data.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection