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
                    <li class="active">
                        <a href="#">
                            <i class="fas fa-paw"></i>
                            <span>Pacientes</span>
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

        <!-- Overlay que aparece quando a sidebar está aberta em mobile -->
        <div class="sidebar-overlay"></div>

        <!-- Conteúdo principal -->
        <main class="main-content">
            <header class="main-header">
                <h1>Pacientes</h1>
                <div class="header-actions">
                    <div class="search-box">
                        <input type="text" placeholder="Buscar paciente...">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                    <button class="btn primary new-patient">
                        <i class="fas fa-plus"></i>
                        Novo Paciente
                    </button>
                </div>
            </header>

            <div class="content-wrapper">
                <!-- Filtros -->
                <div class="filters">
                    <div class="filter-group">
                        <label>Espécie:</label>
                        <select>
                            <option>Todas</option>
                            <option>Cães</option>
                            <option>Gatos</option>
                            <option>Outros</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Status:</label>
                        <select>
                            <option>Todos</option>
                            <option>Ativos</option>
                            <option>Inativos</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Ordenar por:</label>
                        <select>
                            <option>Mais recentes</option>
                            <option>Nome (A-Z)</option>
                            <option>Próxima consulta</option>
                        </select>
                    </div>
                </div>

                <!-- Lista de pacientes -->
                <div class="patients-grid" id="patientsContainer">
                    <!-- Os cards virão aqui via JavaScript -->
                </div>
            </div>
        </main>

        <!-- Modal de cadastro -->
        <div class="modal-overlay" id="patientModal">
            @include('modal.modalPaciente')

        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

<script>

    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function() {

        carregarPacientes();


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

        // Abrir modal de novo paciente
        $('.new-patient, .add-patient-btn').click(function() {
            $('#modalTitle').text('Novo Paciente');
            $('.modal-footer').show();  
            limparFormulario();
            $('#patientModal').addClass('active');
        });

        // Fechar modal
        $('.close-modal, .btn.secondary').click(function() {
            $('#patientModal').removeClass('active');
        });

        // Visualizar paciente
        $('.icon-btn.view').click(function() {
            // Aqui você implementaria a lógica para visualizar um paciente
            alert('Visualizar paciente - implementar lógica');
        });

        // Editar paciente
        $('.icon-btn.edit').click(function() {
            // Aqui você implementaria a lógica para editar um paciente
            $('#patientModal').addClass('active');
            $('.modal-header h2').text('Editar Paciente');
        });

        // Buscar pacientes
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
        $(document).click(function(e) {
            if ($(e.target).hasClass('modal-overlay')) {
                $('#patientModal').removeClass('active');
            }
        });

        // Simular envio do formulário
        $('#patientForm').submit(function(e) {
            e.preventDefault();
            // Aqui você implementaria o AJAX para salvar o paciente
            alert('Paciente salvo com sucesso! (implementar lógica de envio)');
            $('#patientModal').removeClass('active');
        });


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

        // Mostrar/ocultar campos condicionais
        $('input[type="radio"]').change(function() {
            const name = $(this).attr('name');
            const value = $(this).val();

            // Oculta todos os campos condicionais para este grupo
            $(`.conditional-field[data-condition="${name}"]`).hide();

            // Mostra apenas o campo condicional correspondente
            $(`.conditional-field[data-condition="${name}"][data-value="${value}"]`).show();

            // Se não tem data-value, mostra para qualquer valor
            $(`.conditional-field[data-condition="${name}"]:not([data-value])`).show();
        });

        

        $('#btnAddPaciente').on('click', function () {
            const form = $('#patientForm');
            const formData = new FormData(form[0]);

            const notyf = new Notyf();

            let url = '/createPaciente';

            if ($('#cdPaciente').val() !== "") {
                url = '/editPaciente';
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
                        $('#patientModal').removeClass('active');
                        carregarPacientes();
                    } else {
                        notyf.error(response.message || 'Ocorreu um erro ao salvar.');
                    }
                },
                error: function () {
                    notyf.error('Erro ao salvar paciente.');
                }
            });
        });


    });


    function visualizarPaciente(cdPaciente, editar) {
        $.ajax({
            url: `/getPaciente/${cdPaciente}`,
            method: 'GET',
            success: function (paciente) {
                preencherFormulario(paciente, editar);
                if(editar == true){
                    $('#modalTitle').text('Editar Paciente');
                    $('.modal-footer').show();  
                }
                else{
                    $('#modalTitle').text('Paciente');
                    $('.modal-footer').hide();   
                }
       
                $('#patientModal').addClass('active');  
            },
            error: function () {
                new Notyf().error('Erro ao carregar dados do paciente.');
            }
        });
    }

    function preencherFormulario(paciente, edit) {
        // Aba Dados
        limparFormulario();
        $('#cdPaciente').val(paciente.cdPaciente || '');
        $('#petName').val(paciente.nmPaciente);
        $('#species').val(paciente.especie);
        $('#breed').val(paciente.raca);
        $('#age').val(paciente.idade);
        $('#gender').val(paciente.sexo);
        $('#weight').val(paciente.peso);

        $('#ownerName').val(paciente.nmTutor);
        $('#ownerPhone').val(paciente.telefone || '');
        $('#ownerEmail').val(paciente.email || '');
        $('#ownerAddress').val(paciente.endereco || '');

        $('#medicalNotes').val(paciente.obs || '');
        $('#vaccineStatus').val(paciente.statusVacinacao || 'unknown');
        // Se quiser preencher a última consulta, crie um campo e faça aqui
        // $('#lastVisit').val(paciente.ultimaConsulta || '');

        // Aba Questionário

        // Castrado
        if (paciente.castrado == 1) {
            $('input[name="castrated"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="castrated"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#castration_date').val(paciente.dtCastracao || '');
        
        // Considerou castração (yes/no)
        if (paciente.considerouCastracao === 'yes' || paciente.considerouCastracao === 1) {
            $('input[name="considered_castration"][value="yes"]').prop('checked', true).trigger('change');
        } else if (paciente.considerouCastracao === 'no' || paciente.considerouCastracao === 0) {
            $('input[name="considered_castration"][value="no"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="considered_castration"]').prop('checked', false).trigger('change');
        }

        // Cios regulares (yes/no/na)
        if (paciente.ciosRegulares === 1 || paciente.ciosRegulares === true) {
            $('input[name="regular_cycles"][value="yes"]').prop('checked', true).trigger('change');
        } else if (paciente.ciosRegulares === 0 || paciente.ciosRegulares === false) {
            $('input[name="regular_cycles"][value="no"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="regular_cycles"][value="na"]').prop('checked', true).trigger('change');
        }

        // Ficou gestante
        if (paciente.ficouGestante == 1) {
            $('input[name="pregnant"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="pregnant"][value="no"]').prop('checked', true).trigger('change');
        }

        // Gestação psicológica
        if (paciente.gestacaoPsicologica == 1) {
            $('input[name="pseudopregnancy"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="pseudopregnancy"][value="no"]').prop('checked', true).trigger('change');
        }

        // Tipo de alimentação
        $('input[name="food_type"][value="' + paciente.tipoAlimentacao + '"]').prop('checked', true).trigger('change');
        $('#food_type_spec').val(paciente.tipoAlimentacaoOutro || '');

        // Usa suplemento
        if (paciente.usaSuplemento == 1) {
            $('input[name="supplements"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="supplements"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#supplements_type').val(paciente.tipoSuplemento || '');

        // Inclui processados
        if (paciente.incluiProcessados == 1) {
            $('input[name="preservatives"][value="yes"]').prop('checked', true);
        } else {
            $('input[name="preservatives"][value="no"]').prop('checked', true);
        }

        // Controle de ectoparasitas
        if (paciente.controleEctoparasita == 1) {
            $('input[name="ectoparasite_control"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="ectoparasite_control"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#ectoparasite_product').val(paciente.nomeProdutoEctoparasita || '');
        $('#ectoparasite_frequency').val(paciente.frequenciaEctoparasita || '');

        // Uso vermífugo
        if (paciente.usoVermifugo == 1) {
            $('input[name="deworming"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="deworming"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#deworming_product').val(paciente.nomeProdutoVermifugo || '');
        $('#deworming_frequency').val(paciente.frequenciaVermifugo || '');

        // Vacinação anualmente
        if (paciente.vacinadoAnualmente == 1) {
            $('input[name="vaccinated"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="vaccinated"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#vaccines').val(paciente.vacinasAplicadas || '');
        $('#last_vaccine_date').val(paciente.dataUltimaVacinacao || '');
        if (paciente.vacinacaoEmClinica == 1) {
            $('input[name="vet_clinic_vaccine"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="vet_clinic_vaccine"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#vaccine_location').val(paciente.localVacinacao || '');

        // Exposição solar
        if (paciente.exposicaoSol == 1) {
            $('input[name="sun_exposure"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="sun_exposure"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#sun_exposure_time').val(paciente.tempoExposicaoSol || '');
        $('#sun_exposure_period').val(paciente.periodoExposicaoSol || '');

        // Usa protetor solar
        if (paciente.usaProtetorSolar == 1) {
            $('input[name="sunscreen"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="sunscreen"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#sunscreen_type').val(paciente.tipoProtetorSolar || '');
        $('#sunscreen_frequency').val(paciente.frequenciaProtetorSolar || '');

        // Acesso à rua desacompanhado
        if (paciente.acessoRuaSozinho == 1) {
            $('input[name="street_access"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="street_access"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#street_access_time').val(paciente.tempoAcessoRua || '');
        $('#street_access_frequency').val(paciente.frequenciaAcessoRua || '');

        // Exposição a produtos químicos
        if (paciente.exposicaoQuimicos == 1) {
            $('input[name="chemical_exposure"][value="yes"]').prop('checked', true);
        } else {
            $('input[name="chemical_exposure"][value="no"]').prop('checked', true);
        }

        // Fumante passivo
        if (paciente.fumantePassivo == 1) {
            $('input[name="passive_smoker"][value="yes"]').prop('checked', true);
        } else {
            $('input[name="passive_smoker"][value="no"]').prop('checked', true);
        }

        // Perto indústria
        if (paciente.pertoIndustria == 1) {
            $('input[name="near_industry"][value="yes"]').prop('checked', true);
        } else {
            $('input[name="near_industry"][value="no"]').prop('checked', true);
        }

        // Injeção contraceptiva
        if (paciente.usoInjecaoContraceptiva == 1) {
            $('input[name="contraceptive_injection"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="contraceptive_injection"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#contraceptive_frequency').val(paciente.frequenciaInjecaoContraceptiva || '');
        $('#last_contraceptive_date').val(paciente.dataUltimaInjecaoContraceptiva || '');

        // Problemas de pele
        if (paciente.problemaPele == 1) {
            $('input[name="skin_problems"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="skin_problems"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#skin_problem_type').val(paciente.tipoProblemaPele || '');

        if (paciente.recidivaPele == 1) {
            $('input[name="skin_recurrence"][value="yes"]').prop('checked', true);
        } else {
            $('input[name="skin_recurrence"][value="no"]').prop('checked', true);
        }

        // Doença
        if (paciente.possuiDoenca == 1) {
            $('input[name="has_disease"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="has_disease"][value="no"]').prop('checked', true).trigger('change');
        }
        if (paciente.doencaTratada == 1) {
            $('input[name="disease_treated"][value="yes"]').prop('checked', true);
        } else {
            $('input[name="disease_treated"][value="no"]').prop('checked', true);
        }
        $('#treatment_response').val(paciente.respostaTratamento || '');

        // Medicação contínua
        if (paciente.medicacaoContinua == 1) {
            $('input[name="continuous_medication"][value="yes"]').prop('checked', true).trigger('change');
        } else {
            $('input[name="continuous_medication"][value="no"]').prop('checked', true).trigger('change');
        }
        $('#medication_type').val(paciente.tipoMedicacao || '');
        $('#medication_start_date').val(paciente.inicioMedicacao || '');

        // Exames laboratoriais
        if (paciente.examesLaboratoriais == 1) {
            $('input[name="lab_tests"][value="yes"]').prop('checked', true);
        } else {
            $('input[name="lab_tests"][value="no"]').prop('checked', true);
        }

        // Exames de imagem
        if (paciente.examesImagem == 1) {
            $('input[name="imaging_tests"][value="yes"]').prop('checked', true);
        } else {
            $('input[name="imaging_tests"][value="no"]').prop('checked', true);
        }

        // Histórico familiar de câncer
        $('input[name="family_cancer_history"][value="' + (paciente.historicoCancerFamiliar || 'dont_know') + '"]').prop('checked', true);

        $('#patientForm')
        .find('input, select, textarea')
        .prop('disabled', !edit);
    }


    function carregarPacientes() {
        $.ajax({
            url: '/getPacientes',
            method: 'GET',
            success: function (pacientes) {
                let container = $('#patientsContainer');
                container.empty();

                pacientes.forEach(paciente => {
                    let icon = '<i class="fas fa-dog"></i>';
                    if (paciente.especie.toLowerCase().includes('gato')) icon = '<i class="fas fa-cat"></i>';

                    const cores = ['#FFD6E0', '#C1FBA4', '#7BF1A8', '#90F1EF', '#FFB7FF'];
                    let cor = cores[Math.floor(Math.random() * cores.length)];

                    let card = `
                        <div class="patient-card">
                            <div class="patient-avatar" style="background-color: ${cor};">
                                ${icon}
                            </div>
                            <div class="patient-info">
                                <h3>${paciente.nmPaciente}</h3>
                                <p class="meta">${paciente.raca} • ${paciente.idade}</p>
                                <p class="owner">Tutor: ${paciente.nmTutor}</p>
                                <div class="status-badge ${paciente.statusVacinacao === 'ativo' ? 'active' : 'inactive'}">
                                    ${paciente.statusVacinacao === 'ativo' ? 'Ativo' : 'Inativo'}
                                </div>
                            </div>
                            <div class="patient-actions">
                                <button class="icon-btn view" onclick="visualizarPaciente(${paciente.cdPaciente}, false)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="icon-btn edit" onclick="visualizarPaciente(${paciente.cdPaciente}, true)">
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
                        <button class="add-patient-btn">
                            <i class="fas fa-plus-circle"></i>
                            <span>Adicionar Paciente</span>
                        </button>
                    </div>
                `);
            },
            error: function () {
                alert('Erro ao carregar os pacientes.');
            }
        });
    }

    function limparFormulario() {
        $('#patientForm')[0].reset(); 
        $('#cdPaciente').val('');
        $('#patientForm').find('input[type="text"], input[type="number"], input[type="email"], input[type="tel"], textarea, select').val(''); 

        $('#patientForm').find('input[type="radio"], input[type="checkbox"]').prop('checked', false);

        $('#patientForm').find('input, select').trigger('change');
    }


</script>
</body>
</html>
