@extends('admin.templates.layout')

@section('content')
<div class="row">
    <div class="col-12 col-lg-3 col-xl-2 mb-4 mt-3 pr-lg-0 flip-menu">
        <a href="#" class="d-inline-block d-lg-none mt-1 flip-menu-close"><i class="icon-close"></i></a>
        <div class="card border h-100 mail-menu-section ">
            <div class="media d-block text-center  p-3">
                <a href="{{ url('notifications') }}" class="bg-primary w-100 d-block py-2 px-2 rounded text-white">
                    <i class="icon-refresh align-middle text-white"></i> <span>Refresh</span>
                </a>
            </div>
            <ul class="list-unstyled inbox-nav mb-0 mt-2 mail-menu">
                <li class="nav-item"><a href="#" data-mailtype="0" class="nav-link active"><i
                            class="icon-envelope pr-2"></i> Unread <span
                            class="ml-auto badge badge-pill badge-danger bg-danger">
                            @php
                                echo (App\Models\Notifications::countUnread());
                            @endphp
                            </span></a></li>
                <li class="nav-item"><a href="#" data-mailtype="1" class="nav-link"><i
                            class="icon-envelope-open pr-2"></i> Read</a></li>
            </ul>
            <div class="eagle-divider"></div>
        </div>
    </div>
    <div class="col-12 col-lg-9 col-xl-10 mb-4 mt-3 pl-lg-0">
        <div class="card border h-100 mail-list-section">
            <div class="card-header border-bottom p-2 d-flex">
                <a href="#" class="d-inline-block d-lg-none flip-menu-toggle"><i class="icon-menu"></i></a>
                <input type="text" class="form-control border-0  w-100 h-100 mail-search" placeholder="Search ...">
            </div>
            <div class="card-body p-0">
                <div class="row m-0 border-bottom theme-border">
                    <div class="col-12 px-2 py-3 d-flex mail-toolbar">
                        <div class="check d-inline-block mr-3">
                        </div>
                        <a href="#" class="ml-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="icon-settings"></i></a>
                                <div class="dropdown-menu p-0 m-0 dropdown-menu-right mail-bulk-action">
                                    <a class="dropdown-item mailread" href="/notifications/readAll"><i class="icon-book-open"></i> Mark all as
                                        Read</a>
                                    <a class="dropdown-item mailunread" href="/notifications/unreadAll"><i class="icon-notebook"></i> Mark all as
                                        unread</a>
                                </div>
                    </div>
                </div>
                <div class="scrollertodo">
                    <ul class="mail-app list-unstyled">
                        @foreach ($notifications as $item)
                        <li class="py-3 px-2 mail-item {{ $item->status }} unread personal-mail starred important">
                            <div class="d-flex align-self-center align-middle">
                                <div class="mail-content d-md-flex w-100">
                                    <span class="mail-user">{{ $item->title }}</span>
                                    <p class="mail-subject">{{ $item->message }}</p>
                                    <div class="d-flex mt-3 mt-md-0 ml-auto">
                                        <p class="ml-auto mail-date mb-0">{{ $item->created_at }}</p>
                                        <a href="#" class="ml-3" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="icon-options-vertical"></i></a>
                                        <div class="dropdown-menu p-0 m-0 dropdown-menu-right">
                                            <a class="dropdown-item single-read" href="/notifications/read/{{ $item->id }}"><i class="icon-book-open"></i>
                                                Mark as Read</a>
                                            <a class="dropdown-item single-unread" href="/notifications/unread/{{ $item->id }}"><i
                                                    class="icon-notebook"></i> Mark as unread</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
