<?php
    namespace app\controllers;
    use app\models\mainModel;

    class loginController extends mainModel{

        #iniciar sesion#
        public function iniciarSesionControlador(){

                $usuario=$this->limpiarCadena($_POST['login_usuario']);
                $clave=$this->limpiarCadena($_POST['login_clave']);

                
                if($usuario=="" || $clave==""){
                    echo"
                    <script>
	Swal.fire({
        icon: 'error',
        title: 'Ocurrio un error inesperado',
        text: 'No has llenado los datos para loguearte',
        confirmButtonText: 'aceptar'
      });
</script>
                    ";
                }else{
                    #integridad de los datos#
                    if($this->verificarDatos("[a-zA-Z0-9]{4,20}", $usuario)){
                      echo"
                    <script>
                         Swal.fire({
                        icon: 'error',
                        title: 'Ocurrio un error inesperado',
                        text: 'El usuario no coincide con el formato solicitado',
                        confirmButtonText: 'aceptar'
                        });
                    </script>
                           ";
                    }else{

                        if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $clave)){
                            echo"
                            <script>
                                 Swal.fire({
                                icon: 'error',
                                title: 'Ocurrio un error inesperado',
                                text: 'La clave no coincide con el formato solicitado',
                                confirmButtonText: 'aceptar'
                                });
                            </script>
                                   ";
                        }else{

                        }

                    }
                }
        }

    }