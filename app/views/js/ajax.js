const formularios_ajax=document.querySelectorAll(".FormularioAjax");

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit", function(e){
        e.preventDefault();
        Swal.fire({
            title: "Atencion",
            text: "Estas seguro de guardar los datos?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si",
            cancelButtonText: "No"
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

/*boton cerrar sesion*/
let btn_exit=document.getElementById("btn_exit");

btn_exit.addEventListener("click", function(e){

  e.preventDefault();

  Swal.fire({
    title: "Quieres salir?",
    text: "Se cerrara la sesion",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, salir",
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.isConfirmed) {

      let url=this.getAttribute("href");
      window.location.href=url;
    }
  });

});