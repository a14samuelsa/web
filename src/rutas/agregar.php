<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$app = new \Slim\App;

//Agregar un articulo
$app->post('/api/productos/agregar', function(Request $request, Response $response){
$id=$request->getParam('id');
$nombre=$request->getParam('nombre');
$nombre_corto=$request->getParam('nombre_corto');
$consulta = "INSERT INTO producto (id, nombre, nombre_corto) VALUES (:id,:nombre,:nombre_corto)";
	try{
		$db = new db();
		//conexion
		$db = $db->conectar();
		$ejecutar = $db->query($consulta);
		$ejecutar->bindParam(':id',$id);
		$ejecutar->bindParam(':nombre',$nombre);
		$ejecutar->bindParam(':nombre_corto',$nombre_corto);
		$ejecutar->execute();
		echo "Se ha insertado correctamente el articulo";
		//$producto = $ejecutar->fetchAll(PDO::FETCH_OBJ);
		$db=null;
		echo json_encode($producto);
	} catch (PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});
 ?>