@extends('layouts.app')


@section('css_data_temporal')
    <link rel="stylesheet" type="text/css" href="{{ asset('temporal/css/visor/main.css') }}" media="screen" />
@endsection


@section('main_temporal')
    <div class="wrap">
        <header>
            <div class="brand">
                <div class="brand-mark">T</div>
                <div>
                    <h1>Lista de espera</h1>
                    <p>Su número de atención y tiempo estimado, actualizados en vivo</p>
                </div>
            </div>
            <div class="clock">
                <div class="time" id="clock">--:--</div>
                <div class="updated"><span class="dot-live"></span><span id="updated">esperando datos…</span></div>
            </div>
        </header>

        <svg class="ecg" viewBox="0 0 340 26" preserveAspectRatio="none">
            <path d="M0,13 L120,13 L132,2 L144,24 L156,13 L340,13" />
        </svg>

        <div class="cols-head">
            <span># Atención</span><span>Paciente</span><span>Estado</span><span>Espera aprox.</span>
        </div>

        <input type="hidden" name="count-appointment" id="count-appointment" value="1">
        <div class="list" id="list">
            <div id="All-appointment"></div>
        </div>

        <footer>La pantalla no muestra datos clínicos ni de pago · Se actualiza automáticamente cada 4 segundos</footer>

    @section('script_data')
        <script src="{{ asset('temporal/js/visor/activar-sonido.js') }}"></script>
        <script src="{{ asset('temporal/js/visor/visor.js') }}"></script>
    @endsection
</div>

<button class="sound-toggle off" id="soundToggle" onclick="toggleSonido()">
    <span class="icon">🔇</span><span id="soundToggleLabel">Activar llamado por voz</span>
</button>
@endsection
