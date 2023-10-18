<?php

include("funciones.php");

echo registrar_persona("Diana", "Diana", "Diana@gmail.com", "20");


/*$nombres         = $_GET['nombres '];
$usuario         =$_GET['usuario '];
$email         = $_GET['email'];
$clave         =  $_GET['clave '];*/

$grabacion = 0;

//Buscaremos que el documento o la persona no esté registrada.
//Para saber más de este paso, vaya al achivo funciones.
if (encontrar_persona($usuario) == 0) {

    //Registra a la persona y avis al usuario.
    $grabacion = registrar_persona($nombres, $usuario, $email, $clave);


    if ($grabacion == 1) {

        //echo "El registro fue exitoso. Puedes ir a tu perfil.";
        header("location: secion_conn.php");
    } else {

        //Esto es texto javascript escrito desde PHP.
        echo "Error: vuelve a intentar registrarte. <a href='index.php'>Registro</a>";
        //header( "location: index.php" ); //Volvemos al inicio.
    }
} else {
    echo "El estudiante ya se encuentra registrado <a href='index.php'>Registro</a>";
}
