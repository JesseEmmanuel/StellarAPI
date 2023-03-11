@extends('admin.templates.layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('message')

        @yield('content')
        <div class="card mt-5">
            <div class="card-body">
                <div class="card-body d-md-flex text-center">
                    <ul class="nav nav-pills flex-column flex-sm-row">
                        <li class="nav-item">
                            <a class="nav-link body-color h6 mb-0 active" data-toggle="tab" href="#usedCodes"> Used Codes
                                ( @php echo (App\Models\ActivationCodes::countUsedCodes()); @endphp )
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link body-color h6 mb-0" data-toggle="tab" href="#unusedCodes"> Unused Codes
                                ( @php echo (App\Models\ActivationCodes::countUnusedCodes()); @endphp )
                            </a>
                        </li>
                    </ul>
                    <a href="/activationCodes/newCode" class="btn btn-outline-secondary font-w-600 my-auto text-nowrap ml-auto add-event"> Add Code</a>
                </div>
                <div class="tab-content mt-1" id="myTabContent">
                    <div class="tab-pane fade show active" id="usedCodes" role="tabpanel" aria-labelledby="usedCodes">
                        <div class="table-responsive">
                            <table id="example" class="display table dataTable table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Activation Code</th>
                                        <th>Owner</th>
                                        <th>Date/Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usedCodes as $code)
                                    <tr>
                                        <td>{{ $code->activationCode }}</td>
                                        <td>{{ $code->userName }}</td>
                                        <td>{{ $code->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="unusedCodes" role="tabpanel"
                        aria-labelledby="unusedCodes">
                        <table id="example" class="display table dataTable table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Activation Code</th>
                                    <th>Date/Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unusedCodes as $code)
                                <tr>
                                    <td>{{ $code->activationCode }}</td>
                                    <td>{{ $code->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
