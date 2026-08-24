<!-- Modal -->
<div class="modal fade" id="estadoCita-{{ $appointment->id }}" tabindex="-1"
    aria-labelledby="estadoCita-{{ $appointment->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="estadoCita-{{ $appointment->id }}Label">Gestión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-grid">
                    <div class="card-header">
                        <div class="card-header-title">Control Llamado</div>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('admision.update') }}" method="POST">

                            @method('put')
                            @csrf

                            <div class="form-group">
                                <label class="form-label" for="estado_cita">Seleccione el estado</label>
                                <input type="hidden" name="appointment_id" id="appointment_id"
                                    value="{{ $appointment->id }}">
                                <select class="form-control" name="estado_cita" id="estado_cita">
                                    <option value="PACIENTE_LLEGO">PACIENTE LLEGO</option>
                                    <option value="LLAMANDO">LLAMANDO</option>
                                    <option value="REEVALUACION">REEVALUACIÓN</option>
                                    <option value="ATENDIDO">ATENDIDO</option>
                                    <option value="EN_ATENCION">EN ATENCIÓN</option>
                                </select>
                            </div>

                            <input type="submit" class="btn btn-sm btn-primary w-100" value="Aplicar">
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
