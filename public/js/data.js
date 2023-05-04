    function reservacrear(id){
        var datastring = $("#createReserva").serialize();
        $.ajax({
            type: "POST",
            url: "/reservas/create/"+id,
            data: datastring,
            dataType: "json",
            success: function(data) {
                if(data.error==true){
                    Swal.fire(
                        'Error!',
                        data.mensaje,
                        'error'
                    )
                }else{
                    Swal.fire(
                        'Reserva exitosa!',
                        data.mensaje,
                        'success'
                    )
                }
                //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
                // do what ever you want with the server response
            },
            error: function() {
              //  alert('error handling here');
            }
        });

    }

