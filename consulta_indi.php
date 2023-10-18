<?php

include("funciones.php");

$usuario = $_GET['usu'];

?>

<html>

<head>
    <title>Consulta individual.</title>
</head>

<body>

    <?php

    echo consultar_personas($usuario);

    ?>
    <a href="carrito.php">Mis compras</a>

</body>

</html>