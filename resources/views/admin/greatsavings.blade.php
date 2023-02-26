@extends('admin.templates.layout')

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        @include('message')

        @yield('content')
        <div class="card">
            <div class="card">
                <div class="card-body d-md-flex text-center">
                    <h4 class="modal-title" id="model-header">Great Savings</h4>
                    <a href="#" class="btn btn-outline-secondary font-w-600 my-auto text-nowrap ml-auto add-event"
                        data-toggle="modal" data-target="#addAccount"><i class="fas fa-user-plus"></i> Add Account</a>
                    <!-- Modal -->
                    <div id="addAccount" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg text-left">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="model-header">Add A User</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/greatsavings/add') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="d-flex event-title">
                                                        <input type="number" placeholder="Activation Code"
                                                            class="form-control" name="activationCode" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <div class="form-group start-date">
                                                    <div class="d-flex">
                                                        <input placeholder="First Name" class="form-control" type="text" name="firstName" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <div class="form-group start-date">
                                                    <div class="d-flex">
                                                        <input placeholder="Middle Name" class="form-control" type="text" name="middleName" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <div class="form-group start-date">
                                                    <div class="d-flex">
                                                        <input placeholder="Last Name" class="form-control" type="text" name="lastName" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Start-up Sponsor:</label>
                                                    <select name="saSponsor">
                                                        @foreach ($saList as $sausers)
                                                            @php
                                                                $countSlot = App\Models\StartupSavings::levelCount($sausers->userID, 1)
                                                            @endphp
                                                            <option value={{ $sausers->userID }}>
                                                                {{ $sausers->fullName }}(@php echo ($countSlot) @endphp/8)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Great Savings Sponsor:</label>
                                                    <select name="gsSponsor">
                                                        @foreach ($gsList as $gsusers)
                                                        @php
                                                            $countSlot = App\Models\GreatSavings::levelCount($gsusers->userID, 1)
                                                        @endphp
                                                            <option value={{ $gsusers->userID }}>
                                                            {{ $gsusers->fullName }}(@php echo ($countSlot) @endphp/8)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <label class="">Date of birth</label>
                                                <div class="form-group start-date">
                                                    <div class="d-flex">
                                                        <input class="form-control" type="date" name="date_of_birth" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="form-group start-date">
                                                    <div class="d-flex">
                                                        <input placeholder="Contact Number" class="form-control" type="number" name="contactInfo" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="form-group start-date">
                                                    <div class="d-flex">
                                                        <input placeholder="Email Address" class="form-control" type="email" name="email" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="discard" class="btn btn-outline-secondary"
                                                data-dismiss="modal">Discard</button>
                                            <button id="add-event" class="btn btn-secondary eventbutton" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header  justify-content-between align-items-center">
                <h4 class="card-title">List of users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display table dataTable table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Activation Code</th>
                                <th>Name</th>
                                <th>Level 1</th>
                                <th>Level 2</th>
                                <th>Level 3</th>
                                <th>Level 4</th>
                                <th>Level 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gsList as $gsusers)
                            <tr>
                                <td>{{ $gsusers->activationCode }}</td>
                                <td>{{ $gsusers->fullName }}</td>
                                <td>
                                    @php
                                    echo (App\Models\GreatSavings::levelCount($gsusers->userID, 1));
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo (App\Models\GreatSavings::levelCount($gsusers->userID, 2));
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo (App\Models\GreatSavings::levelCount($gsusers->userID, 3));
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo (App\Models\GreatSavings::levelCount($gsusers->userID, 4));
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo (App\Models\GreatSavings::levelCount($gsusers->userID, 5));
                                    @endphp
                                </td>
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
