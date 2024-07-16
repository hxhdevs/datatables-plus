<?php
include_once '../bd/conexion.php';

class Usuario {

    private $conexion;

    public function __construct() {
        $objeto = new Conexion();
        $this->conexion = $objeto->Conectar();
    }

    public function crearUsuario($username, $first_name, $last_name, $gender, $password, $status) {
        $consulta = "INSERT INTO tb_usuarios (username, first_name, last_name, gender, password, status)
                     VALUES('$username', '$first_name', '$last_name', '$gender', '$password', '$status')";			
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM tb_usuarios ORDER BY user_id DESC LIMIT 1";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);       
    }

    public function actualizarUsuario($user_id, $username, $first_name, $last_name, $gender, $password, $status) {
        $consulta = "UPDATE tb_usuarios SET username='$username', first_name='$first_name', last_name='$last_name', gender='$gender', password='$password', status='$status'
                     WHERE user_id='$user_id'";		
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM tb_usuarios WHERE user_id='$user_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarUsuario($user_id) {
        $consulta = "DELETE FROM tb_usuarios WHERE user_id='$user_id'";
        $resultado = $this->conexion->prepare($consulta);
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
                return $this->crearUsuario($data['username'], $data['first_name'], $data['last_name'], $data['gender'], $data['password'], $data['status']);
            case 2:
                return $this->actualizarUsuario($data['user_id'], $data['username'], $data['first_name'], $data['last_name'], $data['gender'], $data['password'], $data['status']);
            case 3:
                $this->eliminarUsuario($data['user_id']);
                return array("success" => "Usuario eliminado");
            case 4:
                return $this->obtenerUsuarios();
            default:
                return array("error" => "Opción no válida");
        }
    }
}

// Datos recibidos por POST
$username = (isset($_POST['username'])) ? $_POST['username'] : '';
$first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : '';
$last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
$gender = (isset($_POST['gender'])) ? $_POST['gender'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$status = (isset($_POST['status'])) ? $_POST['status'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';

// Instanciar la clase Usuario y manejar la solicitud
$usuario = new Usuario();
$data = array(
    "username" => $username,
    "first_name" => $first_name,
    "last_name" => $last_name,
    "gender" => $gender,
    "password" => $password,
    "status" => $status,
    "opcion" => $opcion,
    "user_id" => $user_id
);

$resultado = $usuario->manejarSolicitud($opcion, $data);

print json_encode($resultado, JSON_UNESCAPED_UNICODE); // Envío del array final en formato JSON a AJAX
?>
