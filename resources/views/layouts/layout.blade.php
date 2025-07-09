<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCare | Sistema Veterinário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-paw"></i>
                    <span>PetCare</span>
                </div>
                <button class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <nav class="sidebar-nav">
                <ul>
                    <li class="{{ Route::is('Index') ? 'active' : '' }}">
                        <a href="{{ route('Index') }}">
                            <i class="fas fa-paw"></i>
                            <span>Pacientes</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('Clinicas') ? 'active' : '' }}">
                        <a href="{{ route('Clinicas') }}">
                            <i class="fa-solid fa-house-chimney-medical"></i>
                            <span>Clínicas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-calendar-check"></i>
                            <span>Consultas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-file-medical"></i>
                            <span>Prontuários</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-chart-line"></i>
                            <span>Relatórios</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-cog"></i>
                            <span>Configurações</span>
                        </a>
                    </li>
                </ul>
            </nav>


            <div class="user-profile">
                <div class="avatar">
                    <img src="{{ asset('images/default-profile-pic.jpg') }}" alt="Veterinária">
                </div>
                <div class="user-info">
                    <span class="name">{{ $nomeUsuario }}</span>
                    <span class="role">Veterinária</span>
                </div>
                <button class="logout-btn">
                    <a href="{{ route('LogOut') }}" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </button>
            </div>
        </aside>

        <div class="sidebar-overlay"></div>

        <main class="main-content">
            @yield('content')
        </main>

    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

<script>

    $(document).ready(function() {
        // Toggle sidebar em telas pequenas
        $('.menu-toggle').click(function(e) {
            e.stopPropagation();
            $('.sidebar').toggleClass('active');

        });

        // Fechar sidebar ao clicar no overlay ou fora
        $('.sidebar-overlay').click(function() {
            $('.sidebar').removeClass('active');
        });

        $(document).click(function(e) {
            if (!$(e.target).closest('.sidebar').length && !$(e.target).is('.menu-toggle')) {
                $('.sidebar').removeClass('active');
            }
        });

        // Fechar sidebar ao redimensionar para tela maior
        $(window).resize(function() {
            if ($(window).width() > 992) {
                $('.sidebar').removeClass('active');
            }
        });
    });
</script>
@stack('scripts')
</body>
</html>