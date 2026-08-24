$(function () {

    //PARA ACTIVAR EL LLAMADO UNA SOLA VEZ
    let tts = document.querySelector('.tts');
    if (tts) {
        tts.addEventListener('click', function () {
            hablar("Sistema de llamado activado");
        });
    }

    //PARA VALIDAR , CADA VEZ QUE EL DR LLAMA , SE ACTUALIZA LA HORA 
    //Y CON ELLO SE PODRA LLAMAR LA VECES REQUERIDAS
    let ultimoLlamado = null;
    let ultimaFechaLlamado = null;


    //DISPARADOR PARA LLAMAR LA FUNCION CADA 3 SEGUNDOS
    let count_appointment = $('#count-appointment').val();
    if (count_appointment >= 1) {
        setInterval(contador, 3000);
    }

    function contador() {
        fecthAllCategories();
    }


    //LISTA DE PACIENTES Y DEVOLUCION DEL LLAMADO DE CADA PACIENTE
    fecthAllCategories();

    function fecthAllCategories() {

        $.get('/all-appointment/visor/temp', {}, function (data) {

            $('#All-appointment').html(data.result).fadeIn();
            console.log('DATOS PACIENTE TEMPORAL', data);

            //console.log('paciente: ', data.llamando.nombre)
            //console.log('fecha_actualiza: ', data.llamando.updated_at);

            if (data.llamando) {
                //VALIDAMOS CON CONDICIONALES EL ID DEL PACIENTE Y LA ULTIMA ACTUALIZACION 
                //PARA EL LLAMADO 
                if (
                    ultimoLlamado != data.llamando.id ||
                    ultimaFechaLlamado != data.llamando.updated_at
                ) {
                    ultimoLlamado = data.llamando.id;
                    ultimaFechaLlamado = data.llamando.updated_at;

                    hablar(
                        "Paciente " + data.llamando.nombre +
                        " " + data.llamando.apellido_paterno +
                        ", dirigirse a " + data.llamando.especialidad +
                        ", con el doctor " + data.llamando.nombre_doctor
                    );
                }
            }

            //ACTUALIZAR CONTADORES
            actualizarContadores();
        }, 'json');
    }

    //FUNCION CONTADOR
    function actualizarContadores() {
        $('.contador').each(function () {
            let elemento = $(this);

            let horaLlamado = elemento.data('hora-llamado'); //EXTRAE LA HORA DEL LLAMADO
            let tiempoPermitido = parseInt(elemento.data('tiempo')); //EXTRAE EL TIEMPO DE MOTIVO (15 o 20)

            if (!horaLlamado) {
                return;
            }

            //CONVERTIMOS LA FECHA DE LARAVEL: [2026-08-07 15:11:06 => 2026-08-07T15:11:06]
            let inicio = new Date(horaLlamado.replace(' ', 'T'));
            let ahora = new Date();
            console.log(ahora); //Fri Aug 14 2026 14:11:43 GMT-0500 (Peru Standard Time)

            let transcurrido = Math.floor((ahora - inicio) / 1000); //SEGUNDOS TRANSCURRIDOS
            let limite = tiempoPermitido * 60; //TIEMPO PERMITIDO EN SEGUNDOS
            let restante = limite - transcurrido; //TIEMPO RESTANTE

            if (restante > 0) {
                let minutos = Math.floor(restante / 60);
                let segundos = restante % 60; //936 ÷ 60 => 15 y sobra 36

                elemento.text('Restante:' + minutos + 'min:' + String(segundos).padStart(2, '0'));

                if (restante > 600) { //MAS DE 10 MINUTOS
                    elemento.css({
                        'background': 'blue',
                        'color': 'white',
                        'padding': '5px 12px',
                        'border-radius': '10px',
                    });
                } else {
                    //MENOS DE 10 MINUTOS
                    elemento.css({
                        'background': 'orange',
                        'color': 'white',
                        'padding': '5px 12px',
                        'border-radius': '10px',
                    });
                }
            } else {
                let excedido = Math.abs(restante); //VALOR ABSOLUTO 
                let minutos = Math.floor(excedido / 60);
                let segundos = excedido % 60;

                elemento.text('Excedido: ' + minutos + ':' + String(segundos).padStart(2, '0'));
                elemento.css({
                    'background': 'red',
                    'color': 'white',
                    'padding': '5px 12px',
                    'border-radius': '10px',
                });
            }
        })
    }

    //FUNCION HABLAR
    function hablar(texto) {

        let utterance = new SpeechSynthesisUtterance();

        utterance.text = texto;
        utterance.lang = "es-MX";
        utterance.rate = 0.9;
        utterance.volume = 1;

        speechSynthesis.cancel();
        speechSynthesis.speak(utterance);
        console.log("Hablando:", texto);

    }

});
