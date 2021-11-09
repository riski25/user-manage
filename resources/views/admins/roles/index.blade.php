@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Roles
                </div>
                <div class="card-body">
                    <a href=" {{ route('admins.role.create')}}" class="btn btn-info mb-2" >Tambah Roles</a>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions()->get() as $item)
                                        {!! $item->name ."<b>,</b>" !!}
                                        {{-- <td>{{ dd($role->permissions()->get()) }}</td> --}}
                                    @endforeach
                                </td>

                                <td>
                                    <a href=" {{ url('users/admin/role/'.$role->id)}}" class="btn btn-info" >Edit</a>
                                    <a id="btn-del" onclick="deleteRole('{{$role->id}}')" class="btn btn-danger" >Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="float-right">{{ $roles->links()}}</div>
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
        text: `Pastikan User role tersebut sudah tidak aktif !`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete.",
      }).then((result) => {
        if (result.value) {
          loading();
          axios
            .delete("role/"+param)
            .then((res) => {

              // console.log(res.data);
              // this.$router.replace({ name: "employee" });
              if (res.data.status === "success") {
                Swal.fire("Deleted!", `${res.data.message}`, "success")
                .then(function(){
                    window.location.href = "{{ route('admins.role.index') }}";
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
