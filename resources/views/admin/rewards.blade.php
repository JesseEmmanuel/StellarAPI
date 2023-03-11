@extends('admin.templates.layout')

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        @include('message')

        @yield('content')
        <div class="card">
            <div class="card">
                <div class="card-body d-md-flex text-center">
                    <h4 class="modal-title" id="model-header">Rewards Log</h4>
                </div>
            </div>
            <div class="card-header  justify-content-between align-items-center">
                <h4 class="card-title">List of rewards</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display table dataTable table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Rewards Item</th>
                                <th>Owner</th>
                                <th>Status</th>
                                <th>Date/Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rewards as $reward)
                            <tr>
                                <td>{{ $reward->rewardsItem }}</td>
                                <td>{{ $reward->firstName." ".$reward->middleName." ".$reward->lastName }}</td>
                                <td>
                                    @if ($reward->redeemStatus === 0)

                                    <a href="/rewards/redeem/{{ $reward->id }}" class="btn btn-outline-danger font-w-600 my-auto text-nowrap ml-auto add-event">
                                        <i class="icofont-exclamation-circle"></i> Unclaimed </a><br />

                                    @else
                                    <a href="#" class="btn btn-outline-success font-w-600 my-auto text-nowrap ml-auto disabled">
                                        <i class="icofont-check-circled"></i> Claimed </a><br />
                                    @endif
                                </td>
                                <td>{{ $reward->created_at }}</td>
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
