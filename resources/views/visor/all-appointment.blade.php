  <div class="row">
      @foreach ($appointments as $appointment)
          <div class="col-md-4 col-lg-4 d-flex">
              <div class="card mb-grid w-100">
                  <div class="card border-0 bg-primary text-white text-center mb-grid w-100">
                      <div class="d-flex flex-row align-items-center h-100">

                          <div class="card-body">
                              <div class="card-info-title mb-3">Paciente</div>
                              <h3 class="card-title mb-0">
                                  {{ $appointment->nombre }} {{ $appointment->apellido_paterno }}
                              </h3>
                          </div>
                      </div>
                  </div>
                  <div class="card-body d-flex flex-column">
                      <div class="d-flex justify-content-between mb-3">
                          <h5 class="card-title mb-0">
                              {{ $appointment->NOMBRE_SERVICIO }}
                          </h5>
                      </div>

                      <div class="card-title mb-0">
                          <span class="d-block">tiempo estimado : {{ $appointment->duracion_cita }} mín</span>
                          <span class="d-block">turno asignado : {{ $appointment->turno_cita }} </span>
                          <span class="d-block">Profesional : {{ $appointment->NOMBRE_DOCTOR }} </span>
                          {{-- <span class="d-block">estado : {{ $appointment->estado_cita }}</span> --}}
                      </div>
                  </div>

                  @php
                      switch ($appointment->estado_cita) {
                          case 'PACIENTE_LLEGO':
                              $estado = 'PACIENTE LLEGO';
                              $color = 'bg-info';
                              break;

                          case 'LLAMANDO':
                              $estado = 'Llamando paciente';
                              $color = 'bg-info';
                              break;

                          case 'ATENDIDO':
                              $estado = 'Paciente Atendido';
                              $color = 'bg-info';
                              break;

                          case 'REEVALUACION':
                              $estado = 'Paciente con reevaluación';
                              $color = 'bg-info';
                              break;

                          case 'EN_ESPERA':
                              $estado = 'Paciente en espera';
                              $color = 'bg-danger';
                              break;

                          default:
                              $estado = 'Paciente sin atención';
                              $color = 'bg-info';
                              break;
                      }
                  @endphp

                  <div class="card-footer text-white text-center {{ $color }} ">
                      <div class="card-info-title ">{{ $estado }}</div>
                  </div>
              </div>
          </div>
      @endforeach

  </div>
