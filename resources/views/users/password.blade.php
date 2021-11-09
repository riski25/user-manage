@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8">

            <div class="card mt-2">
                <div class="card-header">
                    Perubahan Password
                </div>
                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label for="inputPassword4">Password lama</label>
                            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Password lama">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword4">Password baru</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password baru">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword4">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password">
                        </div>
                        <button type="submit" id="btn-data-password" class="btn btn-primary">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script> --}}
<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
<script src="{{asset('js/sweetalert-11.1.9.js')}}"></script>

<script>
    $(document).ready(function() {

        $('#btn-data-password').click('submit',function (e) {
            e.preventDefault();
            // let data = $('#formRegister').serializeArray();
            let old_password = $('#old_password').val();
            let password = $('#password').val();
            let password_confirm = $('#password_confirmation').val();
            let token = $('input[name="_token"]').val();

            if (old_password.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Password Lama Wajib Diisi !'
                });
            }
            if(password.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Password Baru Wajib Diisi !'
                });

            }
            if(password_confirm.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Konfirmasi Password Wajib Diisi !'
                });

            }

            $.ajax({
                type: "POST",
                url: "{{ url('users/change_password') }}",
                data: {
                    "old_password" : old_password,
                    "password" : password,
                    "password_confirmation" : password_confirm,
                    "_token" : token
                },
                // dataType: "dataType",
                success: function (resp) {
                    // let data = JSON.parse(resp);
                    console.log(resp);
                    Swal.fire({
                        type: 'success',
                        title: 'Update Password!',
                        text: resp.message,
                        timer: 5000
                    }).then (function() {
                        window.location.href = "{{ route('home') }}";
                    });
                    // setTimeout(function(){
                    //     window.location.href.reload;
                    // }, 5000);
                },
                error:function(err){
                    console.log(err);
                    try {
                        var message;
                        var status;
                        message = typeof err.responseJSON.errors.password != 'undefined' ? err.responseJSON.errors.password : null;
                        // status = typeof err.responseJSON.status != 'undefined' ? err.responseJSON.status : null;
                        if (message !== null) {
                            Swal.fire({
                                type: 'error',
                                title: 'Opps!',
                                text: err.responseJSON.errors.password[0]
                            });
                        }

                    } catch (error) {
                        console.log(error);
                        if (err.responseJSON.status != 'undefined') {
                            Swal.fire({
                                type: 'error',
                                title: 'Opps!',
                                text: err.responseJSON.message
                            });
                        }
                    }
                    // console.log(err.responseJSON.errors.alamat[0]);
                }
            });
        });
    });
</script>
@endsection
