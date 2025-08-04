<div class="modal-container">
    <div class="modal-header">
        <h2 id="modalConsultaTitleAtender">Atender Consulta</h2>
        <button class="close-modal">&times;</button>
    </div>
    <div class="modal-body">
        <form id="AtenderConsultaForm">
            @csrf
            <input type="hidden" id="cdConsultaAtendimento" name="cdConsultaAtendimento">

            <div class="form-section">
                <h3>Anamnese</h3>
                <div class="form-group">
                    <label for="queixaPrincipal">Queixa Principal</label>
                    <textarea id="queixaPrincipal" name="queixaPrincipal" rows="5" placeholder="Descreva a queixa principal do paciente"></textarea>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="inicioSintomas">Início</label>
                        <textarea id="inicioSintomas" name="inicio" rows="5" placeholder="Quando os sintomas começaram?"></textarea>

                    </div>
                    <div class="form-group">
                        <label for="progressaoSintomas">Progressão</label>
                        <textarea id="progressaoSintomas" name="progressao" rows="5" placeholder="Como os sintomas evoluíram?"></textarea>

                    </div>
                </div>
                <div class="form-group">
                    <label for="sinaisClinicos">Sinais Clínicos Observados</label>
                    <textarea id="sinaisClinicos" name="sinais" rows="5" placeholder="Descreva os sinais clínicos observados"></textarea>
                </div>
            </div>

            <div class="form-section">
                <h3>Exame Físico</h3>
                <div class="form-group">
                    <label for="medidasClinicas">Medidas</label>
                    <textarea id="medidasClinicas" name="medidas" rows="5" placeholder="Medições"></textarea>
                </div>
                <div class="form-group">
                    <label for="observacoesExame">Observações</label>
                    <textarea id="observacoesExame" name="obs" rows="5" placeholder="Outras observações relevantes"></textarea>
                </div>
            </div>

            <div class="form-section">
                <h3>Diagnóstico e Tratamento</h3>
                <div class="form-group">
                    <label for="examesSolicitados">Exames Solicitados</label>
                    <textarea id="examesSolicitados" name="examesSolicitados" rows="5" placeholder="Liste os exames solicitados"></textarea>
                </div>
                <div class="form-group">
                    <label for="sugestoesDiagnosticas">Sugestões</label>
                    <textarea id="sugestoesDiagnosticas" name="sugestoes" rows="5" placeholder="Hipóteses diagnósticas"></textarea>
                </div>
                <div class="form-group">
                    <label for="prescricoes">Prescrições</label>
                    <textarea id="prescricoes" name="prescricoes" rows="5" placeholder="Medicações, dosagens, etc."></textarea>
                </div>
                <div class="form-group">
                    <label for="objetivosTratamento">Objetivos do Tratamento</label>
                    <textarea id="objetivosTratamento" name="objetivos" rows="5" placeholder="Metas do tratamento proposto"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn secondary fecharModal" type="button" id="btnFecharConsultaSemSalvar">Fechar sem salvar</button>
                <button class="btn btn-confirm" type="button" id="btnFecharConsulta">Salvar</button>
                <button class="btn primary" id="btnFinalizarConsulta" type="button">Finalizar Atendimento</button>
            </div>
        </form>
    </div>
</div>