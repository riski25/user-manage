@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                {{-- action="{{ route('register') }}" --}}
                <div class="card-body">
                    <form id="formRegister" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                            <div class="col-md-6">
                                <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required>

                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="btn-register" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        // $('#formRegister').submit(function (e) {
        //     e.preventDefault();
        //     console.log('test form');
        // });
        $('#btn-register').click('submit',function (e) {
            e.preventDefault();
            console.log('test btn');
            // let data = $('#formRegister').serializeArray();
            let nama = $('#name').val();
            let email = $('#email').val();
            let alamat = $('#alamat').val();
            let password = $('#password').val();
            let passwordConfirm = $('#password-confirm').val();
            let token = $('input[name="_token"]').val();

            console.log(nama, token);

            if (nama.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Nama Lengkap Wajib Diisi !'
                });
            }
            if(email.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Email Wajib Diisi !'
                });

            }
            if(alamat.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Alamat Wajib Diisi !'
                });

            }
            if(password.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Password Wajib Diisi !'
                });
            }
            if(passwordConfirm.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Konfirmasi Password Wajib Diisi !'
                });
            }

            $.ajax({
                type: "POST",
                url: "{{ route('register') }}",
                data: {
                    "name" : nama,
                    "email" : email,
                    "alamat" : alamat,
                    "password" : password,
                    "password_confirmation" : passwordConfirm,
                    "_token" : token
                },
                // dataType: "dataType",
                success: function (resp) {
                    console.log(resp);
                    Swal.fire({
                        type: 'success',
                        title: 'Register Berhasil!',
                        text: 'silahkan login!'
                    });
                    window.location.href = "http://localhost:8000/home";
                    // http://localhost:8000/home
                },
                error:function(err){
                    console.log(err.responseJSON.message);
                    // if (err.responseJSON.errors.name) {

                    // }
                    Swal.fire({
                        type: 'error',
                        title: 'Opps!',
                        text: err.responseJSON.message
                    });
                    // console.log(err.responseJSON.errors.alamat[0]);
                }
            });
        });
    });
</script>
@endsection
