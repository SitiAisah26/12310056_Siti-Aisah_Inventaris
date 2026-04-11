<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris | Smart Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; color: #1a1a1a; }
        
        /* NAVBAR */
        .navbar { padding: 20px 0; background: transparent; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; color: #5a35a0 !important; }

        /* HERO SECTION */
        .hero { padding: 100px 0; background: radial-gradient(circle at top right, #f3f0ff, #ffffff); }
        .hero h1 { font-weight: 800; font-size: 3.5rem; line-height: 1.2; margin-bottom: 20px; color: #2d1a5a; }
        .hero p { font-size: 1.1rem; color: #666; margin-bottom: 35px; max-width: 500px; }

        /* BUTTONS */
        .btn-primary-custom {
            background-color: #5a35a0;
            color: white;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: none;
        }
        .btn-primary-custom:hover {
            background-color: #482a80;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(90, 53, 160, 0.2);
            color: white;
        }

        /* LOGO / ICON BOX */
        .icon-box {
            width: 80px;
            height: 80px;
            background: #f0ebff;
            color: #5a35a0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            font-size: 2rem;
            margin-bottom: 25px;
        }

        /* BADGE */
        .badge-new {
            background-color: #e0d4ff;
            color: #5a35a0;
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-archive me-2"></i>INVENTARIS</a>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1>Manage your assets in one simple place</h1>
                    <p>Sistem manajemen inventaris yang efisien untuk Admin dan Operator. Pantau stok, peminjaman, dan kategori secara real-time.</p>
                    
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary-custom">
                                Dashboard <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-primary-custom">
                                Login <i class="fas fa-sign-in-alt"></i>
                            </a>
                        @endauth
                    @endif
                </div>
                
                <div class="col-lg-5 offset-lg-1">
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="card border-0 shadow-sm p-4 text-center">
                                <div class="icon-box mx-auto"><i class="fas fa-boxes-stacked"></i></div>
                                <h6 class="fw-bold">Items</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card border-0 shadow-sm p-4 text-center" style="margin-top: 30px;">
                                <div class="icon-box mx-auto"><i class="fas fa-handshake"></i></div>
                                <h6 class="fw-bold">Lendings</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>