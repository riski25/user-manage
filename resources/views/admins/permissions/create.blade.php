@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Tambah Permission
                </div>
                <div class="card-body">
                    {{-- @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif --}}
                    {{-- {{ $user}} --}}
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="inputEmail4">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama">
                        </div>
                        <button type="submit" id="btn-data" class="btn btn-primary">Tambah</button>
                    </form>
                </div>

            </div>

            {{-- <div class="card mt-5">
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

            </div> --}}
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script> --}}
<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
<script src="{{asset('js/sweetalert-11.1.9.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-data').click('submit',function (e) {
            e.preventDefault();

            let nama = $('#name').val();
            let token = $('input[name="_token"]').val();

            // console.log(nama, token);

            if (nama.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Nama Wajib Diisi !'
                });
                return false;
            }


            $.ajax({
                type: "POST",
                url: "{{ url('users/admin/permission') }}",
                data: {
                    "name" : nama,
                    "_token" : token
                },
                // dataType: "dataType",
                beforeSend: function () {
                    Swal.fire({
                        title: "Please Wait !",
                        html: "Loading ...", // add html attribute if you want or remove
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function (resp) {
                    // let data = JSON.parse(resp);
                    console.log(resp);
                    Swal.fire({
                        icon: 'success',
                        title: 'Tambah Permission',
                        text: resp.message,
                        timer: 5000
                    }).then (function() {
                        window.location.href = "{{ route('admins.permission.index') }}";
                    });
                    // setTimeout(function(){
                    //     window.location.href.reload;
                    // }, 5000);
                },
                error:function(err){
                    console.log(err);
                    Swal.close();
                    try {
                        if (err.responseJSON.errors.name) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps!',
                                text: err.responseJSON.errors.name[0]
                            });
                        }
                    } catch (error) {
                        Swal.fire({
                                icon: 'error',
                                title: 'Opps!',
                                text: error.message,
                        });
                    }
                    // console.log(err.responseJSON.errors.alamat[0]);
                }
            });
        });


    });
</script>
@endsection
