<div class="modal-container">
    <div class="modal-header">
        <h2 id="modalTitleConsulta">Nova Consulta</h2>
        <button class="close-modal">&times;</button>
    </div>

    <div class="modal-body">
        <form id="consultaForm">
            @csrf
            <input type="hidden" id="cdConsulta" name="cdConsulta">

            <div class="form-section">
                <h3>Agendar Consulta</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <div class="add-patient-card" id="btnAbrirModalPaciente">
                            <button type="button" class="add-patient-btn">
                                <i class="fas fa-plus-circle"></i>
                                <span>Adicionar Paciente</span>
                            </button>
                        </div>
                    </div>

                    <input style="display: none" type="text" id="cdPacienteAdicionado" name="cdPacienteAdicionado">

                    <div class="form-group">
                        <label for="dtConsulta">Data da Consulta</label>
                        <input type="datetime-local" id="dtConsulta" name="dtConsulta" required>
                    </div>

                   
                </div>
            </div>
        </form>
    </div>

    <div class="modal-footer">
        <button class="btn secondary" type="button">Cancelar</button>
        <button class="btn primary" id="btnSalvarConsulta" type="button">Salvar Consulta</button>
    </div>
</div>


