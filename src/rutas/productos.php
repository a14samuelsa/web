<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$app = new \Slim\App;
//obtener todos los productos
$app->get('/api/productos', function(Request $request, Response $response){
$consulta = 'SELECT * FROM producto';
    try{
        $db = new db();
        //conexion
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $productos = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        echo json_encode($productos);
    } catch (PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//Info de solo un articulo
$app->get('/api/productos/{cod}', function(Request $request, Response $response){
$cod=$request->getAttribute('cod');
$consulta = "SELECT * FROM producto where cod='$cod'";
    try{
        $db = new db();
        //conexion
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $producto = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        echo json_encode($producto);
    } catch (PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
?>
