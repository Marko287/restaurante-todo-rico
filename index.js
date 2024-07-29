window.onload = function(){
    const urlParams = new URLSearchParams(window.location.search);
    
    const msg = urlParams.get('msg');
    if(msg === 'error'){
        swal({
            title: 'Error',
            text: 'Algo salio mal',
            icon: 'error',
        });
    }
    if(msg === 'errorLogin'){
        swal({
            title: '¡Upss!',
            text: 'Usuario y o contraseña son erroneas',
            icon: 'error',
            timer: 2300,
        });
    }
    if(msg === 'success'){
        swal({
            title: 'Bienvenido!',
            text: 'Bienvenido al sistema',
            icon: 'success',
            timer: 2300,
        });
    }
    if(msg === 'exit'){
        swal({
            title: '¡Sessión cerrada!',
            text: 'Que tengas buen día, hasta luego!',
            icon: 'success',
            timer: 2300,
        });
    }
    if(msg === 'sinSesion'){
        swal({
            title: '¡Upss!',
            text: '¡No has iniciado sesión!',
            icon: 'warning',
            timer: 2300,
        });
    }
    if(msg === 'mesaOcupada'){
        swal({
            title: '¡Upss!',
            text: '¡Esta mesa ya esta siendo ocupada por alguien!',
            icon: 'warning',
            timer: 2300,
        });
    }
    if(msg === 'mesaReservada'){
        swal({
            title: '¡Genial!',
            text: '¡La mesa ha sido reservada correctamente!',
            icon: 'success',
            timer: 2300,
        });
    }
    if(msg === 'mesaReservadaActualizada'){
        swal({
            title: '¡Actualizado!',
            text: '¡Se actualizo los datos de la mesa!',
            icon: 'success',
            timer: 2300,
        });
    }
    if(msg === 'eliminarReserva'){
        swal({
            title: 'Eliminado!',
            text: '¡Se eliminado el registro correctamente!',
            icon: 'success',
            timer: 2300,
        });
    }
    if(msg === 'errorEliminarReserva'){
        swal({
            title: 'Eliminado!',
            text: '¡Algo salio mal al intentar eliminar la reserva!',
            icon: 'error',
            timer: 2300,
        });
    }
    if(msg === 'anulacionExito'){
        swal({
            title: 'Anulado!',
            text: '¡La reserva ha sido anulado correctamente!',
            icon: 'success',
            timer: 2300,
        });
    }
    if(msg === 'anulacionError'){
        swal({
            title: 'Anulado!',
            text: '¡No se pudo anular la reserva!',
            icon: 'error',
            timer: 2300,
        });
    }
    if(msg === 'errorMarcarFinalizado'){
        swal({
            title: 'Finalizado!',
            text: '¡No se pudo marcar como finalizado!',
            icon: 'error',
            timer: 2300,
        });
    }
    if(msg === 'marcarFinalizado'){
        swal({
            title: 'Finalizado!',
            text: '¡Se marco como finalizado!',
            icon: 'success',
            timer: 2300,
        });
    }
    urlParams.delete('msg');
    const newUrl = window.location.pathname + '?' + urlParams.toString();
    window.history.replaceState({}, '', newUrl);
    // console.log(newUrl);
}