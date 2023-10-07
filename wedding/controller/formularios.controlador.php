<?php

class ControladorFormularios
{

    static public function ctrRegistro()
    {
        if (isset($_POST["registroNombre"])) {
            $tabla = "registros";

            $datos = array(
                "nombre" => $_POST["registroNombre"],
                "email" => $_POST["registroEmail"],
                "password" => $_POST["registroPassword"]
            );
            $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);

            return $respuesta;
        }
    }
    static public function ctrSeleccionarRegistros($item, $valor)
    {
        $tabla = "registros";
        $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
        return $respuesta;
    }

    public function ctrLogin()
    {
        if (isset($_POST["loginEmail"])) {
            $tabla = "registros";
            $item = "email";
            $valor = $_POST["loginEmail"];
            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
            if (is_array($respuesta) && $respuesta["email"] == $_POST["loginEmail"] && $respuesta["password"] == $_POST["loginPassword"]) {
                $_SESSION["validarIngreso"] = "ok";

                echo '
                        <script>

                            if(window.history.replaceState){
                            
                                window.history.replaceState(null, null, window.location.href);
                            }

                            window.location = "index.php?page=data";

                        </script>
                        ';
            } else {

                echo '
                        <script>

                        if(window.history.replaceState){
                            
                         window.history.replaceState(null, null, window.location.href);
                        }

                        </script>
                        ';

                echo '<div class="alert alert-danger">El Email o la contraseña no son correctos</div>';
            }
        }
    }

    static public function ctrActualizarRegistro()
    {
        if (isset($_POST['actualizarNombre'])) {
            if ($_POST['actualizarPassword'] != "") {
                $password = $_POST['actualizarPassword'];
            } else {
                $password = $_POST['passwordActual'];
            }

            $tabla = "registros";
            $datos = array(
                "id" => $_POST['idUsuario'],
                "nombre" => $_POST['actualizarNombre'],
                "email" => $_POST['actualizarEmail'],
                "password" => $password
            );
            $respuesta = ModeloFormularios::mdlActualizarRegistro($tabla, $datos);

            return $respuesta;
        }
    }
    public function ctrEliminarRegistro()
    {
        if (isset($_POST["eliminarRegistro"])) {
            $tabla = "registros";
            $valor = $_POST["eliminarRegistro"];
            $respuesta = ModeloFormularios::mdlEliminarRegistros($tabla, $valor);

            if ($respuesta == "ok") {
                echo '
                        <script>

                            if(window.history.replaceState){
                            
                                window.history.replaceState(null, null, window.location.href);
                            }

                            window.location = "index.php?page=data";

                        </script>
                        ';
            }

            return $respuesta;
        }
    }
}
