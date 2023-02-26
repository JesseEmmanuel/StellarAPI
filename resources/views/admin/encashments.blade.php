@extends('admin.templates.layout')

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        @include('message')

        @yield('content')
        <div class="card">
            <div class="card-body d-md-flex text-center">
                <h4 class="modal-title" id="model-header">Encashment Logs</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display table dataTable table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Encashment Amount</th>
                                <th>Rebate Balance</th>
                                <th>Claim Status</th>
                                <th>Encashment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($encashLogs as $encashment)
                            <tr>
                                <td>{{ $encashment->title }}</td>
                                <td>{{ $encashment->description }}</td>
                                <td>₱{{ $encashment->encashment }}.00</td>
                                <td>₱{{ $encashment->rebateBalance }}.00</td>
                                <td>
                                    @if ($encashment->claim == 0)
                                    <a href="#"
                                        class="btn btn-outline-danger font-w-600 my-auto text-nowrap ml-auto add-event"
                                        data-toggle="modal" data-target="#claimEncashment"> <i class="icofont-exclamation-circle"></i> Not Yet</a><br />
                                    <!-- Modal -->
                                    <div id="claimEncashment" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-lg text-left">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="model-header">User Verification</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="encashment/verify/{{ $encashment->logID }}"
                                                        method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-12">
                                                                <label class="">Activation Code</label>
                                                                <div class="form-group start-date">
                                                                    <div class="d-flex">
                                                                        <input class="form-control" type="number"
                                                                            name="activationCode">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-12">
                                                                <div class="form-group start-date">
                                                                    <div class="d-flex">
                                                                        <input placeholder="Email" class="form-control"
                                                                            type="email" name="email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-12">
                                                                <div class="form-group start-date">
                                                                    <div class="d-flex">
                                                                        <input placeholder="Password"
                                                                            class="form-control" type="password"
                                                                            name="password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button id="discard" class="btn btn-outline-primary"
                                                                data-dismiss="modal">Discard</button>
                                                            <button id="add-event" class="btn btn-primary eventbutton"
                                                                type="submit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <a href="#" class="btn btn-outline-success font-w-600 my-auto text-nowrap ml-auto disabled">
                                        <i class="icofont-check-circled"></i> Success</a><br />
                                    @endif
                                </td>
                                <td>{{ $encashment->created_at }}</td>
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
