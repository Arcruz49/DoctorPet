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
                    <label for="dtConsultaInicio">Início</label>
                    <input type="date" class="filter" id="dtConsultaInicio" name="dtConsultaInicio">
                </div>

                <div class="filter-group">
                    <label for="dtConsultaFim">Fim</label>
                    <input type="date" class="filter" id="dtConsultaFim" name="dtConsultaFim">
                </div>

                {{-- <div class="filter-group">
                    <label>Exibir:</label>
                    <select class="filter" id="searchExibir">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="-1">Todos</option>
                    </select>
                </div> --}}
            </div>

            <div class="consultas-grid" id="ConsultasContainer">

                <div class="space-y-5">
                    
                    <div id="consultas-container"></div>

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

                function formatDate(date) {
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }

                const today = new Date();
                const nextWeek = new Date();
                nextWeek.setDate(today.getDate() + 7);

                $('#dtConsultaInicio').val(formatDate(today));
                $('#dtConsultaFim').val(formatDate(nextWeek));

                // Para fechar o modal de paciente
                $(document).on('click', '.close-modal, .modal-overlay', function (e) {
                    // Verifica se clicou diretamente no overlay (fora do conteúdo)
                    if ($(e.target).hasClass('modal-overlay') || $(e.target).hasClass('close-modal')) {
                        $('#addPacienteModal').fadeOut(); // ou .hide()
                    }
                });

                $(document).on('click', '.add-patient-btn', function () {
                    carregarPacientes();
                });

                carregarConsultas();

                $('.filter').on('change', function () {
                    carregarConsultas();
                });

                $('#search').on('input', function () {
                    carregarConsultas();
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
                                carregarConsultas();
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


            

            function carregarConsultas() {
                let dtConsultaInicio = $('#dtConsultaInicio').val();
                let dtConsultaFim = $('#dtConsultaFim').val();
                let searchExibir = $('#searchExibir').val();
                let search = $('#search').val();

                $.ajax({
                    url: '/GetConsultas',
                    method: 'GET',
                    data: {
                        dtConsultaInicio: dtConsultaInicio,
                        dtConsultaFim: dtConsultaFim,
                        exibir: searchExibir,
                        search: search
                    },
                    success: function (data) {
                        const container = $('#consultas-container');
                        container.empty();

                        Object.entries(data).forEach(([dataLabel, consultas]) => {
                            const title = `<h2 class="h6 text-secondary fw-semibold mb-3 pb-2 border-bottom">${dataLabel}</h2>`;
                            container.append(title);

                            consultas.forEach(consulta => {
                                let statusLabel = 'Desconhecido';
                                let statusClass = 'secondary';

                                switch (consulta.cdStatusConsulta) {
                                    case 1:
                                        statusLabel = 'Agendada';
                                        statusClass = 'primary';
                                        break;
                                    case 2:
                                        statusLabel = 'Confirmada';
                                        statusClass = 'success';
                                        break;
                                    case 3:
                                        statusLabel = 'Realizada';
                                        statusClass = 'muted';
                                        break;
                                    case 4:
                                        statusLabel = 'Cancelada';
                                        statusClass = 'danger';
                                        break;
                                }

                                const isFinalizada = consulta.cdStatusConsulta === 3 || consulta.cdStatusConsulta === 4;
                                const isCancelada = consulta.cdStatusConsulta === 4;

                                const horaClasse = isFinalizada
                                    ? `text-decoration-line-through text-${statusClass}`
                                    : `text-${statusClass}`;

                                const cardClasse = 'card card-appointment mb-3';
                                const cardStyle = isCancelada ? 'background-color: #f8d7da30;' : '';
                                const bodyStyle = isFinalizada ? 'opacity-75' : '';

                                const especie = consulta.especie == 'cat' ? 'Gato' : 'Cachorro';

                                const botoes = !isFinalizada ? `
                                    <button class="btn btn-sm btn-confirm px-3" data-id="${consulta.cdConsulta}">Atender</button>
                                    <button class="btn btn-sm btn-outline-danger px-3" onclick="cancelarConsulta(${consulta.cdConsulta})">Cancelar</button>                                ` : `
                                    <button class="btn btn-sm btn-outline-secondary px-3">Ver Detalhes</button>
                                `;

                                const card = `
                                    <div class="${cardClasse}" style="${cardStyle}">
                                        <div class="card-body p-3 d-flex flex-column flex-sm-row align-items-sm-center gap-3 ${bodyStyle}">
                                            <div class="text-sm-center" style="flex: 0 0 100px;">
                                                <p class="fs-5 fw-bold m-0 ${horaClasse}">${consulta.horaConsulta}</p>
                                                <div class="d-flex align-items-center justify-content-sm-center gap-1 mt-1">
                                                    <div class="status-dot bg-${statusClass}"></div>
                                                    <span class="small fw-medium text-${statusClass}">${statusLabel}</span>
                                                </div>
                                            </div>
                                            <div class="d-none d-sm-block vr p-0 mx-2"></div>
                                            <div class="flex-grow-1">
                                                <p class="fw-bold fs-6 m-0 text-muted">${consulta.nmPaciente}</p>
                                                <div class="d-flex flex-column flex-sm-row small text-secondary mt-1" style="gap: 0.25rem 1rem;">
                                                    <span><i class="fa-solid fa-paw me-2 text-muted"></i>${consulta.raca}</span>
                                                    <span><i class="fa-solid fa-${consulta.especie} me-2 text-muted"></i>${especie}</span>
                                                    <span><i class="fa-solid fa-user-shield me-2 text-muted"></i>Tutor: ${consulta.nmTutor}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 mt-2 mt-sm-0">
                                                ${botoes}
                                            </div>
                                        </div>
                                    </div>
                                `;

                                container.append(card);
                            });
                        });
                    },
                    error: function () {
                        $('#consultas-container').html('<p class="text-danger">Erro ao carregar as consultas.</p>');
                    }
                });
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

            function cancelarConsulta(cdConsulta){
                const notyf = new Notyf();

                Swal.fire({
                    title: "Deseja mesmo cancelar esta consulta?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim, cancelar"
                    }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: "/CancelarConsulta",
                            method: 'POST',
                            data: { cdConsulta: cdConsulta },
                            success: function (response) {
                                if (response.success === true) {
                                    notyf.success(response.message);
                                    carregarConsultas();
                                } else {
                                    notyf.error(response.message || 'Ocorreu um erro ao salvar.');
                                }
                            },
                            error: function () {
                                notyf.error('Erro ao cancelar consulta.');
                            }
                        });
                        
                    }
                });

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