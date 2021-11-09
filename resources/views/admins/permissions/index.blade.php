@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Permissions
                </div>
                <div class="card-body">
                    <a href=" {{ route('admins.permission.create')}}" class="btn btn-info mb-2" >Tambah Permission</a>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($permissions as $key => $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href=" {{ url('users/admin/permission/'.$permission->id)}}" class="btn btn-info" >Edit</a>
                                    <a id="btn-del" onclick="deleteFunction('{{$permission->id}}')" class="btn btn-danger" >Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="float-right">{{ $permissions->links()}}</div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
<script src="{{asset('js/sweetalert-11.1.9.js')}}"></script>
<script>

    function deleteFunction(param) {
        console.log(param);
        Swal.fire({
        title: "Are you sure?",
        text: `Confirm delete ID employee is ${param}`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete.",
      }).then((result) => {
        if (result.value) {
          Swal.fire({
                title: "Please Wait !",
                html: "Loading ...", // add html attribute if you want or remove
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });
          axios
            .delete("permission/"+param)
            .then((res) => {

              // console.log(res.data);
              // this.$router.replace({ name: "employee" });
              if (res.data.status === "success") {
                Swal.fire("Deleted!", `${res.data.message}`, "success")
                .then(function(){
                    window.location.href = "{{ route('admins.permission.index') }}";
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
