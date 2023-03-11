@extends('admin.templates.layout')

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        @include('message')

        @yield('content')
        <div class="card">
            <div class="card">
                <div class="card-body d-md-flex text-center">
                    <h4 class="modal-title" id="model-header">Users/Accounts</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display table dataTable table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Activation Code</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Date Of Birth</th>
                                <th>Contact Info</th>
                                <th>email</th>
                                <th>Cycle No.</th>
                                <th>Date Started</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userList as $user)
                            <tr>
                                <td>{{ $user->activationCode }}</td>
                                <td>{{ $user->firstName." ".$user->middleName." ".$user->lastName }}</td>
                                <td>{{ $user->userName }}</td>
                                <td>{{ $user->date_of_birth }}</td>
                                <td>{{ $user->contactInfo }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->cycle }}</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
