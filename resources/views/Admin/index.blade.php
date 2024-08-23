<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    <style>
        body {
            /* background-color: rgb(207, 207, 207); */
            background-color: rgb(194, 201, 201);
        }

        .left-sidebar {
            background-color: rgb(156, 173, 173);
            height: 200vh;
        }
    </style>
</head>

<body>
    <header>
        <!-- Navbar -->

    </header>
    <div class="row">
        <div class="col-md-2 left-sidebar">
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
