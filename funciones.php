<?php

function registrar_persona($nombres, $usuario, $email, $clave)
{


    $salida = 0;

    $conexion = new mysqli('localhost', 'root', 'root', 'db_proyecto_ddm');
    $sql  = "insert into tb_usuarios( nombres, usuario, email, clave )";
    $sql .= "values( '$nombres', '$usuario', '$email','$clave' )";
    //echo $sql;

    try {

        $resultado = $conexion->query($sql);
    } catch (mysqli_sql_exception $e) {
        //var_dump( $e );
        //echo $e->getMessage(); //Imprimie el error.
    }

    //Se una fila ha sido afecta, agregada, marque...
    if ($conexion->affected_rows > 0) {

        $salida = 1; //éxito.

    } else {

        $salida = 0; //fracaso agregando fila.
    }

    $conexion->close(); //Cerramos la conexion.

    return $salida; //La función retorna.
}


function encontrar_persona($usuario){


$salida = 0;

$conexion = new mysqli('localhost', 'root', 'root', 'db_proyecto_ddm');
$sql = "select count(*)  from tb_usuarios where usuario = '$usuario'";
$resultado = $conexion->query( $sql );
//echo $sql;

//En caso de uno o varios resultados, todos los registros se recorrerán
//por medio de este ciclo while.
while( $fila = mysqli_fetch_assoc( $resultado ) ){

$salida = $fila['usuario'];
}

$conexion->close();

return $salida;
}



function consultar_personas($usu_buscado = null)
{


    $salida = ""; //Al retornar texto se inicializa con vacío.

    $conexion = new mysqli('localhost', 'root', 'root', 'db_proyecto_ddm');
    $sql  = "select * from tb_usuarios ";
    if ($usu_buscado != null) $sql .= " where usuario = '$usu_buscado' ";
    $resultado = $conexion->query($sql);
    //echo $sql;

    //Ojo, se usa el ciclo while pero con fetch assoc para llamar el nombre de los campos.
    while ($fila = mysqli_fetch_assoc($resultado)) {

        $usu = $fila['usuario'];

        if (
            $usu_buscado == null
        ) {

            $salida .= $usu . " <a href='consulta_indi.php?usu=$usu'>" . $fila['nombres'] . "</a>";
        } else {

            $salida .= "<h1>" . $fila['nombres'] . "</h1>";
            $salida .= "<hr>";
            $salida .= $fila['usuario'] . " " . $fila['email'] . " " . $fila['clave'];
        }

        $salida .= "<br>";
    }

    $conexion->close();

    return $salida;
}


function consultar_compras()
{


    $salida = ""; //Al retornar texto se inicializa con vacío.
  
    $conexion = new mysqli('localhost', 'root', 'root', 'db_proyecto_ddm');
    $sql  = "select * from tb_productos, tb_comprar where tb_productos.producto_id = tb_comprar.producto_id ";
    $resultado = $conexion->query($sql);

    while ($fila = mysqli_fetch_assoc($resultado)) {

        //$usu = $fila['producto_nombre'];
        $salida .= "<h1>" . $fila['producto_nombre'] . "</h1>";
        $salida .= "<hr>";
        $salida .= $fila['producto_precio'] . " " . $fila['producto_descri'] . " " . $fila['categoria_producto'] . " " . $fila['factura_id'] . " " . $fila['envio'] . " " . $fila['sistema_pago'];

        $salida .= "<br>";
    }

   

    return $salida;
    $conexion->close();
}
?>