<style>
    #header {
        border-bottom: 1px solid black;
        border-top: 1px solid black;
    }
</style>
<nav id="header" class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.index') }}">
            <h2>Trang Admin</h2>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
