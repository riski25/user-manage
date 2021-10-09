@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" id="btn-login" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
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
        $('#btn-login').click('submit',function (e) {
            e.preventDefault();
            console.log('test btn');
            let email = $('#email').val();
            let password = $('#password').val();
            let token = $('input[name="_token"]').val();

            if(email.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Email Wajib Diisi !'
                });

            }
            if(password.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Password Wajib Diisi !'
                });
            }

            $.ajax({
                type: "POST",
                url: "{{ route('login') }}",
                data: {
                    "email" : email,
                    "password" : password,
                    "_token" : token
                },
                // dataType: "dataType",
                success: function (resp) {
                    console.log(resp);
                    window.location.href = "/home";
                    // http://localhost:8000/home
                },
                error:function(err){
                    // console.log(err.responseJSON.message);
                    var spas= ' ';
                    if (err.responseJSON.errors.email && err.responseJSON.errors.password) {
                        Swal.fire({
                            type: 'error',
                            title: 'Opps!',
                            text: 'Email & password field is required.'
                        });
                    }
                    if (err.responseJSON.errors.email) {
                        Swal.fire({
                            type: 'error',
                            title: 'Opps!',
                            text: err.responseJSON.errors.email[0]
                        });
                    }
                    if (err.responseJSON.errors.password) {
                        Swal.fire({
                            type: 'error',
                            title: 'Opps!',
                            text: err.responseJSON.errors.password[0]
                        });
                    }
                    // console.log(err.responseJSON.errors.alamat[0]);
                }
            });
        });
    });
</script>
@endsection
