<?php
session_start();

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
