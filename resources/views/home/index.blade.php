<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCare | Sistema Veterinário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
                <div class="patients-grid">
                    <!-- Card de paciente 1 -->
                    <div class="patient-card">
                        <div class="patient-avatar" style="background-color: #FFD6E0;">
                            <i class="fas fa-dog"></i>
                        </div>
                        <div class="patient-info">
                            <h3>Rex</h3>
                            <p class="meta">Labrador • 3 anos</p>
                            <p class="owner">Tutor: João Silva</p>
                            <div class="status-badge active">Ativo</div>
                        </div>
                        <div class="patient-actions">
                            <button class="icon-btn view"><i class="fas fa-eye"></i></button>
                            <button class="icon-btn edit"><i class="fas fa-edit"></i></button>
                            <button class="icon-btn more"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>
                    
                    <!-- Card de paciente 2 -->
                    <div class="patient-card">
                        <div class="patient-avatar" style="background-color: #C1FBA4;">
                            <i class="fas fa-cat"></i>
                        </div>
                        <div class="patient-info">
                            <h3>Mimi</h3>
                            <p class="meta">Siamês • 5 anos</p>
                            <p class="owner">Tutor: Maria Souza</p>
                            <div class="status-badge active">Ativo</div>
                        </div>
                        <div class="patient-actions">
                            <button class="icon-btn view"><i class="fas fa-eye"></i></button>
                            <button class="icon-btn edit"><i class="fas fa-edit"></i></button>
                            <button class="icon-btn more"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>
                    
                    <!-- Card de paciente 3 -->
                    <div class="patient-card">
                        <div class="patient-avatar" style="background-color: #7BF1A8;">
                            <i class="fas fa-dog"></i>
                        </div>
                        <div class="patient-info">
                            <h3>Thor</h3>
                            <p class="meta">Golden Retriever • 2 anos</p>
                            <p class="owner">Tutor: Carlos Oliveira</p>
                            <div class="status-badge inactive">Inativo</div>
                        </div>
                        <div class="patient-actions">
                            <button class="icon-btn view"><i class="fas fa-eye"></i></button>
                            <button class="icon-btn edit"><i class="fas fa-edit"></i></button>
                            <button class="icon-btn more"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>
                    
                    <!-- Card de paciente 4 -->
                    <div class="patient-card">
                        <div class="patient-avatar" style="background-color: #90F1EF;">
                            <i class="fas fa-dove"></i>
                        </div>
                        <div class="patient-info">
                            <h3>Piu</h3>
                            <p class="meta">Calopsita • 1 ano</p>
                            <p class="owner">Tutor: Luiza Mendes</p>
                            <div class="status-badge active">Ativo</div>
                        </div>
                        <div class="patient-actions">
                            <button class="icon-btn view"><i class="fas fa-eye"></i></button>
                            <button class="icon-btn edit"><i class="fas fa-edit"></i></button>
                            <button class="icon-btn more"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>
                    
                    <!-- Card de paciente 5 -->
                    <div class="patient-card">
                        <div class="patient-avatar" style="background-color: #FFB7FF;">
                            <i class="fas fa-cat"></i>
                        </div>
                        <div class="patient-info">
                            <h3>Luna</h3>
                            <p class="meta">Persa • 4 anos</p>
                            <p class="owner">Tutor: Pedro Alves</p>
                            <div class="status-badge active">Ativo</div>
                        </div>
                        <div class="patient-actions">
                            <button class="icon-btn view"><i class="fas fa-eye"></i></button>
                            <button class="icon-btn edit"><i class="fas fa-edit"></i></button>
                            <button class="icon-btn more"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>
                    
                    <!-- Card de novo paciente -->
                    <div class="add-patient-card">
                        <button class="add-patient-btn">
                            <i class="fas fa-plus-circle"></i>
                            <span>Adicionar Paciente</span>
                        </button>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Modal de cadastro -->
        <div class="modal-overlay" id="patientModal">
        <div class="modal-container">
            <div class="modal-header">
                <h2>Novo Paciente</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Navegação por abas -->
                <div class="tabs">
                    <button class="tab-button active" data-tab="data">Dados</button>
                    <button class="tab-button" data-tab="questionnaire">Questionário</button>
                </div>
                
                <form id="patientForm">
                    <!-- Aba Dados -->
                    <div id="data-tab" class="tab-content active">
                        <div class="form-section">
                            <h3>Informações do Animal</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="petName">Nome</label>
                                    <input type="text" id="petName" placeholder="Ex: Rex" required>
                                </div>
                                <div class="form-group">
                                    <label for="species">Espécie</label>
                                    <select id="species" required>
                                        <option value="" disabled selected>Selecione</option>
                                        <option value="dog">Cão</option>
                                        <option value="cat">Gato</option>
                                        <option value="bird">Ave</option>
                                        <option value="other">Outro</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="breed">Raça</label>
                                    <input type="text" id="breed" placeholder="Ex: Labrador">
                                </div>
                                <div class="form-group">
                                    <label for="age">Idade (anos)</label>
                                    <input type="number" id="age" min="0" max="30">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Sexo</label>
                                    <select id="gender">
                                        <option value="" disabled selected>Selecione</option>
                                        <option value="male">Macho</option>
                                        <option value="female">Fêmea</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="weight">Peso (kg)</label>
                                    <input type="number" id="weight" step="0.1" min="0">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Informações do Responsável</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="ownerName">Nome Completo</label>
                                    <input type="text" id="ownerName" placeholder="Ex: João Silva" required>
                                </div>
                                <div class="form-group">
                                    <label for="ownerPhone">Telefone</label>
                                    <input type="tel" id="ownerPhone" placeholder="(00) 00000-0000" required>
                                </div>
                                <div class="form-group">
                                    <label for="ownerEmail">E-mail</label>
                                    <input type="email" id="ownerEmail" placeholder="exemplo@email.com">
                                </div>
                                <div class="form-group">
                                    <label for="ownerAddress">Endereço</label>
                                    <input type="text" id="ownerAddress" placeholder="Rua, número - Cidade">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Histórico Médico</h3>
                            <div class="form-group">
                                <label for="medicalNotes">Observações</label>
                                <textarea id="medicalNotes" rows="3" placeholder="Alergias, condições pré-existentes, etc."></textarea>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="vaccineStatus">Status de Vacinação</label>
                                    <select id="vaccineStatus">
                                        <option value="updated">Em dia</option>
                                        <option value="pending">Pendente</option>
                                        <option value="unknown">Desconhecido</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="lastVisit">Última Consulta</label>
                                    <input type="date" id="lastVisit">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Aba Questionário -->
                    <div id="questionnaire-tab" class="tab-content">
                        <div class="form-section">
                            <h3>Saúde Reprodutiva</h3>
                            <div class="question-group">
                                <label>O animal é castrado?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="castrated" value="yes"> Sim</label>
                                    <label><input type="radio" name="castrated" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="castrated" data-value="yes">
                                    <label>Se sim, quando?</label>
                                    <input type="date">
                                </div>
                                <div class="conditional-field" data-condition="castrated" data-value="no">
                                    <label>Já considerou a castração como medida preventiva contra certos tipos de câncer?</label>
                                    <div class="radio-group">
                                        <label><input type="radio" name="considered_castration" value="yes"> Sim</label>
                                        <label><input type="radio" name="considered_castration" value="no"> Não</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="question-group">
                                <label>Os cios são regulares?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="regular_cycles" value="yes"> Sim</label>
                                    <label><input type="radio" name="regular_cycles" value="no"> Não</label>
                                    <label><input type="radio" name="regular_cycles" value="na"> Não se aplica</label>
                                </div>
                            </div>
                            
                            <div class="question-group">
                                <label>Já ficou gestante?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="pregnant" value="yes"> Sim</label>
                                    <label><input type="radio" name="pregnant" value="no"> Não</label>
                                </div>
                            </div>
                            
                            <div class="question-group">
                                <label>Apresentou gestação psicológica (pseudociese)?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="pseudopregnancy" value="yes"> Sim</label>
                                    <label><input type="radio" name="pseudopregnancy" value="no"> Não</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Alimentação</h3>
                            <div class="question-group">
                                <label>Qual tipo de alimentação o animal consome?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="food_type" value="commercial"> Ração</label>
                                    <label><input type="radio" name="food_type" value="homemade"> Caseira</label>
                                    <label><input type="radio" name="food_type" value="natural"> Natural</label>
                                </div>
                                <div class="conditional-field" data-condition="food_type">
                                    <label>Qual?</label>
                                    <input type="text" placeholder="Especificar tipo de alimentação">
                                </div>
                            </div>
                            
                            <div class="question-group">
                                <label>Faz uso de suplemento alimentar ou vitaminas como parte da dieta?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="supplements" value="yes"> Sim</label>
                                    <label><input type="radio" name="supplements" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="supplements" data-value="yes">
                                    <label>Qual?</label>
                                    <input type="text" placeholder="Especificar suplementos">
                                </div>
                            </div>
                            
                            <div class="question-group">
                                <label>A alimentação inclui alimentos processados, conservantes ou corantes artificiais?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="preservatives" value="yes"> Sim</label>
                                    <label><input type="radio" name="preservatives" value="no"> Não</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Controle de Ectoparasitas</h3>
                            <div class="question-group">
                                <label>O animal faz controle de ectoparasitas?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="ectoparasite_control" value="yes"> Sim</label>
                                    <label><input type="radio" name="ectoparasite_control" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="ectoparasite_control" data-value="yes">
                                    <label>Nome do produto:</label>
                                    <input type="text" placeholder="Nome do produto">
                                    <label>Qual frequência?</label>
                                    <input type="text" placeholder="Frequência de uso">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Vermifugação</h3>
                            <div class="question-group">
                                <label>O animal faz uso de vermífugo?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="deworming" value="yes"> Sim</label>
                                    <label><input type="radio" name="deworming" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="deworming" data-value="yes">
                                    <label>Nome do produto:</label>
                                    <input type="text" placeholder="Nome do produto">
                                    <label>Qual frequência?</label>
                                    <input type="text" placeholder="Frequência de uso">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Vacinação</h3>
                            <div class="question-group">
                                <label>O animal é vacinado anualmente?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="vaccinated" value="yes"> Sim</label>
                                    <label><input type="radio" name="vaccinated" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="vaccinated" data-value="yes">
                                    <label>Com quais vacinas?</label>
                                    <input type="text" placeholder="Lista de vacinas">
                                    <label>Qual foi a última vez que foi vacinado?</label>
                                    <input type="date">
                                    <label>Vacinação é feita em clínica veterinária?</label>
                                    <div class="radio-group">
                                        <label><input type="radio" name="vet_clinic_vaccine" value="yes"> Sim</label>
                                        <label><input type="radio" name="vet_clinic_vaccine" value="no"> Não</label>
                                    </div>
                                    <label>Em qual local do corpo do animal é feita a vacinação?</label>
                                    <input type="text" placeholder="Local da vacinação">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Exposição Solar</h3>
                            <div class="question-group">
                                <label>O animal fica exposto ao sol em algum período do dia?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="sun_exposure" value="yes"> Sim</label>
                                    <label><input type="radio" name="sun_exposure" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="sun_exposure" data-value="yes">
                                    <label>Por quanto tempo/dia?</label>
                                    <input type="text" placeholder="Tempo de exposição">
                                    <label>Qual período do dia o animal fica mais exposto?</label>
                                    <input type="text" placeholder="Período do dia">
                                </div>
                            </div>
                            
                            <div class="question-group">
                                <label>Usa proteção solar?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="sunscreen" value="yes"> Sim</label>
                                    <label><input type="radio" name="sunscreen" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="sunscreen" data-value="yes">
                                    <label>Qual tipo?</label>
                                    <input type="text" placeholder="Tipo de protetor">
                                    <label>Com que frequência?</label>
                                    <input type="text" placeholder="Frequência de uso">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Acesso à Rua</h3>
                            <div class="question-group">
                                <label>O animal tem acesso a rua desacompanhado?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="street_access" value="yes"> Sim</label>
                                    <label><input type="radio" name="street_access" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="street_access" data-value="yes">
                                    <label>Por quanto tempo?</label>
                                    <input type="text" placeholder="Tempo de acesso">
                                    <label>Com que frequência?</label>
                                    <input type="text" placeholder="Frequência de acesso">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Exposição a Produtos Químicos</h3>
                            <div class="question-group">
                                <label>O animal tem acesso a áreas onde são aplicados produtos químicos para o controle de pragas, como gramados tratados com pesticidas ou algum outro poluente ambiental?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="chemical_exposure" value="yes"> Sim</label>
                                    <label><input type="radio" name="chemical_exposure" value="no"> Não</label>
                                </div>
                            </div>
                            
                            <div class="question-group">
                                <label>O animal é fumante passivo? (convive com algum fumante)</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="passive_smoker" value="yes"> Sim</label>
                                    <label><input type="radio" name="passive_smoker" value="no"> Não</label>
                                </div>
                            </div>
                            
                            <div class="question-group">
                                <label>Mora perto de alguma indústria, fábrica (cimento, telha, fibra, etc)?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="near_industry" value="yes"> Sim</label>
                                    <label><input type="radio" name="near_industry" value="no"> Não</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Contracepção</h3>
                            <div class="question-group">
                                <label>O animal já fez/faz uso de injeção contraceptiva?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="contraceptive_injection" value="yes"> Sim</label>
                                    <label><input type="radio" name="contraceptive_injection" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="contraceptive_injection" data-value="yes">
                                    <label>Qual a frequência da administração?</label>
                                    <input type="text" placeholder="Frequência">
                                    <label>Qual a data da última aplicação?</label>
                                    <input type="date">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Histórico de Saúde</h3>
                            <div class="question-group">
                                <label>O animal já apresentou algum problema de pele?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="skin_problems" value="yes"> Sim</label>
                                    <label><input type="radio" name="skin_problems" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="skin_problems" data-value="yes">
                                    <label>Qual?</label>
                                    <input type="text" placeholder="Problema de pele">
                                    <label>Teve recidiva?</label>
                                    <div class="radio-group">
                                        <label><input type="radio" name="skin_recurrence" value="yes"> Sim</label>
                                        <label><input type="radio" name="skin_recurrence" value="no"> Não</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="question-group">
                                <label>O animal tem alguma doença?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="has_disease" value="yes"> Sim</label>
                                    <label><input type="radio" name="has_disease" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="has_disease" data-value="yes">
                                    <label>Se sim, está sendo tratada?</label>
                                    <div class="radio-group">
                                        <label><input type="radio" name="disease_treated" value="yes"> Sim</label>
                                        <label><input type="radio" name="disease_treated" value="no"> Não</label>
                                    </div>
                                    <label>Como você avalia a resposta do animal ao tratamento?</label>
                                    <input type="text" placeholder="Avaliação do tratamento">
                                </div>
                            </div>
                            
                            <div class="question-group">
                                <label>Faz uso de alguma medicação de forma contínua?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="continuous_medication" value="yes"> Sim</label>
                                    <label><input type="radio" name="continuous_medication" value="no"> Não</label>
                                </div>
                                <div class="conditional-field" data-condition="continuous_medication" data-value="yes">
                                    <label>Qual?</label>
                                    <input type="text" placeholder="Medicação">
                                    <label>Quando teve início?</label>
                                    <input type="date">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Exames</h3>
                            <div class="question-group">
                                <label>O animal é submetido a exames de sangue ou outros testes laboratoriais para avaliar sua saúde geral?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="lab_tests" value="yes"> Sim</label>
                                    <label><input type="radio" name="lab_tests" value="no"> Não</label>
                                </div>
                            </div>
                            
                            <div class="question-group">
                                <label>O animal já foi submetido a exames de imagem (como radiografias, ultrassonografias) para monitorar sua saúde?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="imaging_tests" value="yes"> Sim</label>
                                    <label><input type="radio" name="imaging_tests" value="no"> Não</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Histórico Familiar</h3>
                            <div class="question-group">
                                <label>O animal tem histórico familiar de câncer?</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="family_cancer_history" value="yes"> Sim</label>
                                    <label><input type="radio" name="family_cancer_history" value="no"> Não</label>
                                    <label><input type="radio" name="family_cancer_history" value="dont_know"> Não sei</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn secondary">Cancelar</button>
                <button class="btn primary">Salvar Paciente</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle sidebar em telas pequenas
        $('.menu-toggle').click(function() {
            $('.sidebar').toggleClass('active');
        });

        // Abrir modal de novo paciente
        $('.new-patient, .add-patient-btn').click(function() {
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
        
    });    
</script>
</body>
</html>