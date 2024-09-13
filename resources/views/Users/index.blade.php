<!DOCTYPE html>
<html lang="en">

<head>
    {{-- head --}}
    @include('Users.layouts.head')
</head>

<body>
    {{-- lớp phủ --}}
    <div class="overlay" id="overlay"></div>
    {{-- header --}}
    @include('Users.layouts.header')
    {{-- giỏ hàng --}}
    {{-- @include('Users.review.index') --}}
    {{-- main --}}
    {{-- content --}}
    <div id="content" class="w-100">
        <!-- Main Content -->
        @yield('main')
    </div>
    {{-- footer --}}
    @include('Users.layouts.footer')
    {{-- script --}}
    @include('Users.layouts.script')

</body>

</html>
