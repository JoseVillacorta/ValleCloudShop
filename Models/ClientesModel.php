<?php
class ClientesModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    public function getregistroDirecto($nombre, $correo, $clave, $telefono, $dni, $edad, $token){
        $sql = "INSERT INTO cliente (nombre, correo, contrasenia, telefono, dni, edad, token) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $datos = array($nombre, $correo, $clave, $telefono, $dni, $edad, $token);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else{
            $res = 0;
        }

        return $res;
    }
    public function getToken($token){
        $sql = "SELECT * FROM  cliente WHERE token = '$token'";
        return $this->select($sql);
    }

    public function actualizarVerify($id){
        $sql = "UPDATE cliente SET token=?, verify=? WHERE id=?";
        $datos = array(null, 1, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = $data;
        } else{
            $res = 0;
        }
        return $res;
    }
    
    public function getVerificar($correo){
        $sql = "SELECT * FROM  cliente WHERE correo = '$correo'";
        return $this->select($sql);
    }

    public function registrarPedido($id_trasaccion, $estado, $monto, $fecha, $email,
                                    $nombre, $apellido, $direccion, $ciudad, $email_user){
        $sql = "INSERT INTO pedidos (id_trasaccion, estado, monto, fecha, email, nombre, 
                                    apellido, direccion, ciudad, email_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $datos = array($id_trasaccion, $estado, $monto, $fecha, $email,
        $nombre, $apellido, $direccion, $ciudad, $email_user);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else{
            $res = 0;
        }

        return $res;
    }
    public function getProducto($id_producto){
        $sql = "SELECT * FROM  productos WHERE id = $id_producto";
        return $this->select($sql);
    }

    public function registrarDetalle($producto, $precio, $cantidad, $id_pedido) {

        $sql = "INSERT INTO detalle_pedidos (producto, precio, cantidad, id_pedido)
                             VALUES (?, ?, ?, ?)";
        $datos = array($producto, $precio, $cantidad, $id_pedido);
        $data = $this->insertar($sql, $datos);
        if ($data > 0) {
            $res = $data;
        } else{
            $res = 0;
        }

        return $res;
        
    }
    public  function getPedidos($proceso){
        $sql = "SELECT * FROM  pedidos WHERE proceso = $proceso";
        return $this->selectAll($sql);
    }
    public  function verPedido($idPedido){
        $sql = "SELECT d.* FROM  pedidos p INNER JOIN detalle_pedidos d ON p.id = d.id_pedido WHERE p.id = $idPedido";
        return $this->selectAll($sql);
    }
}
 
?>