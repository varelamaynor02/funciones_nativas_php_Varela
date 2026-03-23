<?php
//Funciones nativas de PHP

/*Array: Es una estructura de datos que puede almacenar múltiples valores en una sola variable.
(PHP 4, PHP 5, PHP 7, PHP 8)

array — Crea un array

Descripción
array(mixed ...$values): array

Parametros
values: La sintaxis "índice => valor", separada por comas, define los índices y sus valores. Un índice puede ser una cadena o un número. Si el índice se omite, se generará automáticamente un índice numérico (comenzando en 0). Si el índice es un entero, el siguiente índice generado tomará el valor del índice más grande + 1. 
Tenga en cuenta que si se definen dos índices idénticos, el último sobrescribirá al primero.
Tener una coma después de definir la última entrada, aunque innecesario, es una sintaxis válida.
*/
$fruits = array ("fruits"  => array("a" => "orange", "b" => "banana", "c" => "apple"),
    "numbers" => array(1, 2, 3, 4, 5, 6), "holes"   => array("first", 5 => "second", "third"));
print_r($fruits);
?>