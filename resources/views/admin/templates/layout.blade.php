@include('admin.templates.head')
@include('admin.templates.header')
@include('admin.templates.sidebar')
<main>
    <div class="container-fluid site-width">
        @yield('content')
    </div>
</main>
<a href="#" class="scrollup text-center">
    <i class="icon-arrow-up"></i>
</a>
@include('admin.templates.scripts')
