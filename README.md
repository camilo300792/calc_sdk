# fsheets-converter

Retorna el resultado de una formula de Google sheets.
Funciones soportadas IF|CEILING|MROUND|FLOOR y calculos básicos.
Actualmente está en una versión beta la cual esperamos hacer
mucho más grande y robusta con el tiempo y porque no con tu ayuda.

### Pre-requisitos 📋

PHP 7.*

### Instalación 🔧

Simplemente clona este repositorio.

```
git clone https://github.com/camilo300792/fsheets-converter.git
```

Ejemplo básico con un CEILING

```
include_once __DIR__ . '/../vendor/autoload.php';
use Calc\Calc;
$calc = new Calc();
echo $calc->calc('=CEILING(32 * 1000 - 240 / -45; 10000) - 100');
```

## Autores ✒️

* **Elias Camilo Martinez Salcedo** [camilo300792](https://github.com/camilo300792)

## Podemos mejorar
 
* Si te gusta este proyecto puedes descargarlo e incluso mejorarlo. 

---
⌨️ Con ❤️ por [camilo300792](https://github.com/camilo300792) 😊