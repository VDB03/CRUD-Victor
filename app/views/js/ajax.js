const formularios_ajax=document.querySelectorAll(".FormularioAjax");

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit", function(e){
        e.preventDefault();
        Swal.fire({
            title: "Estas seguro?",
            text: "No podras volver atras!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Borralo!",
            cancelButtonText: "No, cancelalo!"
          }).then((result) => {
            if (result.isConfirmed) {
             
              let data = new FormData(this);
              let method = this.getAttribute("method");
              let action = this.getAttribute("action");

              let encabezados = new Headers();

              let config={
                method: method,
                headers: encabezados,
                mode: 'cors',
                cache: 'no-cache',
                body: data
              };

              fetch(action, config)
              .then(respuesta => respuesta.json())
              .then(respuesta => {
                return alertas_ajax(respuesta);
              });

            }
          });
    });
});


function alertas_ajax(alerta){

    if(alerta.tipo=="simple"){
      
      Swal.fire({
        icon: alerta.icono,
        title: alerta.titulo,
        text: alerta.texto,
        confirmButtonText: 'aceptar'
      });

    }else if(alerta.tipo=="recargar"){

      Swal.fire({
        icon: alerta.icono,
        title: alerta.titulo,
        text: alerta.texto,
        confirmButtonText: 'aceptar'
      }).then((result) => {
        if (result.isConfirmed) {
            location.reload();
        }
      });

    }else if(alerta.tipo=="limpiar"){

      Swal.fire({
        icon: alerta.icono,
        title: alerta.titulo,
        text: alerta.texto,
        confirmButtonText: 'aceptar'
      }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector(".FormularioAjax")
            .reset()
        }
      });
      
    }else if(alerta.tipo=="redireccionar"){

      window.location.href=alerta.url;

    }

}