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
            //actualizarContadores();
        }, 'json');
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
