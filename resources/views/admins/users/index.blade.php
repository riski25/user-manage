@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data User
                </div>
                <div class="card-body">
                    {{-- <a href=" {{ route('users.create')}}" class="btn btn-info mb-2" >Tambah User</a> --}}
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table class="table table-striped table-bordered">
                        <tr>
                            {{-- <th>ID</th> --}}
                            <th>Name</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($data->sortByDesc('id') as $key => $user)
                            <tr>
                                {{-- <td>{{ $user->id }}</td> --}}
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ $user->alamat }}
                                </td>
                                <td>
                                    <a href=" {{ url('users/admin/data-user/'.$user->id)}}" class="btn btn-info" >Edit</a>
                                    {{-- {{ dd(auth()->user()->roles()->get()[0]->name)}} --}}
                                    @foreach ($user->roles()->pluck('name') as $item)
                                        {{-- {{ $item}} --}}
                                        @if ($item !== 'admin')
                                            <a id="btn-del" onclick="deleteRole('{{$user->id}}')" class="btn btn-danger" >Delete</a>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="float-right">{{ $data->links()}}</div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
<script src="{{asset('js/sweetalert-11.1.9.js')}}"></script>
<script src="{{asset('js/helper.js')}}"></script>

<script>
    function deleteRole(param) {
        console.log(param);
        Swal.fire({
        title: "Anda Yakin ?",
        text: `Pastikan User tersebut sudah tidak aktif !`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete.",
      }).then((result) => {
        if (result.value) {
          loading();
          axios
            .delete("data-user/"+param)
            .then((res) => {

              // console.log(res.data);
              // this.$router.replace({ name: "employee" });
              if (res.data.status === "success") {
                Swal.fire("Deleted!", `${res.data.message}`, "success")
                .then(function(){
                    window.location.href = "{{ route('admins.user.index') }}";
                });
              } else {
                Swal.fire(
                  "Alert!",
                  `Something wrong delete unsuccessful, reload & try again`,
                  "error"
                );
              }
            })
            .catch((error) => {
              Swal.close();
              // console.log(error.response.data.errors);
              try {
                console.log(error.message);
                Swal.fire({
                  icon: "error",
                  title: error.message,
                });
              } catch (error) {
                Swal.fire({
                  icon: "error",
                  title: `Something went wrong,  ${error}`,
                });
              }
            });
        }
      });
    }
</script>
