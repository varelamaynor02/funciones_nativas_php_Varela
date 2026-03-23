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
$fruits = array(
    "fruits"  => array("a" => "orange", "b" => "banana", "c" => "apple"),
    "numbers" => array(1, 2, 3, 4, 5, 6),
    "holes"   => array("first", 5 => "second", "third")
);
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
class obj implements ArrayAccess
{
    public function offsetSet($offset, $value): void
    {
        var_dump(__METHOD__);
    }
    public function offsetExists($var): bool
    {
        var_dump(__METHOD__);
        if ($var == "foobar") {
            return true;
        }
        return false;
    }
    public function offsetUnset($var): void
    {
        var_dump(__METHOD__);
    }
    #[\ReturnTypeWillChange]
    public function offsetGet($var)
    {
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

/*ArrayIterator::asort

ArrayIterator::asort — Ordena las entradas por los valores

Descripción 
public ArrayIterator::asort(int $flags = SORT_REGULAR): true
Ordena las entradas por los valores.

Nota:

Si dos miembros se comparan como iguales, mantienen su orden original. Anterior a PHP 8.0.0, su orden relativo en el array ordenado no está definido.

Parámetros 
flags
El segundo parámetro opcional flags puede ser utilizado para modificar el comportamiento de ordenación utilizando estos valores:

Tipo de banderas de ordenación:

SORT_REGULAR - compara los elementos normalmente; los detalles son descritos en la sección de los operadores de comparación
SORT_NUMERIC - compara los elementos numéricamente
SORT_STRING - compara los elementos como strings
SORT_LOCALE_STRING - compara los elementos como strings, basado en la configuración regional actual. Esto utiliza la configuración regional, que puede ser cambiada utilizando setlocale()
SORT_NATURAL - compara los elementos como strings utilizando el "orden natural" como natsort()
SORT_FLAG_CASE - puede ser combinado (OR a nivel de bits) con SORT_STRING o SORT_NATURAL para ordenar strings sin tener en cuenta la mayúscula/minúscula
Valores devueltos: Retorna siempre true. */

// 1. Definir el array asociativo
$data = [
    'c' => 'Manzana',
    'a' => 'Banana',
    'b' => 'Cereza'
];

// 2. Crear el objeto ArrayIterator
$iterator = new ArrayIterator($data);

// 3. Ordenar por valor usando asort()
$iterator->asort();

// 4. Mostrar el resultado
foreach ($iterator as $key => $value) {
    echo "$key : $value\n";
}
// Resultado:
// a : Banana
// b : Cereza
// c : Manzana


/*ArrayIterator::count

ArrayIterator::count — Cuenta elementos

Descripción
public ArrayIterator::count(): int
Obtiene el número de elementos de un array, o el número de propiedades públicas en un objeto.
*/

// 1. Crear un array de datos
$frutas = ["Manzana", "Banana", "Cereza", "Naranja"];

// 2. Instanciar el ArrayIterator
$iterator = new ArrayIterator($frutas);

// 3. Usar el método count() del iterador
echo "Total de frutas: " . $iterator->count(); 
// Salida: Total de frutas: 4

// También se puede usar dentro de un bucle para verificar el tamaño
if ($iterator->count() > 0) {
    echo "\nEl iterador tiene elementos.";
}
?>