@extends('admin.templates.layout')

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        @include('message')

        @yield('content')
        <div class="card">
            <div class="card">
                <div class="card-body d-md-flex text-center">
                    <h4 class="modal-title" id="model-header">Start-up Savings</h4>
                    <a href="#" class="btn btn-outline-primary font-w-600 my-auto text-nowrap ml-auto add-event"
                        data-toggle="modal" data-target="#upgradeAccount"><i class="far fa-arrow-alt-circle-up"></i> Upgrade an account</a>
                    <!-- Modal -->
                    <div id="upgradeAccount" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg text-left">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="model-header">Upgrade An Account</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/startupsavings/upgrade') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Choose an Account:</label>
                                                    <select name="startup">
                                                        @foreach ($startups as $sausers)
                                                            @php
                                                                $countSlot = App\Models\StartupSavings::levelCount($sausers->userID, 2)
                                                            @endphp
                                                            <option value={{ $sausers->userID }}>
                                                                {{ $sausers->fullName }}(@php echo ($countSlot) @endphp/64)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Select a Great Savings Sponsor:</label>
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
                                        <div class="modal-footer">
                                            <button id="discard" class="btn btn-outline-primary"
                                                data-dismiss="modal">Discard</button>
                                            <button id="add-event" class="btn btn-primary eventbutton" type="submit">Submit</button>
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
                            @foreach ($saList as $sausers)
                            <tr>
                                <td>{{ $sausers->activationCode }}</td>
                                <td>{{ $sausers->fullName }}</td>
                                <td>
                                    @php
                                    echo (App\Models\StartupSavings::levelCount($sausers->userID, 1));
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo (App\Models\StartupSavings::levelCount($sausers->userID, 2));
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo (App\Models\StartupSavings::levelCount($sausers->userID, 3));
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo (App\Models\StartupSavings::levelCount($sausers->userID, 4));
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    echo (App\Models\StartupSavings::levelCount($sausers->userID, 5));
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
