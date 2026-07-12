<!DOCTYPE html>
<html lang="en">

@include('admin.partials.head')

<body>

    @include('admin.partials.navbar')

    <div class="container-fluid">
        <div class="row">

            @include('admin.partials.sidebar')

            <main class="col-md-10 ms-sm-auto px-4 py-4">
                @yield('content')
            </main>

        </div>
    </div>

    @include('admin.partials.footer')
    @include('admin.partials.script')

    @stack('scripts')

</body>
</html>