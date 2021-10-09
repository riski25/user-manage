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
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ $user->alamat }}
                                </td>
                                <td>
                                    <a href=" {{ url('users/edit/'.$user->id)}}" class="btn btn-info" >Edit</a>
                                    <a id="btn-del" class="btn btn-danger" >Delete</a>
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
