<?php
session_start();

// Definir las funciones
function agregarProducto($productos, $nombre,$modelo, $precio, $cantidad) {
    $productos[] = [
        'nombre' => $nombre,
        'modelo' => $modelo,
       'precio' => (float)$precio,
        'cantidad' => $cantidad
    ];
    return $productos;
}
function buscarProductoPorNombreModelo($productos, $nombre,$modelo) {
    foreach ($productos as $producto) {
        if ($producto['nombre'] == $nombre || $producto['modelo'] == $modelo) {
            return "Precio: $" . $producto['precio'] . ", Cantidad: " . $producto['cantidad'] . "<br>";
        }
    }
    return "Producto no encontrado.<br>";
}
function mostrarProductos($productos) {
    $result = '';
    foreach ($productos as $producto) {
        $result .= "Nombre: " . $producto['nombre'] . ", Modelo:" . $producto['modelo'] . ", Precio: $" . $producto['precio'] . ", Cantidad: " . $producto['cantidad'] . "<br>";
    }
    return $result;
}

function actualizarProducto($productos, $nombre, $modelo, $precio, $cantidad) {
    foreach ($productos as &$producto) {
        if ($producto['nombre'] == $nombre || $producto['modelo'] == $modelo) {
            $producto['precio'] = $precio;
            $producto['cantidad'] = $cantidad;
            break;
        }
    }
    return $productos;
}
//Calculo el valor tottal de toda la mercaderia
function calculoTotal($productos){
    $sumatotal=0;
    foreach ($productos as $producto){
    $valorMercaderia = (float)$producto['precio'] * (int)$producto['cantidad'];
    $sumatotal= $sumatotal + $valorMercaderia;
    
    }
    return  $sumatotal;
    
    
    }
    function filtrarPorValor($productos, $precio) {
        $result = '';
        foreach ($productos as $producto) {
            $valorPrecio=(float)$producto['precio'];
            if ($valorPrecio >= (float)$precio){
            $result .= "Nombre: " . $producto['nombre'] . ", Modelo:" . $producto['modelo'] . ", Precio: $" . $producto['precio'] . ", Cantidad: " . $producto['cantidad'] . "<br>";
            }    
        }
        return $result;
    }
    function calculoPromedio($productos){
        $sumatotalpromedio=calculoTotal($productos);
       
        $promedio=0;
        $unidades=0;
        foreach ($productos as $producto){
       
        $unidades= $unidades + (int)$producto['cantidad'];
           
        }
        $promedio = (float)$sumatotalpromedio/$unidades;
        
        return "El valor Promedio es:". $promedio;
        
        
        }
    

// Inicializar el array de productos en la sesión
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

$productos = $_SESSION['productos'];
$resultado = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    $nombre = $_POST['nombre'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';
    $total = $_POST['calc_tot'] ?? '';


    switch ($accion) {
        case 'agregar':
            $productos = agregarProducto($productos, $nombre,$modelo, $precio, $cantidad);
            $resultado = "Producto agregado correctamente.<br>";
            break;
        
        case 'buscar':
            $resultado = buscarProductoPorNombre($productos, $nombre);
            break;
        
        case 'mostrar':
            $resultado = mostrarProductos($productos);
            break;
        
        case 'actualizar':
            $productos = actualizarProducto($productos, $nombre, $precio, $cantidad);
            $resultado = "Producto actualizado correctamente.<br>";
            break;

        case 'calc_tot':
                $resultado = "El Calculo total es:" .calculoTotal($productos);
            break;   ;   
   
        case 'filtrar':
             $resultado = filtrarPorValor($productos,$precio);
             break;  
        case 'promedio':
                $resultado = calculoPromedio($productos);
             break;  
        
        case 'limpiar':
            $_SESSION['productos'] = [];
            $resultado = "Resultados limpiados correctamente.<br>";
            session_destroy();
            break;

        default:
            $resultado = "Acción no válida.";
    }

    $_SESSION['productos'] = $productos;
    $_SESSION['resultado'] = $resultado;
}


?>