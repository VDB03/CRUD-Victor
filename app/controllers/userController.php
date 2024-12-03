<?php
    namespace app\controllers;
    use app\models\mainModel;

    class userController extends mainModel{
     
        public function registrarUsuarioControlador(){

                
                $nombre=$this->limpiarCadena($_POST['usuario_nombre']);
                $apellido=$this->limpiarCadena($_POST['usuario_apellido']);
                $usuario=$this->limpiarCadena($_POST['usuario_usuario']);
                $email=$this->limpiarCadena($_POST['usuario_email']);
                $clave1=$this->limpiarCadena($_POST['usuario_clave_1']);
                $clave2=$this->limpiarCadena($_POST['usuario_clave_2']);

                if($nombre==" " || $apellido=="" || $usuario=="" || $clave1=="" || $clave2==""){
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"no llenaste todos los campos, son obligatorios",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }

                if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $nombre)){

                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"El nombre no coincide con el formato solicitado",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();

                }
                if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $apellido)){

                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"El apellido no coincide con el formato solicitado",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();

                }
                if($this->verificarDatos("[a-zA-Z0-9]{4,20}", $usuario)){

                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"El usuario no coincide con el formato solicitado",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();

                }
                if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $clave1) || $this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $clave2)){
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"las claves no coincide con el formato solicitado",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }
<<<<<<< HEAD

                if($email!=""){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                    }else{
                        $alerta=[
                            "tipo"=>"simple",
                            "titulo"=>"Ocurrio un error inesperado",
                            "texto"=>"Ha ingresado un email no valido",
                            "icono"=>"error"
                        ];
                        return json_encode($alerta);
                        exit();
                    }
                }
=======
>>>>>>> 9bc6650e209a9c4a11e9c7e79d9bfb26bf28d545
                
                
        }
    }