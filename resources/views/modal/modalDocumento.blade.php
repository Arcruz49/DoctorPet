<div class="modal-container">
    <div class="modal-header">
        <h2 id="modalTitle">Novo Modelo de Documento</h2>
        <button class="close-modal">&times;</button>
    </div>

    <div class="modal-body">
        <form id="documentForm">
            @csrf
            <input type="hidden" id="cdModeloDocumento" name="cdModeloDocumento">

            <div class="form-section">
                <h3>Informações do Modelo</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nmModeloDocumento">Nome do Documento</label>
                        <input type="text" id="nmModeloDocumento" name="nmModeloDocumento" placeholder="Ex: Prontuário" required>
                    </div>

                    <div class="form-group">
                        <label for="descModeloDocumento">Descrição</label>
                        <input type="text" id="descModeloDocumento" name="descModeloDocumento" placeholder="Breve descrição do modelo...">
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label for="html">Conteúdo HTML</label>
                        <textarea id="html" name="html" rows="10" placeholder="Digite ou cole o HTML do documento aqui..." required></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal-footer">
        <button class="btn secondary">Cancelar</button>
        <button class="btn primary" id="btnSalvarDocumento" type="button">Salvar Documento</button>
    </div>
</div>
