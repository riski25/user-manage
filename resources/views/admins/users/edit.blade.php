@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Data User
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
                            <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" placeholder="Email">
                        </div>
                        <div class="form-group">
                          <label for="inputAddress">Alamat</label>
                          <input type="text" class="form-control" id="alamat" name="alamat" value="{{$user->alamat}}" placeholder="Alamat" >
                        </div>
                        {{-- {{ dd($selectedRoles->toArray())}} --}}
                        <div class="form-group ">
                            <label class="form-label">Roles</label>
                            <select id="roles" class="form-control" name="roles[]" multiple required>
                                    @foreach($roles as $role)
                                        <option
                                        {{ in_array($role, $selectedRoles->toArray()) ? 'selected':''}}
                                        >{{ $role }}</option>
                                    @endforeach
                            </select>
                                @error('roles')
                                <label id="roles-error" class="error" for="roles">{{ $message }}</label>
                            @enderror
                        </div>
                        <button type="submit" id="btn-data" class="btn btn-primary">Edit</button>
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
<script src="{{asset('js/helper.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#btn-data').click('submit',function (e) {
            e.preventDefault();
            // console.log('{{ url('users/update/'.$user->id) }}');
            // let data = $('#formRegister').serializeArray();
            const nama = $('#name').val();
            const email = $('#email').val();
            const alamat = $('#alamat').val();
            const roles = $('#roles').val();
            const token = $('input[name="_token"]').val();

            // console.log(nama, token);

            if (nama.length == "") {

                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Nama Lengkap Wajib Diisi !'
                });
                return false;
            }
            if(email.length == "") {

                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Email Wajib Diisi !'
                });
                return false;


            }
            if(alamat.length == "") {

                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Alamat Wajib Diisi !'
                });
                return false;

            }

            $.ajax({
                type: "PATCH",
                url: "{{ url('users/admin/data-user/'.$user->id) }}",
                data: {
                    "name" : nama,
                    "email" : email,
                    "alamat" : alamat,
                    "roles" : roles,
                    "_token" : token,
                },
                // dataType: "dataType",
                beforeSend: function() {
                    loading();
                },
                success: function (resp) {
                    // let data = JSON.parse(resp);
                    console.log(resp);
                    Swal.fire({
                        icon: 'success',
                        title: 'Update User',
                        text: resp.message,
                        timer: 5000
                    }).then (function() {
                        window.location.href = "{{ route('admins.user.index') }}";
                    });
                    // setTimeout(function(){
                    //     window.location.href.reload;
                    // }, 5000);
                },
                error:function(err){
                    Swal.close();
                    console.log(err);
                    try {
                        if (err.responseJSON.errors.alamat && err.responseJSON.errors.email && err.responseJSON.errors.name) {
                            console.log('in case');
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps!',
                                text: 'nama, email & alamat field is required.'
                            });
                        }
                        if (err.responseJSON.errors.name) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps!',
                                text: err.responseJSON.errors.name[0]
                            });
                        }
                        if (err.responseJSON.errors.email) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps!',
                                text: err.responseJSON.errors.email[0]
                            });
                        }
                        if (err.responseJSON.errors.alamat) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps!',
                                text: err.responseJSON.errors.alamat[0]
                            });
                        }
                    } catch (error) {
                        console.log(error);
                        console.log(err.responseJSON.message);
                        Swal.fire({
                                icon: 'error',
                                title: 'Opps!',
                                text: err.responseJSON.message,
                            });
                    }
                    // console.log(err.responseJSON.errors.alamat[0]);
                }
            });
        });
    });
</script>
@endsection
