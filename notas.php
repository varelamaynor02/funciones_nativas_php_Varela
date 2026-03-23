<?php
$notas = [85,62,91,73,88];

echo count($notas);

sort($notas);

array_push($notas,95,56,89);

$id = array_search(91,$notas);
if (in_array($id,$notas)) {
    echo "Nota 91 encontrado";
}
?>

/*Buscar funciones nativas de PHP, meterlas en un archivo .php y explicarlar con comentarios, poner titulos y explicar que hace cada funcion*/