<div class="modal-container">
    <div class="modal-header">
        <h2 id="modalTitle">Nova Clínica</h2>
        <button class="close-modal">&times;</button>
    </div>
    <div class="modal-body">
        <!-- Navegação por abas -->
        <div class="tabs">
            <button class="tab-button active" data-tab="data">Dados</button>
        </div>

        <form id="clinicForm">
            <!-- Aba Dados -->
            @csrf
            <input type="hidden" id="cdClinica" name="cdClinica">
            <div id="data-tab" class="tab-content active">
                <div class="form-section">
                    <h3>Informações da Clínica</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nmClinica">Nome</label>
                            <input type="text" id="nmClinica" name="nmClinica" placeholder="Ex: Clinica Vet..." required>
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <input type="text" id="endereco" name="endereco" placeholder="Ex: Rua...">
                        </div>
                        
                    </div>
                </div>

                
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button class="btn secondary">Cancelar</button>
        <button class="btn primary" id="btnAddClinica" type="button">Salvar Clínica</button>
    </div>
</div>
    
