<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once '../bd/conexion.php';

class Usuario {

    private $conexion;

    public function __construct() {
        $objeto = new Conexion();
        $this->conexion = $objeto->Conectar();
    }

    public function crearUsuario($nombre, $username, $nonomina, $centro_costo, $correo, $estatus, $centrotrabajo, $rol) {
        $consulta = "INSERT INTO tb_usuarios (nombre, usuario, nonomina, centro_costo, correo, estatus, fk_centros_trabajo, rol)
                     VALUES(:nombre, :usuario, :nonomina, :centro_costo, :correo, :estatus, :fk_centros_trabajo, :rol)";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->bindParam(':nombre', $nombre);
        $resultado->bindParam(':usuario', $username);
        $resultado->bindParam(':nonomina', $nonomina);
        $resultado->bindParam(':centro_costo', $centro_costo);
        $resultado->bindParam(':correo', $correo);
        $resultado->bindParam(':estatus', $estatus);
        $resultado->bindParam(':fk_centros_trabajo', $centrotrabajo);
        $resultado->bindParam(':rol', $rol);
        $resultado->execute();

        $consulta = "SELECT * FROM tb_usuarios ORDER BY pk_id DESC LIMIT 1";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($pk_id, $nombre, $username, $nonomina, $centro_costo, $correo, $estatus, $centrotrabajo, $rol) {
        $consulta = "UPDATE tb_usuarios SET nombre = :nombre, usuario = :usuario, nonomina = :nonomina, centro_costo = :centro_costo, correo = :correo, estatus = :estatus, fk_centros_trabajo = :fk_centros_trabajo, rol = :rol
                     WHERE pk_id = :pk_id";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->bindParam(':pk_id', $pk_id);
        $resultado->bindParam(':nombre', $nombre);
        $resultado->bindParam(':usuario', $username);
        $resultado->bindParam(':nonomina', $nonomina);
        $resultado->bindParam(':centro_costo', $centro_costo);
        $resultado->bindParam(':correo', $correo);
        $resultado->bindParam(':estatus', $estatus);
        $resultado->bindParam(':fk_centros_trabajo', $centrotrabajo);
        $resultado->bindParam(':rol', $rol);
        $resultado->execute();

        $consulta = "SELECT * FROM tb_usuarios WHERE pk_id = :pk_id";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->bindParam(':pk_id', $pk_id);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarUsuario($pk_id) {
        $consulta = "DELETE FROM tb_usuarios WHERE pk_id = :pk_id";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->bindParam(':pk_id', $pk_id);
        $resultado->execute();
    }

    public function obtenerUsuarios() {
        $consulta = "SELECT * FROM tb_usuarios";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function manejarSolicitud($opcion, $data) {
        switch($opcion) {
            case 1:
                return $this->crearUsuario($data['nombre'], $data['username'], $data['nonomina'], $data['centrocostos'], $data['correo'], $data['estatus'], $data['centrotrabajo'], $data['rol']);
            case 2:
                return $this->actualizarUsuario($data['pk_id'], $data['nombre'], $data['username'], $data['nonomina'], $data['centrocostos'], $data['correo'], $data['estatus'], $data['centrotrabajo'], $data['rol']);
            case 3:
                $this->eliminarUsuario($data['pk_id']);
                return array("success" => "Usuario eliminado");
            case 4:
                return $this->obtenerUsuarios();
            default:
                return array("error" => "Opción no válida");
        }
    }
}

// Datos recibidos por POST
$data = array(
    "nombre" => (isset($_POST['nombre'])) ? $_POST['nombre'] : '',
    "username" => (isset($_POST['username'])) ? $_POST['username'] : '',
    "nonomina" => (isset($_POST['nonomina'])) ? $_POST['nonomina'] : '',
    "centrocostos" => (isset($_POST['centrocostos'])) ? $_POST['centrocostos'] : '',
    "correo" => (isset($_POST['correo'])) ? $_POST['correo'] : '',
    "estatus" => (isset($_POST['estatus'])) ? $_POST['estatus'] : '',
    "centrotrabajo" => (isset($_POST['centrotrabajo'])) ? $_POST['centrotrabajo'] : '',
    "rol" => (isset($_POST['rol'])) ? $_POST['rol'] : '',
    "opcion" => (isset($_POST['opcion'])) ? $_POST['opcion'] : '',
    "pk_id" => (isset($_POST['pk_id'])) ? $_POST['pk_id'] : ''
);

// Instanciar la clase Usuario y manejar la solicitud
$usuario = new Usuario();
$resultado = $usuario->manejarSolicitud($data['opcion'], $data);

print json_encode($resultado, JSON_UNESCAPED_UNICODE); // Envío del array final en formato JSON a AJAX
?>