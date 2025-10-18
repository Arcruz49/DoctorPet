<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DoctorPet | Acesso ao Sistema</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <style>
        
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="login-container row">
                
            <div class="col-md-12 login-form">
                <div class="logo">
                    <i class="fas fa-paw logo-icon"></i>
                    <span class="logo-text">DoctorPet</span>
                </div>
                
                <h1 class="welcome-title">Acesse sua conta</h1>
                <p class="welcome-subtitle">Entre com seu login e senha para continuar</p>
                
                <form id="loginForm">
                    @csrf

                    <div class="mb-3">
                        <input type="text" class="form-control" id="login" name="login" placeholder="Login " required>
                    </div>
                    
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Senha" required>
                    </div>
                    
                    <div class="remember-forgot d-flex justify-content-center">
                        <a href="#" class="forgot-password">Esqueceu a senha?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i> Entrar
                    </button>
                    
                    <div class="divider">ou</div>
                    
                    <p class="register-link">
                        Não tem uma conta? <a href="#">Solicitar acesso</a>
                    </p>
                </form>
            </div>
        </div>
    </div>




    <div id="loadingModal" class="loading-modal">
        <div class="loading-content">
            <img src="{{ asset('images/morgana_loading.GIF') }}" alt="Carregando..." class="loading-gif">
            <p>Carregando...</p>
        </div>
    </div>

    <script src="{{ asset('js/bootstrapbundle.js') }}"></script>

    <script src="{{ asset('js/jquery.js') }}"></script>

</body>

<script>
    $(document).ready(function () {
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();

            const login = $('#login').val().trim();
            const senha = $('#password').val().trim();

            $.ajax({
                url: '/tryLogin', 
                type: 'POST',
                data: {
                    login: login,
                    password: senha
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                success: function (response) {
                    if (response.success === true) {
                        window.location.href = "/"
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Erro:", xhr.responseText);
                    alert('Erro ao tentar fazer login.');
                }
            });
        });
    });


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

</html>