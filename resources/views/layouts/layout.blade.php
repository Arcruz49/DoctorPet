<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoctorPet | Sistema Veterinário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/fonts.css') }}"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/notyf.css') }}">
    <link href="{{ asset('css/bootstrap.css') }}"rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-paw"></i>
                    <span>DoctorPet</span>
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
                    <li class="{{ Route::is('Consultas') ? 'active' : '' }}">
                        <a href="{{ route('Consultas') }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Consultas</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('Modelos') ? 'active' : '' }}">
                        <a href="{{ route('Modelos') }}">
                            <i class="fas fa-file-medical"></i>
                            <span>Documentos</span>
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
                    <span class="role">{{ $perfilUsuario }}</span>
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

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/notyf.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>

    <script>

        $(document).ready(function () {
            // Toggle sidebar em telas pequenas
            $('.menu-toggle').click(function (e) {
                e.stopPropagation();
                $('.sidebar').toggleClass('active');

            });

            // Fechar sidebar ao clicar no overlay ou fora
            $('.sidebar-overlay').click(function () {
                $('.sidebar').removeClass('active');
            });

            $(document).click(function (e) {
                if (!$(e.target).closest('.sidebar').length && !$(e.target).is('.menu-toggle')) {
                    $('.sidebar').removeClass('active');
                }
            });

            // Fechar sidebar ao redimensionar para tela maior
            $(window).resize(function () {
                if ($(window).width() > 992) {
                    $('.sidebar').removeClass('active');
                }
            });
        });
    </script>
    @stack('scripts')



    <div id="loadingModal" class="loading-modal">
        <div class="loading-content">
            <img src="{{ asset('images/morgana_loading.GIF') }}" alt="Carregando..." class="loading-gif">
            <p>Carregando...</p>
        </div>
    </div>
</body>

</html>

<script>
    function showLoading() {
        $('#loadingModal').addClass('active');
    }

    function hideLoading() {
        $('#loadingModal').removeClass('active');
    }

    $(document).ajaxStart(function () {
        showLoading();
    });

    $(document).ajaxStop(function () {
        hideLoading();
    });

    
</script>
