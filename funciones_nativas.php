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


/*ArrayAccess::offsetExists — Comprobar si existe un índice

Descripción
public ArrayAccess::offsetExists(mixed $offset): bool
Comprueba si existe o no un índice.

Este método se ejecuta cuando se utilizan las funciones isset() o empty() sobre los objetos que implementan ArrayAccess.

Nota:
Cuando se utiliza empty(), ArrayAccess::offsetGet() será invocada para comprobar si está vacío solamente si ArrayAccess::offsetExists() devuelve true.

Parámetros: offset
El índice a comprobar.

Valores devueltos: Esta función retorna true en caso de éxito o false si ocurre un error.

Nota: El valor de retorno se debe convertir a bool si no devuelve un valor boleano.*/
class obj implements ArrayAccess {
    public function offsetSet($offset, $value): void {
        var_dump(__METHOD__);
    }
    public function offsetExists($var): bool {
        var_dump(__METHOD__);
        if ($var == "foobar") {
            return true;
        }
        return false;
    }
    public function offsetUnset($var): void {
        var_dump(__METHOD__);
    }
    #[\ReturnTypeWillChange]
    public function offsetGet($var) {
        var_dump(__METHOD__);
        return "value";
    }
}

$obj = new obj;

echo "Runs obj::offsetExists()\n";
var_dump(isset($obj["foobar"]));

echo "\nRuns obj::offsetExists() and obj::offsetGet()\n";
var_dump(empty($obj["foobar"]));

echo "\nRuns obj::offsetExists(), *not* obj:offsetGet() as there is nothing to get\n";
var_dump(empty($obj["foobaz"]));
echo "";
?>