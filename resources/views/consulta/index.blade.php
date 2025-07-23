<!DOCTYPE html>
<html lang="pt-BR">

<head>

</head>

<body>

    @extends('layouts.layout')

    @section('content')
        <header class="main-header">
            <h1>Consultas</h1>
            <div class="header-actions">
                <div class="search-box">
                    <input type="text" id="search" placeholder="Buscar consulta...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <button class="btn primary new-clinic">
                    <i class="fas fa-plus"></i>
                    Nova Consulta
                </button>
            </div>
        </header>

        <div class="content-wrapper">
            <!-- Filtros -->
            <div class="filters">
                <div class="filter-group">
                    <label>Ordenar por:</label>
                    <select class="filter" id="searchOrder">
                        <option value="recentes">Mais recentes</option>
                        <option value="antigos">Mais antigos</option>
                        <option value="nome">Nome (A-Z)</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Exibir:</label>
                    <select class="filter" id="searchExibir">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="-1">Todos</option>
                    </select>
                </div>
            </div>

            <div class="consultas-grid" id="ConsultasContainer">

                <div class="space-y-5">
                    <div>
                        <h2 class="h6 text-secondary fw-semibold mb-3 pb-2 border-bottom">HOJE, 25 DE JULHO DE 2024</h2>
                        <!-- Appointment Card 1 -->
                        <div class="card card-appointment mb-3">
                            <div class="card-body p-3 d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                <div class="text-sm-center" style="flex: 0 0 100px;">
                                    <p class="fs-5 fw-bold m-0">14:30</p>
                                    <div
                                        class="d-flex align-items-center justify-content-start justify-content-sm-center gap-1 mt-1">
                                        <div class="status-dot bg-primary"></div>
                                        <span class="small fw-medium text-primary">Agendada</span>
                                    </div>
                                </div>
                                <div class="d-none d-sm-block vr p-0 mx-2"></div>
                                <div class="flex-grow-1">
                                    <p class="fw-bold fs-6 m-0">Morgana</p>
                                    <div class="d-flex flex-column flex-sm-row small text-secondary mt-1"
                                        style="gap: 0.25rem 1rem;">
                                        <span><i class="fa-solid fa-paw me-2 text-muted"></i>Galgo Italiano</span>
                                        <span><i class="fa-solid fa-user-md me-2 text-muted"></i>Dr. Ricardo Alves</span>
                                        <span><i class="fa-solid fa-user-shield me-2 text-muted"></i>Tutor: Arthur
                                            Cruz</span>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 mt-2 mt-sm-0">
                                    <button class="btn btn-sm btn-confirm px-3">Confirmar</button>
                                    <button class="btn btn-sm btn-reschedule px-3">Reagendar</button>
                                </div>
                            </div>
                        </div>
                        <!-- Appointment Card 2 -->
                        <div class="card card-appointment mb-3">
                            <div class="card-body p-3 d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                <div class="text-sm-center" style="flex: 0 0 100px;">
                                    <p class="fs-5 fw-bold m-0">16:00</p>
                                    <div
                                        class="d-flex align-items-center justify-content-start justify-content-sm-center gap-1 mt-1">
                                        <div class="status-dot bg-success"></div>
                                        <span class="small fw-medium text-success">Confirmada</span>
                                    </div>
                                </div>
                                <div class="d-none d-sm-block vr p-0 mx-2"></div>
                                <div class="flex-grow-1">
                                    <p class="fw-bold fs-6 m-0">Biscoito</p>
                                    <div class="d-flex flex-column flex-sm-row small text-secondary mt-1"
                                        style="gap: 0.25rem 1rem;">
                                        <span><i class="fa-solid fa-paw me-2 text-muted"></i>Golden Retriever</span>
                                        <span><i class="fa-solid fa-user-md me-2 text-muted"></i>Dra. Juliana Martins</span>
                                        <span><i class="fa-solid fa-user-shield me-2 text-muted"></i>Tutora: Mariana
                                            Lima</span>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 mt-2 mt-sm-0">
                                    <button class="btn btn-sm btn-primary px-3">Atender</button>
                                    <button class="btn btn-sm btn-cancel px-3">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2 class="h6 text-secondary fw-semibold mb-3 pb-2 border-bottom">AMANHÃ, 26 DE JULHO DE 2024</h2>
                        <!-- Appointment Card 3 -->
                        <div class="card card-appointment mb-3 opacity-75">
                            <div class="card-body p-3 d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                <div class="text-sm-center" style="flex: 0 0 100px;">
                                    <p class="fs-5 fw-bold m-0 text-decoration-line-through text-muted">09:00</p>
                                    <div
                                        class="d-flex align-items-center justify-content-start justify-content-sm-center gap-1 mt-1">
                                        <div class="status-dot bg-secondary"></div>
                                        <span class="small fw-medium text-secondary">Realizada</span>
                                    </div>
                                </div>
                                <div class="d-none d-sm-block vr p-0 mx-2"></div>
                                <div class="flex-grow-1">
                                    <p class="fw-bold fs-6 m-0 text-muted">Paçoca</p>
                                    <div class="d-flex flex-column flex-sm-row small text-secondary mt-1"
                                        style="gap: 0.25rem 1rem;">
                                        <span><i class="fa-solid fa-paw me-2 text-muted"></i>Vira-lata</span>
                                        <span><i class="fa-solid fa-user-md me-2 text-muted"></i>Dr. Ricardo Alves</span>
                                        <span><i class="fa-solid fa-user-shield me-2 text-muted"></i>Tutor: Felipe
                                            Souza</span>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 mt-2 mt-sm-0">
                                    <button class="btn btn-sm btn-outline-secondary px-3">Ver Prontuário</button>
                                </div>
                            </div>
                        </div>
                        <!-- Appointment Card 4 -->
                        <div class="card card-appointment mb-3" style="background-color: #f8d7da30;">
                            <div
                                class="card-body p-3 d-flex flex-column flex-sm-row align-items-sm-center gap-3 opacity-75">
                                <div class="text-sm-center" style="flex: 0 0 100px;">
                                    <p class="fs-5 fw-bold m-0 text-decoration-line-through text-danger">11:30</p>
                                    <div
                                        class="d-flex align-items-center justify-content-start justify-content-sm-center gap-1 mt-1">
                                        <div class="status-dot bg-danger"></div>
                                        <span class="small fw-medium text-danger">Cancelada</span>
                                    </div>
                                </div>
                                <div class="d-none d-sm-block vr p-0 mx-2"></div>
                                <div class="flex-grow-1">
                                    <p class="fw-bold fs-6 m-0 text-muted">Thor</p>
                                    <div class="d-flex flex-column flex-sm-row small text-secondary mt-1"
                                        style="gap: 0.25rem 1rem;">
                                        <span><i class="fa-solid fa-paw me-2 text-muted"></i>Bulldog Francês</span>
                                        <span><i class="fa-solid fa-user-md me-2 text-muted"></i>Dr. Fernando Costa</span>
                                        <span><i class="fa-solid fa-user-shield me-2 text-muted"></i>Tutora: Carla
                                            Dias</span>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 mt-2 mt-sm-0">
                                    <button class="btn btn-sm btn-outline-secondary px-3">Ver Detalhes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <div class="modal-overlay" id="consultaModal">
            @include('modal.modalConsulta')
        </div>

        <div class="modal-overlay" id="addPacienteModal">
            @include('modal.modalAdicionarPaciente')
        </div>


    @endsection

    @push('scripts')

        <script>


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).ready(function () {

                // $('#btnAbrirModalPaciente').on('click', function (e) {
                //     debugger
                //     e.preventDefault();
                //     $('#addPacienteModal').fadeIn(); // ou .show() se preferir sem animação
                // });

                // Para fechar o modal de paciente
                $(document).on('click', '.close-modal, .modal-overlay', function (e) {
                    // Verifica se clicou diretamente no overlay (fora do conteúdo)
                    if ($(e.target).hasClass('modal-overlay') || $(e.target).hasClass('close-modal')) {
                        $('#addPacienteModal').fadeOut(); // ou .hide()
                    }
                });

                carregarPacientes();

                $('.filter').on('change', function () {
                    carregarPacientes();
                });

                $('#search').on('input', function () {
                    carregarPacientes();
                });


                $(document).on('click', '.new-clinic, .add-clinic-btn', function () {
                    $('#modalTitleConsulta').text('Nova Clínica'); // Corrigido o ID do título
                    $('.modal-footer').show();
                    limparFormulario();

                    $('#consultaForm')[0].reset();

                    $('.add-patient-card').html(`
                        <div id="btnAbrirModalPaciente">
                            <button type="button" class="add-patient-btn">
                                <i class="fas fa-plus-circle"></i>
                                <span>Adicionar Paciente</span>
                            </button>
                        </div>
                    `);

                    $('#consultaModal').addClass('active');
                });

                $(document).on('click', '#btnAbrirModalPaciente', function () {
                    $('#consultaModal').removeClass('active');
                    $('#addPacienteModal').addClass('active');
                });

                // Fechar modal
                $('.close-modal, .btn.secondary').click(function () {
                    $('#consultaModal').removeClass('active');
                });

                // Visualizar clinica
                $('.icon-btn.view').click(function () {
                    // Aqui você implementaria a lógica para visualizar clinica
                    alert('Visualizar paciente - implementar lógica');
                });

                // Editar clinica
                $('.icon-btn.edit').click(function () {
                    // Aqui você implementaria a lógica para editar clinica
                    $('#consultaModal').addClass('active');
                    $('.modal-header h2').text('Editar Paciente');
                });

                // Buscar clinicas
                $('.search-box button').click(function () {
                    const searchTerm = $('.search-box input').val().toLowerCase();
                    if (searchTerm) {
                        $('.patient-card').each(function () {
                            const cardText = $(this).text().toLowerCase();
                            $(this).toggle(cardText.includes(searchTerm));
                        });
                    } else {
                        $('.patient-card').show();
                    }
                });

                // Permitir busca com Enter
                $('.search-box input').keypress(function (e) {
                    if (e.which === 13) {
                        $('.search-box button').click();
                    }
                });

                // Fechar modal ao clicar fora
                // $(document).click(function(e) {
                //     if ($(e.target).hasClass('modal-overlay')) {
                //         $('#consultaModal').removeClass('active');
                //     }
                // });

                // // Simular envio do formulário
                // $('#consultaModal').submit(function(e) {
                //     e.preventDefault();
                //     // Aqui você implementaria o AJAX para salvar o paciente
                //     alert('Paciente salvo com sucesso! (implementar lógica de envio)');
                //     $('#consultaModal').removeClass('active');
                // });


                $('.tab-button').click(function () {
                    // Remove a classe active de todos os botões e conteúdos
                    $('.tab-button').removeClass('active');
                    $('.tab-content').removeClass('active');

                    // Adiciona a classe active ao botão clicado
                    $(this).addClass('active');

                    // Mostra o conteúdo correspondente
                    const tabId = $(this).data('tab') + '-tab';
                    $('#' + tabId).addClass('active');
                });


                $('#btnSalvarConsulta').on('click', function () {
                    const form = $('#consultaForm')[0];
                    const formData = new FormData(form);
                    const notyf = new Notyf();

                    let url = '/createConsulta';

                    // if ($('#cdClinica').val() !== "") {
                    //     url = '/editClinica';
                    // }
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.success === true) {
                                notyf.success(response.message);
                                $('#consultaModal').removeClass('active');
                                carregarPacientes();
                            } else {
                                notyf.error(response.message || 'Ocorreu um erro ao salvar.');
                            }
                        },
                        error: function () {
                            notyf.error('Erro ao salvar consulta.');
                        }
                    });
                });


            });


            function visualizarClinica(cdClinica, editar) {
                $.ajax({
                    url: `/getClinica/${cdClinica}`,
                    method: 'GET',
                    success: function (clinica) {
                        preencherFormulario(clinica, editar);
                        if (editar == true) {
                            $('#modalTitle').text('Editar Clínica');
                            $('.modal-footer').show();
                        }
                        else {
                            $('#modalTitle').text('Clínica');
                            $('.modal-footer').hide();
                        }

                        $('#consultaModal').addClass('active');
                    },
                    error: function () {
                        new Notyf().error('Erro ao carregar dados da clínica.');
                    }
                });
            }

            function preencherFormulario(clinica, edit) {
                // Aba Dados
                limparFormulario();
                $('#cdClinica').val(clinica.cdClinica || '');
                $('#nmClinica').val(clinica.nmClinica);
                $('#endereco').val(clinica.endereco);

                $('#consultaModal')
                    .find('input, select, textarea')
                    .prop('disabled', !edit);
            }


            function carregarPacientes() {
                let search = $('#search').val();
                let searchEspecie = $('#searchEspecie').val();
                let searchOrder = $('#searchOrder').val();
                let searchExibir = $('#searchExibir').val();
                let searchClinica = $('#searchClinica').val();

                $.ajax({
                    url: '/getPacientes',
                    method: 'GET',
                    data: {
                        search: search,
                        especie: searchEspecie,
                        order: searchOrder,
                        exibir: searchExibir,
                        searchClinica: searchClinica
                    },
                    success: function (pacientes) {
                        let container = $('#patientsContainer');
                        container.empty();

                        pacientes.forEach(paciente => {
                            let icon = '<i class="fas fa-dog"></i>';
                            let cor = paciente.color;
                            if (paciente.especie.toLowerCase().includes('cat')) icon = '<i class="fas fa-cat"></i>';

                            if(paciente.color == '' || paciente.color == null || paciente.color == undefined){
                                const cores = ['#FFD6E0', '#C1FBA4', '#7BF1A8', '#90F1EF', '#FFB7FF'];
                                cor = cores[Math.floor(Math.random() * cores.length)];
                            }

                            let card = `
                                <div class="patient-card" onclick="addPaciente(this, ${paciente.cdPaciente})" data-cdpaciente="${paciente.cdPaciente}">
                                    <div class="patient-avatar" style="background-color: ${cor};">
                                        ${icon}
                                    </div>
                                    <div class="patient-info">
                                        <h3>${paciente.nmPaciente}</h3>
                                        <p class="meta">${paciente.raca} • ${paciente.idade}</p>
                                        <p class="owner">Tutor: ${paciente.nmTutor}</p>
                                        
                                    </div>
                                </div>
                            `;

                            container.append(card);
                        });

                    },
                    error: function () {
                        alert('Erro ao carregar os pacientes.');
                    }
                });
            }

            function limparFormulario() {
                $('#consultaForm')[0].reset();
                $('#cdPaciente').val('');
                $('#consultaModal').find('input[type="text"], input[type="number"], input[type="email"], input[type="tel"], textarea, select').val('');

                $('#consultaModal').find('input[type="radio"], input[type="checkbox"]').prop('checked', false);

                $('#consultaModal')
                    .find('input, select, textarea')
                    .prop('disabled', false);

                $('#consultaModal').find('input, select').trigger('change');
            }

           function addPaciente(card, cdPaciente) {
            let container = $('.add-patient-card');
            container.empty();

            let clone = $(card).clone();

            clone.off('click').on('click', function () {
                $('#consultaModal').removeClass('active');
                $('#addPacienteModal').addClass('active');
            });

            $('#cdPacienteAdicionado').val(cdPaciente);

            container.append(clone);

            $('#addPacienteModal').removeClass('active');
            $('#consultaModal').addClass('active');
        }



        </script>
    @endpush

</body>

</html>

<style>
    .patient-card{
        cursor: pointer;
    }
</style>