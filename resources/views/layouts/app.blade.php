<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard')</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('sb-admin/css/styles.css') }}" rel="stylesheet" />

    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

<!-- NAVBAR -->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="#">Inventaris</a>
    <button class="btn btn-link btn-sm" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>
    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary ">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</form>
</nav>

<div id="layoutSidenav">

    <!-- SIDEBAR -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <div class="sb-sidenav-menu-heading">Menu</div>

                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        Dashboard
                    </a>

                    <a class="nav-link {{ request()->is('categories') ? 'active' : '' }}" href="/categories">
                        <i class="fas fa-list me-2"></i>
                        Categories
                    </a>

                    <a class="nav-link {{ request()->is('items') ? 'active' : '' }}" href="/items">
                        <i class="fas fa-box me-2"></i>
                        Items
                    </a>

                    <!-- <a class="nav-link {{ request()->is('lendings') ? 'active' : '' }}" href="/lendings">
                        <i class="fas fa-handshake me-2"></i>
                        Lending
                    </a> -->

                     <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="/users">
                        <i class="fas fa-user me-2"></i>
                        User
                    </a>

                </div>
            </div>
        </nav>
    </div>

    <!-- CONTENT -->
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mt-3">
                @yield('content')
            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="text-muted small">Inventaris System</div>
            </div>
        </footer>
    </div>

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('sb-admin/js/scripts.js') }}"></script>

</body>
</html>

<style>
/* SIDEBAR LILAC */
.sb-sidenav {
    background: #8668be !important;
}

/* LINK */
.sb-sidenav .nav-link {
    color: #fff !important;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 15px;
    margin: 4px 8px;
    border-radius: 8px;
    transition: 0.3s;
}

/* HOVER */
.sb-sidenav .nav-link:hover {
    background: #7557ad;
}

/* ACTIVE */
.sb-sidenav .nav-link.active {
    background: #6a4fb0;
}

/* HEADING */
.sb-sidenav-menu-heading {
    color: #e0d4ff !important;
    font-size: 12px;
}

/* NAVBAR */
.sb-topnav {
    background: #5a35a0 !important;
}

/* BUTTON */
.btn-primary {
    background-color: #a084dc;
    border: none;
}

.btn-primary:hover {
    background-color: #8c6cd6;
}

/* CARD */
.card {
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
</style>