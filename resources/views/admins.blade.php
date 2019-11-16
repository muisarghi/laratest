@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Menu Admin</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


					<table width="100%">
					<tr>
					<td width="50%"><a href="/home" class="btn btn-danger">Kembali</a></td>
					<td align="right"><a href="/admins/add" class="btn btn-success">Tambah Data</a></td>
					</tr>
					</table>
					
					

					<br>
					<table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $a)
                            <tr>
                                <td>{{ $a->name }}</td>
                                <td>{{ $a->email }}</td>
                                <td>
                                    <a href="/admins/editadm/{{ $a->id }}" class="btn btn-warning">Edit</a>
                                    <a href="/admins/hapusadm/{{ $a->id }}" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
