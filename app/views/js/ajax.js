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
             
            }
          });
    });
});