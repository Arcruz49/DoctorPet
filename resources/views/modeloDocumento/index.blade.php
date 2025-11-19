<!DOCTYPE html>
<html lang="pt-BR">
<head>

</head>
<body>

@extends('layouts.layout')

@section('content')
    <header class="main-header">
        <h1 class="mainTitle">Modelos de Documentos</h1>
        <div class="header-actions">
            <div class="search-box">
                <input type="text" id="search" placeholder="Buscar modelo...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <button class="btn primary new-doc">
                <i class="fas fa-plus"></i>
                Novo Modelo
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

        <div class="patients-grid" id="patientsContainer"></div>
    </div>

    <div class="modal-overlay" id="docModal">
        @include('modal.modalDocumento')
    </div>

@endsection

@push('scripts')
    <script>

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {










            carregarModelos();

            $('.filter').on('change', function () {
                carregarModelos();
            });

            $('#search').on('input', function () {
                carregarModelos();
            });

            
            // Abrir modal de novo documento
            $(document).on('click', '.new-doc, .add-doc-btn', function() {
                $('#modalTitle').text('Novo Modelo');
                $('.modal-footer').show();  
                limparFormulario();
                $('#docModal').addClass('active');
            });

            // Fechar modal
            $('.close-modal, .btn.secondary').click(function() {
                $('#docModal').removeClass('active');
            });


            // Editar documento
            $('.icon-btn.edit').click(function() {
                $('#docModal').addClass('active');
                $('.modal-header h2').text('Editar Modelo');
            });

            // Buscar documentos
            $('.search-box button').click(function() {
                const searchTerm = $('.search-box input').val().toLowerCase();
                if (searchTerm) {
                    $('.patient-card').each(function() {
                        const cardText = $(this).text().toLowerCase();
                        $(this).toggle(cardText.includes(searchTerm));
                    });
                } else {
                    $('.patient-card').show();
                }
            });

            // Permitir busca com Enter
            $('.search-box input').keypress(function(e) {
                if (e.which === 13) {
                    $('.search-box button').click();
                }
            });

            // Fechar modal ao clicar fora
            // $(document).click(function(e) {
            //     if ($(e.target).hasClass('modal-overlay')) {
            //         $('#docModal').removeClass('active');
            //     }
            // });

            // // Simular envio do formulário
            // $('#docModal').submit(function(e) {
            //     e.preventDefault();
            //     // Aqui você implementaria o AJAX para salvar o paciente
            //     alert('Paciente salvo com sucesso! (implementar lógica de envio)');
            //     $('#docModal').removeClass('active');
            // });


            $('.tab-button').click(function() {
                // Remove a classe active de todos os botões e conteúdos
                $('.tab-button').removeClass('active');
                $('.tab-content').removeClass('active');

                // Adiciona a classe active ao botão clicado
                $(this).addClass('active');

                // Mostra o conteúdo correspondente
                const tabId = $(this).data('tab') + '-tab';
                $('#' + tabId).addClass('active');
            });

            
            $('#btnSalvarDocumento').on('click', function () {
                const form = $('#documentForm')[0];
                const formData = new FormData(form);
                const notyf = new Notyf();

                let url = '/createDocumento';

                if ($('#cdModeloDocumento').val() !== "") {
                    url = '/editDocumento';
                }
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,  
                    contentType: false, 
                    success: function (response) {
                        if (response.success === true) {
                            notyf.success(response.message);
                            $('#docModal').removeClass('active');
                            carregarModelos();
                        } else {
                            notyf.error(response.message || 'Ocorreu um erro ao salvar.');
                        }
                    },
                    error: function () {
                        notyf.error('Erro ao salvar clínica.');
                    }
                });
            });


        });


        function visualizarModelo(cdModelo, editar) {
            $.ajax({
                url: `/getModelo/${cdModelo}`,
                method: 'GET',
                success: function (modelo) {
                    preencherFormulario(modelo, editar);
                    if(editar == true){
                        $('#modalTitle').text('Editar Modelo');
                        $('.modal-footer').show();  
                    }
                    else{
                        $('#modalTitle').text('Modelo');
                        $('.modal-footer').hide();   
                    }
        
                    $('#docModal').addClass('active');  
                },
                error: function () {
                    new Notyf().error('Erro ao carregar dados da clínica.');
                }
            });
        }

        function preencherFormulario(modelo, edit) {
            // Aba Dados
            limparFormulario();
            $('#cdModeloDocumento').val(modelo.cdModeloDocumento || '');
            $('#nmModeloDocumento').val(modelo.nmModeloDocumento);
            $('#descModeloDocumento').val(modelo.descModeloDocumento);
            $('#html').val(modelo.html);


            $('#docModal')
            .find('input, select, textarea')
            .prop('disabled', !edit);
        }


        function carregarModelos() {
            let search = $('#search').val();
            let searchEspecie = $('#searchEspecie').val();
            let searchOrder = $('#searchOrder').val();
            let searchExibir = $('#searchExibir').val();

            $.ajax({
                url: '/getModelos',
                method: 'GET',
                data: {
                    search: search,
                    especie: searchEspecie,
                    order: searchOrder,
                    exibir: searchExibir
                },
                success: function (modelos) {
                    let container = $('#patientsContainer');
                    container.empty();

                    modelos.forEach(modelo => {
                        let icon = '<i class="fas fa-file-medical"></i>';
                        let cor = modelo.color;
                        if(modelo.color == '' || modelo.color == null || modelo.color == undefined){
                            const cores = ['#FFD6E0', '#C1FBA4', '#7BF1A8', '#90F1EF', '#FFB7FF'];
                            cor = cores[Math.floor(Math.random() * cores.length)];
                        }

                        let card = `
                            <div class="patient-card">
                                <div class="patient-avatar" style="background-color: ${cor};">
                                    ${icon}
                                </div>
                                <div class="patient-info">
                                    <h3>${modelo.nmModeloDocumento}</h3>
                                    <p class="meta">${modelo.descModeloDocumento}</p>
                                </div>
                                <div class="patient-actions">
                                    <button class="icon-btn view" onclick="visualizarModelo(${modelo.cdModeloDocumento}, false)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="icon-btn edit" onclick="visualizarModelo(${modelo.cdModeloDocumento}, true)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="icon-btn more"><i class="fas fa-ellipsis-v"></i></button>
                                </div>
                            </div>
                        `;

                        container.append(card);
                    });

                    container.append(`
                        <div class="add-patient-card">
                            <button class="add-doc-btn">
                                <i class="fas fa-plus-circle"></i>
                                <span>Adicionar Modelo</span>
                            </button>
                        </div>
                    `);
                },
                error: function () {
                    alert('Erro ao carregar os modelos.');
                }
            });
        }

        function limparFormulario() {
            $('#documentForm')[0].reset(); 
            $('#cdPaciente').val('');
            $('#docModal').find('input[type="text"], input[type="number"], input[type="email"], input[type="tel"], textarea, select').val(''); 

            $('#docModal').find('input[type="radio"], input[type="checkbox"]').prop('checked', false);

            $('#docModal')
            .find('input, select, textarea')
            .prop('disabled', false);


            $('#docModal').find('input, select').trigger('change');
        }


    </script>
@endpush

</body>
</html>
