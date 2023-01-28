@include('admin.templates.head')
@include('admin.templates.sidebar')
@include('admin.templates.header')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        @yield('content')
    </div>
</div>
@include('admin.templates.footer')
