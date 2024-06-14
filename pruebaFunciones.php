<?php

// Definir las funciones
function agregarProducto($productos, $nombre,$modelo, $precio, $cantidad) {
    $productos[] = [
        'nombre' => $nombre,
        'modelo' => $modelo,
        'precio' => $precio,
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
        $result .= "Nombre: " . $producto['nombre'] . ", Precio: $" . $producto['precio'] . ", Cantidad: " . $producto['cantidad'] . "<br>";
    }
    return $result;
}

function actualizarProducto($productos, $nombre,$modelo, $precio, $cantidad) {
    foreach ($productos as &$producto) {
        if ($producto['nombre'] == $nombre || $producto['modelo'] == $modelo) {
            $producto['precio'] = $precio;
            $producto['cantidad'] = $cantidad;
            break;
        }
    }
    return $productos;
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