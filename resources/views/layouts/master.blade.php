@auth
    <meta name="user-name" content="{{ Auth::user()->user_name }}">
    <meta name="user-id" content="{{ Auth::user()->id }}">
@endauth

<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body>

    @auth
        @include('components.receipt-modal')
    @endauth

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @include('partials.script')

</body>

</html>