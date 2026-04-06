<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('images/icon.png') }}">
    <title>CC Monitoring</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            overflow-x: hidden;
        }

        /* Sidebar styling */
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background-color: white;
            border-right: 1px solid #dee2e6;
            color: #212529;
            transition: transform 0.3s ease;
            padding-top: 1rem;
        }

        #sidebar .logo {
            height: 44px;
            background-color: #f8f9fa;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
            padding: 0 1rem;
            line-height: 1;
            /* Avoid extra line height */
            text-align: center;
            /* Just in case */
        }

        /* Section headers */
        .sidebar-section {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #6c757d;
            padding: 1rem 1.5rem 0.5rem 1.5rem;
            letter-spacing: 0.05em;
        }

        /* Sidebar links */
        #sidebar .nav-link {
            color: #212529;
            display: flex;
            align-items: center;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            text-decoration: none;
        }

        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background-color: #e9ecef;
            color: #0d6efd;
        }

        /* Icons */
        #sidebar .nav-link .bi {
            font-size: 1.25rem;
            margin-right: 12px;
            min-width: 24px;
            /* for alignment */
            text-align: center;
        }

        /* Badge */
        #sidebar .badge {
            margin-left: auto;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Top navbar styling */
        #top-navbar {
            height: 60px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            padding: 0 20px;
            justify-content: space-between;
        }

        /* Content area */
        #content {
            padding: 20px;
        }

        /* Layout adjustments */
        .main-area {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        /* Sidebar toggle for small screens */
        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                transform: translateX(-100%);
                z-index: 1030;
            }

            #sidebar.show {
                transform: translateX(0);
            }

            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1020;
                display: none;
            }

            .overlay.show {
                display: block;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!-- Overlay for small screens -->
    <div class="overlay" id="overlay"></div>

    <div class="d-flex">
        <!-- Sidebar -->
         @include('components.sidebar')
        
        <!-- <nav id="sidebar" class="d-flex flex-column">
            <div class="logo">
                CC Monitoring
            </div>

            <div class="sidebar-section">Main</div>
            <a href="#" class="nav-link">
                <i class="bi bi-house-fill"></i>
                Dashboard
            </a>

            <div class="sidebar-section">General</div>
            <a href="#" class="nav-link">
                <i class="bi bi-emoji-smile"></i>
                Icons
            </a>
        </nav> -->

        <!-- Main content + Navbar -->
        <div class="main-area">
            <!-- Top Navbar -->
            @include('components.navbar')
            <!-- <div id="top-navbar">
                <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle">
                    ☰
                </button>
            </div> -->

            <!-- Main Content -->
            <div id="content">
                 <!-- Main Content Here -->
                  @yield('content')
            </div>
        </div> 
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            });
        @endif

    
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>

</body>
</html>