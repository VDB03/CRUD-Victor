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

                if($email!=""){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $check_email=$this->ejecutarConsulta("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");

                        if($check_email->rowCount()>0){
                            $alerta=[
                                "tipo"=>"simple",
                                "titulo"=>"Ocurrio un error inesperado",
                                "texto"=>"El email ya se encuentra registrado.",
                                "icono"=>"error"
                            ];
                            return json_encode($alerta);
                            exit();
                        }
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

                if($clave1!=$clave1){
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"Las claves no coinciden.",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                    
                }else{
                    $clave=password_hash($clave1, PASSWORD_BCRYPT, ["cost"=>10]);
                }

                $check_usuario=$this->ejecutarConsulta("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
                if($check_usuario->rowCount()>0){
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"El usuario ya se encuentra registrado.",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }

                $img_dir="../views/photos/";


                if($_FILES['usuario_foto']['name']!="" && $_FILES ['usuario_foto']['size']>0){

                    if(!file_exists($img_dir)){
                        if(!mkdir($img_dir, 0777)){
                            $alerta=[
                                "tipo"=>"simple",
                                "titulo"=>"Ocurrio un error inesperado",
                                "texto"=>"Error al crear el directorio.",
                                "icono"=>"error"
                            ];
                            return json_encode($alerta);
                            exit();
                        }
                    }

                    if(mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/png"){
                        $alerta=[
                            "tipo"=>"simple",
                            "titulo"=>"Ocurrio un error inesperado",
                            "texto"=>"Formato no permitido.",
                            "icono"=>"error"
                        ];
                        return json_encode($alerta);
                        exit();
                    }

                    if(($_FILES['usuario_foto']['size']/1024)>5120){
                        $alerta=[
                            "tipo"=>"simple",
                            "titulo"=>"Ocurrio un error inesperado",
                            "texto"=>"La imagen que selecciono supera el peso permitido.",
                            "icono"=>"error"
                        ];
                        return json_encode($alerta);
                        exit();
                    }

                    $foto=str_ireplace(" ","_",$nombre);
                    $foto=$foto."_".rand(0,100);


                    switch(mime_content_type($_FILES['usuario_foto']['tmp_name'])){
                        case "image/jpeg":
                                $foto=$foto.".jpg";
                            break;
                        case "image/png":
                                $foto=$foto.".png";
                            break;
                    }

                    chmod($img_dir, 0777);

                    if (!move_uploaded_file($_FILES['usuario_foto']['tmp_name'], $img_dir.$foto)){
                        $alerta=[
                            "tipo"=>"simple",
                            "titulo"=>"Error al mover la imagen",
                            "texto"=>"No se pudo subir la imagen por el momento.",
                            "icono"=>"error"
                        ];
                        return json_encode($alerta);
                        exit();
                    }

                }else{
                    $foto="";
                }
        }
    }