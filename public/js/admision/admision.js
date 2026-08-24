//PARA INACTIVAR AL PACIENTE
$(document).on("click", ".llamar-paciente", async function (e) {
    e.preventDefault();

    let appointmentId = $(this).data("id");

    try {
        const res = await fetch(`${window.location.origin}/llamar-paciente`, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                id: appointmentId,
            }),
        }
        );

        const data = await res.json();
        console.log('Datos', data);

        if (data.code === 1) {
            Swal.fire({
                title: "¡Llamado!",
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
