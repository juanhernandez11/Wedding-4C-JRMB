<?php

class ControladorFormularios
{
    static public function ctrRegistro()
    {
        if (isset($_POST["registroNombre"])) {
            $tabla = "registros";

            $nombre = self::limpiarInput($_POST["registroNombre"]);
            $email = self::limpiarInput($_POST["registroEmail"]);
            $password = password_hash(self::limpiarInput($_POST["registroPassword"]), PASSWORD_BCRYPT);

            $datos = array(
                "nombre" => $nombre,
                "email" => $email,
                "password" => $password
            );

            $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);

            return $respuesta;
        }
    }

    static public function ctrSeleccionarRegistros($item, $valor)
    {
        $tabla = "registros";
        $valor = self::limpiarInput($valor);
        $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
        return $respuesta;
    }

    public function ctrLogin()
    {
        if (isset($_POST["loginEmail"])) {
            $tabla = "registros";
            $item = "email";
            $valor = self::limpiarInput($_POST["loginEmail"]);

            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

            if (is_array($respuesta) && password_verify(self::limpiarInput($_POST["loginPassword"]), $respuesta["password"])) {
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
            $password = "";
            if (!empty($_POST['actualizarPassword'])) {
                $password = password_hash(self::limpiarInput($_POST['actualizarPassword']), PASSWORD_BCRYPT);
            }

            $tabla = "registros";
            $datos = array(
                "id" => self::limpiarInput($_POST['idUsuario']),
                "nombre" => self::limpiarInput($_POST['actualizarNombre']),
                "email" => self::limpiarInput($_POST['actualizarEmail']),
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
            $valor = self::limpiarInput($_POST["eliminarRegistro"]);
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

    static public function limpiarInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
}
