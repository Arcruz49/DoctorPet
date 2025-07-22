<div class="modal-container modal-lg">
    <div class="modal-header">
        <h2 id="modalTitleConsulta">Adicionar Paciente</h2>
        <button class="close-modal">&times;</button>
    </div>

    <div class="modal-body">
        <div class="search-box" style="max-width: 250px; margin-bottom: 10px;">
            <input type="text" id="search" placeholder="Buscar paciente...">
            <button><i class="fas fa-search"></i></button>
        </div>

        <div class="filters">
        <div class="filter-group">
            <label>Clínica:</label>
            <select id="searchClinica" class="filter">
                <option value="-1">Todas</option>
                @foreach($clinicas as $clinica)
                    <option value="{{ $clinica->cdClinica }}">{{ $clinica->nmClinica }}</option>
                @endforeach
            </select>
        </div>
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

    
</div>


<style>
.patient-card{
    cursor: pointer;
}
</style>