<?php
session_start();
$resultado = '';

// Verificar si hay un resultado almacenado en la sesión
if (isset($_SESSION['resultado'])) {
    $resultado = $_SESSION['resultado'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Gestión de Productos</title>
</head>
<body>

    <h1 class="form-title">Formulario de Productos</h1>

    <form action="procesamiento.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ0-9\s]+" title="Solo se permiten letras y números"><br>
    
    <label for="modelo">Modelo:</label>
    <input type="text" id="modelo" name="modelo" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ0-9\s]+" title="Solo se permiten letras y números"><br>
    
    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" min="0" step="0.01"><br>
    
    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" min="0"><br>
    
    <input type="radio" id="agregar" name="accion" value="agregar">
    <label for="agregar">Agregar</label><br>
    
    <input type="radio" id="buscar" name="accion" value="buscar">
    <label for="buscar">Buscar por Nombre o Modelo</label><br>
    
    <input type="radio" id="mostrar" name="accion" value="mostrar">
    <label for="mostrar">Mostrar</label><br>
    
    <input type="radio" id="actualizar" name="accion" value="actualizar">
    <label for="actualizar">Actualizar</label><br>
    
    <input type="radio" id="calc_tot" name="accion" value="calc_tot">
    <label for="calc_tot">Calcular Valor Total</label><br>

    <input type="radio" id="filtrar" name="accion" value="filtrar">
    <label for="filtrar">Filtrar por Valor</label><br>

    <input type="radio" id="listar" name="accion" value="listar">
    <label for="listar">Listar por Valor</label><br>

    <input type="radio" id="promedio" name="accion" value="promedio">
    <label for="promedio">Calcular Valor Promedio</label><br>

    <input type="submit" value="Enviar">
</form>

    <form action="procesamiento.php" method="POST">
        <input type="hidden" name="accion" value="limpiar">
        <input type="submit" value="Limpiar Resultados">
    </form>


    <div id="resultados">
    <?php echo $resultado; ?>
    </div>

    
</body>
</html>
