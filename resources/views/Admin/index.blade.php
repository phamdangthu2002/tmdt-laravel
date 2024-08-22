<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body>
    <header>
        <!-- Navbar -->

    </header>
    <div class="row">
        <div class="col-md-2">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-10">
            <!-- Content -->
            @include('layouts.headerAdmin')
            <div id="content" class="w-100">
                <!-- Main Content -->
                @yield('content')
            </div>
        </div>
    </div>

    @include('layouts.script')
</body>

</html>
