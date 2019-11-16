@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">List Data</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
					

					<table width="100%">
					<tr>
					<td width="50%"><a href="/home" class="btn btn-danger">Kembali</a></td>
					<td align="right"><a href="/admins/addform" class="btn btn-success">Tambah Data</a></td>
					</tr>
					</table>
					
					<br><br>
                    <?php 
					//echo asset('storage/aku.txt');
					//Storage::disk('local')->put('file.txt', 'Contents');
					$dest=public_path().'/storage';
					$filesb = File::Files($dest);
					//$files= Storage::Files('app');
					?>
					
					<table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($filesb as $file)

							<?php $a=explode("/storage",$file); 
							$id=substr($a[1],1);
							?>
                            <tr>
                                <td>{{ substr($a[1],1) }} </td>
                                
                                <td>
                                    <a href="/admins/editform/{{ $id }}" class="btn btn-warning">Edit</a>
                                    <a href="/admins/hapusform/{{ $id }}" class="btn btn-danger">Hapus</a>
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
