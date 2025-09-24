<div class="modal-container">
    <div class="modal-header">
        <h2 id="modalTitle">Novo Paciente</h2>
        <button class="close-modal">&times;</button>
    </div>
    <div class="modal-body">
        <!-- Navegação por abas -->
        <div class="tabs">
            <button class="tab-button active" data-tab="data">Dados</button>
            <button class="tab-button" data-tab="questionnaire">Questionário</button>
            <button class="tab-button hideOnCreate" data-tab="consultas">Consultas</button>
            <button class="tab-button hideOnCreate" data-tab="exames">Exames</button>
            <button class="tab-button hideOnCreate" onclick="getDocumentos()" data-tab="documentos">Documentos</button>
            <button class="tab-button hideOnCreate" onclick="getImagens()" data-tab="imagens">Imagens</button>
        </div>

        <form id="patientForm">
            <!-- Aba Dados -->
            @csrf
            <input type="hidden" id="cdPaciente" name="cdPaciente">
            <div id="data-tab" class="tab-content active">
                <div class="form-section">
                    <h3>Informações do Animal</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="petName">Nome</label>
                            <input type="text" id="petName" name="nmPaciente" placeholder="Ex: Rex" required>
                        </div>
                        <div class="form-group">
                            <label for="species">Espécie</label>
                            <select id="species" name="especie" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="dog">Cão</option>
                                <option value="cat">Gato</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="breed">Raça</label>
                            <input type="text" id="breed" name="raca" placeholder="Ex: Labrador">
                        </div>
                        <div class="form-group">
                            <label for="age">Idade (anos)</label>
                            <input type="text" id="age" name="idade" min="0" max="30">
                        </div>
                        <div class="form-group">
                            <label for="gender">Sexo</label>
                            <select id="gender" name="sexo">
                                <option value="" disabled selected>Selecione</option>
                                <option value="male">Macho</option>
                                <option value="female">Fêmea</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="weight">Peso (kg)</label>
                            <input type="number" id="weight" name="peso" step="0.1" min="0">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Informações do Responsável</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="ownerName">Nome Completo</label>
                            <input type="text" id="ownerName" name="nmTutor" placeholder="Ex: João Silva" required>
                        </div>
                        <div class="form-group">
                            <label for="ownerPhone">Telefone</label>
                            <input type="tel" id="ownerPhone" name="telefone" placeholder="(00) 00000-0000" required>
                        </div>
                        <div class="form-group">
                            <label for="ownerEmail">E-mail</label>
                            <input type="email" id="ownerEmail" name="email" placeholder="exemplo@email.com">
                        </div>
                        <div class="form-group">
                            <label for="ownerAddress">Endereço</label>
                            <input type="text" id="ownerAddress" name="endereco" placeholder="Rua, número - Cidade">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Histórico Médico</h3>
                    <div class="form-group">
                        <label for="medicalNotes">Observações</label>
                        <textarea id="medicalNotes" name="obs" rows="3" placeholder="Alergias, condições pré-existentes, etc."></textarea>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="vaccineStatus">Status de Vacinação</label>
                            <select id="vaccineStatus" name="statusVacinacao">
                                <option value="updated">Em dia</option>
                                <option value="pending">Pendente</option>
                                <option value="unknown">Desconhecido</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cdClinica">Clínica</label>
                            <select id="cdClinica" name="cdClinica" class="form-control">
                                <option value="">Selecione a clínica</option>
                                @foreach($clinicas as $clinica)
                                    <option value="{{ $clinica->cdClinica }}">{{ $clinica->nmClinica }}</option>
                                @endforeach
                            </select>
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
                            <label><input type="radio" name="castrated" id="castrated" value="yes"> Sim</label>
                            <label><input type="radio" name="castrated" id="castrated" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="castrated" data-value="yes">
                            <label>Se sim, quando?</label>
                            <input type="date" id="castration_date" name="castration_date">
                        </div>
                        <div class="conditional-field" data-condition="castrated" data-value="no">
                            <label>Já considerou a castração como medida preventiva contra certos tipos de câncer?</label>
                            <div class="radio-group">
                                <label><input type="radio" name="considered_castration" id="considered_castration" value="yes"> Sim</label>
                                <label><input type="radio" name="considered_castration" id="considered_castration" value="no"> Não</label>
                            </div>
                        </div>
                    </div>

                    <div class="question-group">
                        <label>Os cios são regulares?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="regular_cycles" id="regular_cycles" value="yes"> Sim</label>
                            <label><input type="radio" name="regular_cycles" id="regular_cycles" value="no"> Não</label>
                            <label><input type="radio" name="regular_cycles" id="regular_cycles" value="na"> Não se aplica</label>
                        </div>
                    </div>

                    <div class="question-group">
                        <label>Já ficou gestante?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="pregnant" id="pregnant" value="yes"> Sim</label>
                            <label><input type="radio" name="pregnant" id="pregnant" value="no"> Não</label>
                        </div>
                    </div>

                    <div class="question-group">
                        <label>Apresentou gestação psicológica (pseudociese)?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="pseudopregnancy" id="pseudopregnancy" value="yes"> Sim</label>
                            <label><input type="radio" name="pseudopregnancy" id="pseudopregnancy" value="no"> Não</label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Alimentação</h3>
                    <div class="question-group">
                        <label>Qual tipo de alimentação o animal consome?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="food_type" id="food_type" value="commercial"> Ração</label>
                            <label><input type="radio" name="food_type" id="food_type" value="homemade"> Caseira</label>
                            <label><input type="radio" name="food_type" id="food_type" value="natural"> Natural</label>
                        </div>
                        <div class="conditional-field" data-condition="food_type">
                            <label>Qual?</label>
                            <input type="text" id="food_type_spec" name="food_type_spec" placeholder="Especificar tipo de alimentação">
                        </div>
                    </div>

                    <div class="question-group">
                        <label>Faz uso de suplemento alimentar ou vitaminas como parte da dieta?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="supplements" id="supplements" value="yes"> Sim</label>
                            <label><input type="radio" name="supplements" id="supplements" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="supplements" data-value="yes">
                            <label>Qual?</label>
                            <input type="text" id="supplements_type" name="supplements_type" placeholder="Especificar suplementos">
                        </div>
                    </div>

                    <div class="question-group">
                        <label>A alimentação inclui alimentos processados, conservantes ou corantes artificiais?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="preservatives" id="preservatives" value="yes"> Sim</label>
                            <label><input type="radio" name="preservatives" id="preservatives" value="no"> Não</label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Controle de Ectoparasitas</h3>
                    <div class="question-group">
                        <label>O animal faz controle de ectoparasitas?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="ectoparasite_control" id="ectoparasite_control" value="yes"> Sim</label>
                            <label><input type="radio" name="ectoparasite_control" id="ectoparasite_control" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="ectoparasite_control" data-value="yes">
                            <label>Nome do produto:</label>
                            <input type="text" id="ectoparasite_product" name="ectoparasite_product" placeholder="Nome do produto">
                            <label>Qual frequência?</label>
                            <input type="text" id="ectoparasite_frequency" name="ectoparasite_frequency" placeholder="Frequência de uso">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Vermifugação</h3>
                    <div class="question-group">
                        <label>O animal faz uso de vermífugo?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="deworming" id="deworming" value="yes"> Sim</label>
                            <label><input type="radio" name="deworming" id="deworming" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="deworming" data-value="yes">
                            <label>Nome do produto:</label>
                            <input type="text" id="deworming_product" name="deworming_product" placeholder="Nome do produto">
                            <label>Qual frequência?</label>
                            <input type="text" id="deworming_frequency" name="deworming_frequency" placeholder="Frequência de uso">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Vacinação</h3>
                    <div class="question-group">
                        <label>O animal é vacinado anualmente?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="vaccinated" id="vaccinated" value="yes"> Sim</label>
                            <label><input type="radio" name="vaccinated" id="vaccinated" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="vaccinated" data-value="yes">
                            <label>Com quais vacinas?</label>
                            <input type="text" id="vaccines" name="vaccines" placeholder="Lista de vacinas">
                            <label>Qual foi a última vez que foi vacinado?</label>
                            <input type="date" id="last_vaccine_date" name="last_vaccine_date">
                            <label>Vacinação é feita em clínica veterinária?</label>
                            <div class="radio-group">
                                <label><input type="radio" name="vet_clinic_vaccine" id="vet_clinic_vaccine" value="yes"> Sim</label>
                                <label><input type="radio" name="vet_clinic_vaccine" id="vet_clinic_vaccine" value="no"> Não</label>
                            </div>
                            <label>Em qual local do corpo do animal é feita a vacinação?</label>
                            <input type="text" id="vaccine_location" name="vaccine_location" placeholder="Local da vacinação">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Exposição Solar</h3>
                    <div class="question-group">
                        <label>O animal fica exposto ao sol em algum período do dia?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="sun_exposure" id="sun_exposure" value="yes"> Sim</label>
                            <label><input type="radio" name="sun_exposure" id="sun_exposure" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="sun_exposure" data-value="yes">
                            <label>Por quanto tempo/dia?</label>
                            <input type="text" id="sun_exposure_time" name="sun_exposure_time" placeholder="Tempo de exposição">
                            <label>Qual período do dia o animal fica mais exposto?</label>
                            <input type="text" id="sun_exposure_period" name="sun_exposure_period" placeholder="Período do dia">
                        </div>
                    </div>

                    <div class="question-group">
                        <label>Usa proteção solar?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="sunscreen" id="sunscreen" value="yes"> Sim</label>
                            <label><input type="radio" name="sunscreen" id="sunscreen" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="sunscreen" data-value="yes">
                            <label>Qual tipo?</label>
                            <input type="text" id="sunscreen_type" name="sunscreen_type" placeholder="Tipo de protetor">
                            <label>Com que frequência?</label>
                            <input type="text" id="sunscreen_frequency" name="sunscreen_frequency" placeholder="Frequência de uso">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Acesso à Rua</h3>
                    <div class="question-group">
                        <label>O animal tem acesso a rua desacompanhado?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="street_access" id="street_access" value="yes"> Sim</label>
                            <label><input type="radio" name="street_access" id="street_access" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="street_access" data-value="yes">
                            <label>Por quanto tempo?</label>
                            <input type="text" id="street_access_time" name="street_access_time" placeholder="Tempo de acesso">
                            <label>Com que frequência?</label>
                            <input type="text" id="street_access_frequency" name="street_access_frequency" placeholder="Frequência de acesso">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Exposição a Produtos Químicos</h3>
                    <div class="question-group">
                        <label>O animal tem acesso a áreas onde são aplicados produtos químicos para o controle de pragas, como gramados tratados com pesticidas ou algum outro poluente ambiental?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="chemical_exposure" id="chemical_exposure" value="yes"> Sim</label>
                            <label><input type="radio" name="chemical_exposure" id="chemical_exposure" value="no"> Não</label>
                        </div>
                    </div>

                    <div class="question-group">
                        <label>O animal é fumante passivo? (convive com algum fumante)</label>
                        <div class="radio-group">
                            <label><input type="radio" name="passive_smoker" id="passive_smoker" value="yes"> Sim</label>
                            <label><input type="radio" name="passive_smoker" id="passive_smoker" value="no"> Não</label>
                        </div>
                    </div>

                    <div class="question-group">
                        <label>Mora perto de alguma indústria, fábrica (cimento, telha, fibra, etc)?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="near_industry" id="near_industry" value="yes"> Sim</label>
                            <label><input type="radio" name="near_industry" id="near_industry" value="no"> Não</label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Contracepção</h3>
                    <div class="question-group">
                        <label>O animal já fez/faz uso de injeção contraceptiva?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="contraceptive_injection" id="contraceptive_injection" value="yes"> Sim</label>
                            <label><input type="radio" name="contraceptive_injection" id="contraceptive_injection" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="contraceptive_injection" data-value="yes">
                            <label>Qual a frequência da administração?</label>
                            <input type="text" id="contraceptive_frequency" name="contraceptive_frequency" placeholder="Frequência">
                            <label>Qual a data da última aplicação?</label>
                            <input type="date" id="last_contraceptive_date" name="last_contraceptive_date">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Histórico de Saúde</h3>
                    <div class="question-group">
                        <label>O animal já apresentou algum problema de pele?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="skin_problems" id="skin_problems" value="yes"> Sim</label>
                            <label><input type="radio" name="skin_problems" id="skin_problems" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="skin_problems" data-value="yes">
                            <label>Qual?</label>
                            <input type="text" id="skin_problem_type" name="skin_problem_type" placeholder="Problema de pele">
                            <label>Teve recidiva?</label>
                            <div class="radio-group">
                                <label><input type="radio" name="skin_recurrence" id="skin_recurrence" value="yes"> Sim</label>
                                <label><input type="radio" name="skin_recurrence" id="skin_recurrence" value="no"> Não</label>
                            </div>
                        </div>
                    </div>

                    <div class="question-group">
                        <label>O animal tem alguma doença?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="has_disease" id="has_disease" value="yes"> Sim</label>
                            <label><input type="radio" name="has_disease" id="has_disease" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="has_disease" data-value="yes">
                            <label>Se sim, está sendo tratada?</label>
                            <div class="radio-group">
                                <label><input type="radio" name="disease_treated" id="disease_treated" value="yes"> Sim</label>
                                <label><input type="radio" name="disease_treated" id="disease_treated" value="no"> Não</label>
                            </div>
                            <label>Como você avalia a resposta do animal ao tratamento?</label>
                            <input type="text" id="treatment_response" name="treatment_response" placeholder="Avaliação do tratamento">
                        </div>
                    </div>

                    <div class="question-group">
                        <label>Faz uso de alguma medicação de forma contínua?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="continuous_medication" id="continuous_medication" value="yes"> Sim</label>
                            <label><input type="radio" name="continuous_medication" id="continuous_medication" value="no"> Não</label>
                        </div>
                        <div class="conditional-field" data-condition="continuous_medication" data-value="yes">
                            <label>Qual?</label>
                            <input type="text" id="medication_type" name="medication_type" placeholder="Medicação">
                            <label>Quando teve início?</label>
                            <input type="date" id="medication_start_date" name="medication_start_date">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Exames</h3>
                    <div class="question-group">
                        <label>O animal é submetido a exames de sangue ou outros testes laboratoriais para avaliar sua saúde geral?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="lab_tests" id="lab_tests" value="yes"> Sim</label>
                            <label><input type="radio" name="lab_tests" id="lab_tests" value="no"> Não</label>
                        </div>
                    </div>

                    <div class="question-group">
                        <label>O animal já foi submetido a exames de imagem (como radiografias, ultrassonografias) para monitorar sua saúde?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="imaging_tests" id="imaging_tests" value="yes"> Sim</label>
                            <label><input type="radio" name="imaging_tests" id="imaging_tests" value="no"> Não</label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Histórico Familiar</h3>
                    <div class="question-group">
                        <label>O animal tem histórico familiar de câncer?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="family_cancer_history" id="family_cancer_history" value="yes"> Sim</label>
                            <label><input type="radio" name="family_cancer_history" id="family_cancer_history" value="no"> Não</label>
                            <label><input type="radio" name="family_cancer_history" id="family_cancer_history" value="dont_know"> Não sei</label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="consultas-tab" class="tab-content">
                <div class="form-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="m-0">Consultas</h3>
                        <button class="btn primary new-consulta">
                            <i class="fas fa-plus"></i>
                            Nova Consulta
                        </button>
                    </div>

                    <div id="consultas-container"></div>
                </div>
            </div>

            <div id="exames-tab" class="tab-content">
                <div class="form-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="m-0">Exames</h3>
                        <button class="btn primary new-consulta">
                            <i class="fas fa-plus"></i>
                            Novo Exame
                        </button>
                    </div>

                    <div id="exames-container"></div>
                </div>
            </div>



            
        </form>

        <div id="documentos-tab" class="tab-content">
            <div class="form-section">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="m-0">Documentos</h3>
                    <button class="btn primary new-documento">
                        <i class="fas fa-plus"></i>
                        Novo Documento
                    </button>
                </div>

                <div id="documentos-container-add" class="d-flex flex-wrap gap-3" style="justify-content: center;"></div>

                <div class="d-flex justify-content-center" style="align-items: center; margin-left: 5%;">
                    <div id="documentos-container"></div>
                </div>

            </div>
        </div>

        <div id="imagens-tab" class="tab-content">
            <div class="form-section">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="m-0">Imagens</h3>
                    <button type="button" class="btn primary new-imagem">
                        <i class="fas fa-plus"></i> Nova Imagem
                    </button>
                </div>
                
                <div id="imagens-container-add" class="d-flex flex-wrap gap-3" style="justify-content: center;"></div>

                <div class="d-flex justify-content-center" style="align-items: center; margin-left: 5%;">
                    <div id="imagens-container" class="d-inline-flex flex-wrap gap-3"></div>
                </div>

            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button class="btn secondary">Cancelar</button>
        <button class="btn primary" id="btnAddPaciente" type="button">Salvar Paciente</button>
    </div>
</div>