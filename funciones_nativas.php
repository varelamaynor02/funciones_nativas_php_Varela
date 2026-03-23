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

/*
ArrayIterator::getArrayCopy

ArrayIterator::getArrayCopy — Obtener copia de un array

Descripción
public ArrayIterator::getArrayCopy(): array
Obtiene una copia de un array.
*/
// 1. Definir un array
$frutas = array("a" => "manzana", "b" => "plátano", "c" => "limón");

// 2. Crear el ArrayIterator
$iterador = new ArrayIterator($frutas);

// 3. Obtener una copia del array
$copia = $iterador->getArrayCopy();

// Mostrar la copia
print_r($copia);

/*
Resultado:
Array
(
    [a] => manzana
    [b] => plátano
    [c] => limón
)
*/
/*
ArrayIterator::rewind
ArrayIterator::rewind — Rebobinar array al inicio

Descripción
public ArrayIterator::rewind(): void
Rebobina el iterador al inicio del array.

Parámetros: ninguno
Esta función no contiene ningún parámetro.*/

$frutas = ['Manzana', 'Banana', 'Cereza'];
$iterator = new ArrayIterator($frutas);

// 1. Recorrer la primera vez
echo "Primer recorrido:\n";
foreach ($iterator as $key => $value) {
    echo "$key: $value\n";
}

// 2. Rebobinar al inicio
$iterator->rewind();

// 3. Recorrer de nuevo
echo "\nSegundo recorrido (tras rewind):\n";
echo $iterator->current(); // Muestra 'Manzana' nuevamente


/*array_combine
array_combine — Crea un array a partir de dos otros arrays

Descripción
array_combine(array $keys, array $values): array
Crea un array, donde las claves son los valores de keys, y los valores son los valores de values.

Parámetros
keys
Array de claves a utilizar. Los valores ilegales para las claves serán convertidos en string.

values
Array de valores a utilizar

Valores devueltos
Devuelve el array combinado. Si keys y values no tienen el mismo número de elementos, devuelve false y emite un error de nivel E_WARNING.

Errores/Excepciones
A partir de PHP 8.0.0, lanza un error de tipo ValueError si el número de elementos de keys y de values no coinciden. Anteriormente, lanzaba una advertencia de nivel E_WARNING.
*/

$claves = array("nombre", "edad", "puesto");
$valores = array("Ana", 28, "Desarrolladora");

$resultado = array_combine($claves, $valores);

print_r($resultado);
/* 
Resultado:
Array (
    [nombre] => Ana
    [edad] => 28
    [puesto] => Desarrolladora
)
*/

/*
array_search
array_search — Busca en un array la primera clave asociada al valor
Descripción ¶
array_search(mixed $needle, array $haystack, bool $strict = false): int|string|false
*/
$frutas = ["a" => "manzana", "b" => "banana", "c" => "uva"];

// Buscar el valor "banana"
$clave = array_search("banana", $frutas);

echo $clave; // Salida: b

/*count
count — Cuenta todos los elementos de un array o en un objeto Countable

Descripción 
count(Countable|array $value, int $mode = COUNT_NORMAL): int
Cuenta todos los elementos en un array cuando se utiliza con un array. Cuando se utiliza con un objeto que implementa la interfaz Countable, esto devuelve el valor de la método Countable::count().

Parámetros 
value
Un array o un objeto Countable.

mode
Si el parámetro opcional mode vale COUNT_RECURSIVE (o 1), count() va contar recursivamente los arrays. Esto es particularmente útil para contar el número de elementos de un array.
*/
$a[0] = 1;
$a[1] = 3;
$a[2] = 5;
var_dump(count($a));

$b[0]  = 7;
$b[5]  = 9;
$b[10] = 11;
var_dump(count($b));

/*array_pop
(PHP 4, PHP 5, PHP 7, PHP 8)

array_pop — Desapila un elemento del final de un array

Descripción ¶
array_pop(array &$array): mixed
array_pop() desapila y devuelve el valor del último elemento del array array, acortándolo en un elemento.

Nota: Esta función reinicia el puntero al inicio del array de entrada (equivalente a reset()).

Parámetros ¶
array
El array del cual se recupera el valor.

Valores devueltos ¶
Devuelve el valor del último elemento del array array. Si array está vacío, null será devuelto.
*/
$stack = array("orange", "banana", "apple", "raspberry");
$fruit = array_pop($stack);
print_r($stack);
print_r($fruit);
//Despues de esto raspberry se ha eliminado del array $stack y se ha asignado a la variable $fruit. El resultado de print_r($stack) será Array ( [0] => orange [1] => banana [2] => apple ) y el resultado de print_r($fruit) será raspberry.
//=======================================================================================================================================================================================================================
/*array_push
array_push — Apila uno o más elementos al final de un array

Descripción
array_push(array &$array, mixed ...$values): int
array_push() considera array como una pila, y apila las variables values al final de array. La longitud del array array aumenta en consecuencia. Esto tiene el mismo efecto que:

Parámetros 
array
El array de entrada.

values
El valor a insertar al final del array array.

Valores devueltos
Devuelve el nuevo número de elementos en el array.
*/
//repetido para cada valor.
//Nota: Si se utiliza la función array_push() para añadir un elemento a un array, es preferible reemplazarla por el operador $array[] = que evita el paso por una función.
$stack = array("orange", "banana");
array_push($stack, "apple", "raspberry");
print_r($stack);

/*
sizeof
sizeof — Alias de count()

Descripción 
Esta función es un alias de: count().*/

$frutas = ["Manzana", "Plátano", "Naranja", "Uva"];

// Usar sizeof() para contar los elementos
$cantidad = sizeof($frutas);

echo "El array tiene " . $cantidad . " frutas."; 
// Salida: El array tiene 4 frutas.
//=======================================================================================================================================================================================================================

/*bcfloor
bcfloor — Redondea hacia abajo un número de precisión arbitraria

Descripción 
bcfloor(string $num): string
Devuelve el valor entero inferior siguiente redondeando num si es necesario.

Parámetros
num
El valor a redondear.

Valores devueltos
Devuelve una cadena numérica representando num redondeado hacia abajo al entero más cercano.

Errores/Excepciones
Esta función lanza una ValueError si num no es un string numérico BCMath bien formado.*/
echo floor(4.7);   // Salida: 4
echo floor(4.2);   // Salida: 4
echo floor(-2.1);  // Salida: -3 (redondea hacia abajo)
//=======================================================================================================================================================================================================================
/*bcadd
bcadd — Suma dos números de precisión arbitrária

Descripción 
bcadd(string $num1, string $num2, ?int $scale = null): string
Suma num1 y num2.

Parámetros 
num1
El operador izquierdo, como una cadena.

num2
El operador derecho, como una cadena

scale
Este parámetro se utiliza para establecer el número de dígitos después del punto decimal en el resultado. Si es null, se establecerá por defecto en la escala predeterminada establecida con bcscale(), o se utilizará el valor de la directiva INI bcmath.scale.

Valores devueltos
La suma de dos operandos, como una cadena.

Errores/Excepciones
Esta función lanza una excepción ValueError en los siguientes casos:
num1 o num2 no es una cadena numérica bien formada de BCMath.
scale está fuera del rango válido.*/
$a = '1.23456';
$b = '2.34567';

// 1. Suma sin especificar escala (redondea o trunca a enteros por defecto)
echo bcadd($a, $b); // Salida: 3

echo "\n";

// 2. Suma con escala (3 decimales)
echo bcadd($a, $b, 3); // Salida: 3.580
//=======================================================================================================================================================================================================================
