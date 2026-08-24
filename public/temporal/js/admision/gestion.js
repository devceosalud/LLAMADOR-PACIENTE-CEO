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
