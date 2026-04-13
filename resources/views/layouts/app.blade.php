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
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark px-3">
    <a class="navbar-brand fw-bold" href="#">
        <i class="fas fa-boxes me-2"></i>INVENTARIS
    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="ms-auto"></div>

    <ul class="navbar-nav ms-auto ms-md-0">
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </button>
        </form>
    </ul>
</nav>

<div id="layoutSidenav">

    <!-- SIDEBAR -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark">
            <div class="sb-sidenav-menu">
                <div class="nav">
    <div class="nav">
    <div class="sb-sidenav-menu-heading">Menu</div>

    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
        <i class="fas fa-tachometer-alt me-2"></i>
        Dashboard
    </a>

    <div class="sb-sidenav-menu-heading">Items Data</div>

    @if(Auth::user()->role != 'admin')
    <a class="nav-link {{ request()->is('lendings*') ? 'active' : '' }}" href="/lendings">
        <i class="fas fa-sync me-2"></i>
        Lending
    </a>
    @endif
    
    @if(Auth::user()->role == 'admin')
    <a class="nav-link {{ request()->is('categories') ? 'active' : '' }}" href="/categories">
        <i class="fas fa-list me-2"></i>
        Categories
    </a>
    @endif

    <a class="nav-link {{ request()->is('items') ? 'active' : '' }}" href="/items">
        <i class="fas fa-box me-2"></i>
        Items
    </a>
    </div>

    <div class="sb-sidenav-menu-heading">Account</div>

    <a class="nav-link collapsed {{ request()->is('users*') ? 'active' : '' }}" href="#" 
       data-bs-toggle="collapse" data-bs-target="#collapseUsers" 
       aria-expanded="false" aria-controls="collapseUsers">
        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
        Users
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>

    <div class="collapse {{ request()->is('users*') ? 'show' : '' }}" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
            @if(Auth::user()->role == 'admin')
                <a class="nav-link {{ request()->is('users/admin/index') ? 'fw-bold text-white' : '' }}" href="{{ route('users.admin.index') }}">
                    Admin
                </a>
                <a class="nav-link {{ request()->is('users/operator/index') ? 'fw-bold text-white' : '' }}" href="{{ route('users.operator.index') }}">
                    Operator
                </a>
            @else
                <a class="nav-link {{ request()->is('users/*/edit') ? 'fw-bold text-white' : '' }}" href="{{ route('users.edit', Auth::user()->id) }}">
                    Edit
                </a>
            @endif
        </nav>
    </div>
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