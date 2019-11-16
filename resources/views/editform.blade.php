@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Data: <b> {{ $id }}</b></div>
				

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/forms" class="btn btn-danger">Kembali</a>
					<br><br>
					
					<?php
					$a=public_path().'/storage/'.$id;
					$myfile = fopen($a, "r") or die("Unable to open file!");
					$b=fread($myfile,filesize($a));
					//echo $b;
					$c=explode(',',$b);
					$emails=$c[1];
					$tgllhrs=$c[2];
					$telps=$c[3];
					$genders=$c[4];
					?>

					<form method="POST" action="/admins/editingform" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}

                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama" value="{{ $id }}" disabled>

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $emails }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
						<div class="form-group row">
                            <label for="tgllhr" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                            <div class="col-md-6">
                                <input id="tgllhr" type="text" class="form-control @error('tgllhr') is-invalid @enderror" name="tgllhr" value="{{ $tgllhrs }}" required autocomplete="tgllhr" autofocus>

                                @error('tgllhr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

						<div class="form-group row">
                            <label for="telp" class="col-md-4 col-form-label text-md-right">{{ __('No Telepon') }}</label>

                            <div class="col-md-6">
                                <input id="telp" type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ $telps }}" required autocomplete="telp" autofocus>

                                @error('telp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
						
						<div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select name="gender" class="form-control">
									<option value="">Belum Terpilih</option>
									<?php
									echo"
									<option value='male' ";
									if($genders=='male') {echo"selected";}
									else{echo"";}echo">Male</option>
									<option value='female' ";
									if($genders=='female') {echo"selected";} else{echo"";}echo">Female</option>
									";
									?>
									
								</select>
                            </div>
                        </div>

						<div class="form-group row">
                            <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                            <div class="col-md-6">
							<?php 
							$dest=public_path().'/storage/foto';
							//$dest=public_path().'/storage/app/public/foto'; 
							$filefotoa=substr($id,0,-3);
							$filefotob="".$dest."/foto-".$filefotoa."jpg";
							$filefotoba="foto-".$filefotoa."jpg";
							$filefotog=Storage::url('foto/'.$filefotoba.'');
							$exist=Storage::disk('local')->exists('public/foto/foto-'.$filefotoa.'jpg');

							if($exist)
								{	
								$filefotoh=$filefotog;
								
								}
							else
								{
								$filefotoh=Storage::url('foto/default.jpg');
								
								}
							
							?>
							<img src="{{ $filefotoh }}" width="400px">
							
                                <input type="file" name="foto" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
							<input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ganti') }}
                                </button>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="reset" class="btn btn-warning">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
