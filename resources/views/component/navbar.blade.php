<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Gunungkidul</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        .custom-navbar {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.95), rgba(118, 75, 162, 0.95)) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            color: white !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: #4ecdc4 !important;
            transform: scale(1.05);
        }

        .navbar-brand i {
            font-size: 1.8rem;
            color: #4ecdc4;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.75rem 1rem !important;
            border-radius: 25px;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .navbar-nav .nav-link:hover::before {
            left: 100%;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link.active {
            background: rgba(78, 205, 196, 0.3) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3);
        }

        .navbar-nav .nav-link i {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            color: #333 !important;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 0;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white !important;
            transform: translateX(5px);
        }

        .btn-link {
            color: rgba(255, 255, 255, 0.9) !important;
            text-decoration: none !important;
            font-weight: 500;
            padding: 0.75rem 1rem !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            border: none !important;
        }

        .btn-link:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            color: white !important;
        }

        .text-danger {
            color: #ff6b6b !important;
        }

        .text-danger:hover {
            background: rgba(255, 107, 107, 0.2) !important;
            color: #ff6b6b !important;
        }

        .text-primary {
            color: #4ecdc4 !important;
        }

        .text-primary:hover {
            background: rgba(78, 205, 196, 0.2) !important;
            color: #4ecdc4 !important;
        }

        .navbar-toggler {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(78, 205, 196, 0.3);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 15px;
                margin-top: 1rem;
                padding: 1rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .navbar-nav .nav-link {
                color: #333 !important;
                margin: 0.25rem 0;
            }

            .navbar-nav .nav-link:hover {
                background: linear-gradient(135deg, #667eea, #764ba2);
                color: white !important;
            }

            .btn-link {
                color: #ff6b6b !important;
            }

            .text-primary {
                color: #4ecdc4 !important;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fa-solid fa-earth-asia"></i> Explore Gunungkidul
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">
                            <i class="fa-solid fa-house"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('map') ? 'active' : '' }}"
                            href="{{ route('map') }}">
                            <i class="fa-solid fa-layer-group"></i> Peta
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('table') ? 'active' : '' }}"
                            href="{{ route('table') }}">
                            <i class="fa-solid fa-table"></i> Tabel
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-database"></i> Data
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('api.points') }}" target="_blank">
                                <i class="fa-solid fa-map-pin me-2"></i> Points
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('api.polyline') }}" target="_blank">
                                <i class="fa-solid fa-route me-2"></i> Polylines
                            </a></li>
                            {{-- <li><a class="dropdown-item" href="{{ route('api.polygon') }}" target="_blank">Polygons</a></li> --}}
                        </ul>
                    </li>
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button class="nav-link text-danger btn btn-link" type="submit">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('map') ? 'active' : '' }}" href="{{ route('map') }}">
                            <i class="fa-solid fa-layer-group"></i> Map
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                            <i class="fa-solid fa-right-to-bracket"></i> Login
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
