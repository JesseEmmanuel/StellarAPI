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
                                    <a href="encashment/verify/{{ $encashment->logID }}"
                                        class="btn btn-outline-danger font-w-600 my-auto text-nowrap ml-auto add-event">
                                        <i class="icofont-exclamation-circle"></i> Not Yet</a><br />
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
