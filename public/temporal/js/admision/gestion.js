console.log('CARGANDO DESDE GESTION TEMPORAL ADMISION');


//PARA INACTIVAR AL PACIENTE
$(document).on("click", ".llamar-paciente", async function (e) {
    e.preventDefault();

    let appointmentId = $(this).data("id");
    let estado = $(this).data("estado");
    console.log("estado", estado);
    console.log('id cita', appointmentId);


    try {
        const res = await fetch(`${window.location.origin}/llamar-temporal-paciente`, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                id: appointmentId,
                estado_cita: estado
            }),
        });

        const data = await res.json();
        console.log('Datos', data);

        if (data.code === 1) {
            Swal.fire({
                title: "¡Estado!" + data.msg,
                text: data.msg,
                icon: "success",
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                title: "Error",
                text: data.msg,
                icon: "error"
            });
        }

    } catch (error) {
        console.error(error);

        Swal.fire({
            title: "Error",
            text: "Ocurrió un error al procesar la solicitud",
            icon: "error"
        });
    }
});


//FUNCION CONTADOR ASCENDENTE (De menor a mayor)
let count_appointment = 1;
if (count_appointment >= 1) {
    setInterval(actualizarContadores, 1000);
}

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

        let transcurrido = Math.floor((ahora - inicio) / 1000); //SEGUNDOS TRANSCURRIDOS
        let limite = tiempoPermitido * 60; //TIEMPO PERMITIDO EN SEGUNDOS

        // Calculamos minutos y segundos transcurridos reales
        let minutos = Math.floor(transcurrido / 60);
        let segundos = transcurrido % 60;
        let tiempoFormateado = minutos + 'min:' + String(segundos).padStart(2, '0');

        // Estilos base comunes para no repetir código
        let estilosBase = {
            'color': 'white',
            'padding': '5px 12px',
            'border-radius': '10px'
        };

        if (transcurrido <= limite) {
            elemento.text('Transcurrido: ' + tiempoFormateado); // DENTRO DEL TIEMPO PERMITIDO (Cuenta hacia arriba)
            let restante = limite - transcurrido; // Determinar si faltan más o menos de 10 minutos para llegar al límite

            if (restante > 600) { // MÁS DE 10 MINUTOS RESTANTES
                elemento.css({ ...estilosBase, 'background': 'blue' });
            } else { // MENOS DE 10 MINUTOS RESTANTES
                elemento.css({ ...estilosBase, 'background': 'orange' });
            }
        } else {
            // SE PASÓ DEL TIEMPO PERMITIDO
            elemento.text('Excedido: ' + tiempoFormateado);
            elemento.css({ ...estilosBase, 'background': 'red' });
        }
    });
}
