<?php
require 'db.php';

$editarId = $_GET['editarId'] ?? null;

$resultado = mysqli_query($conexion, "SELECT * FROM reservas ORDER BY fecha, hora");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Reservas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center bg-blue-100 text-gray-800">
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold text-center mb-8">Gestión de Reservas del Restaurante</h1>

    <h2 class="text-2xl font-bold my-4">Hacer una reserva</h2>
    <form action="agregar.php" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8 max-w-md">
        <input type="hidden" name="idAntiguo" value="">

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
            <input type="text" name="nombre_cliente" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Teléfono:</label>
            <input type="text" name="telefono" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4 flex gap-4">
            <div class="flex-1">
                <label class="block text-gray-700 text-sm font-bold mb-2">Fecha:</label>
                <input type="date" name="fecha" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex-1">
                <label class="block text-gray-700 text-sm font-bold mb-2">Hora:</label>
                <input type="time" name="hora" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nº Personas:</label>
            <input type="number" name="num_personas" min="1" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Notas:</label>
            <input type="text" name="notas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex gap-2">
            <button type="submit" name="accion" value="alta" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Dar de alta</button>
        </div>
    </form>

    <!-- Listado de reservas -->
    <h2 class="text-2xl font-bold my-4">Listado de reservas</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Cliente</th>
                    <th class="py-2 px-4 border-b">Teléfono</th>
                    <th class="py-2 px-4 border-b">Fecha</th>
                    <th class="py-2 px-4 border-b">Hora</th>
                    <th class="py-2 px-4 border-b">Personas</th>
                    <th class="py-2 px-4 border-b">Notas</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado)) { 

                    $fecha = date("d-m-Y", strtotime($fila["fecha"]))?>

                    <?php if ($editarId == $fila['id']) { ?>
                        <tr class="bg-yellow-50">
                            <form action="modificar.php" method="post">
                                <td class="py-2 px-4 border-b"><?php echo $fila["id"]; ?></td>
                                <td class="py-2 px-4 border-b"><input type="text" name="nombre_cliente" autofocus value="<?php echo $fila["nombre_cliente"]; ?>" class="border rounded w-full px-2"></td>
                                <td class="py-2 px-4 border-b"><input type="text" name="telefono" value="<?php echo $fila["telefono"]; ?>" class="border rounded w-full px-2"></td>
                                <td class="py-2 px-4 border-b"><input type="date" name="fecha" value="<?php echo $fila["fecha"]; ?>" class="border rounded w-full px-2"></td>
                                <td class="py-2 px-4 border-b"><input type="time" name="hora" value="<?php echo $fila["hora"]; ?>" class="border rounded w-full px-2"></td>
                                <td class="py-2 px-4 border-b"><input type="number" name="num_personas" value="<?php echo $fila["num_personas"]; ?>" class="border rounded w-full px-2"></td>
                                <td class="py-2 px-4 border-b"><input type="text" name="notas" value="<?php echo $fila["notas"]; ?>" class="border rounded w-full px-2"></td>
                                <td class="py-2 px-4 border-b flex gap-2">
                                    <input type="hidden" name="idAntiguo" value="<?php echo $fila['id']; ?>">
                                    <button type="submit" name="accion" value="modificar" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded">Guardar</button>
                                    <a href="index.php" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-1 px-3 rounded">Cancelar</a>
                                </td>
                            </form>
                        </tr>
                    <?php } else { ?>
                        
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b"><?php echo $fila["id"]; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $fila["nombre_cliente"]; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $fila["telefono"]; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $fecha; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $fila["hora"]; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $fila["num_personas"]; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $fila["notas"]; ?></td>
                            <td class="py-2 px-4 border-b flex gap-2">
                                <form action="borrar.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">
                                    <button type="submit" name="accion" value="baja" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded" <?php echo $editarId ? "disabled" : ""; ?> onclick="return confirm('¿Seguro que quieres borrar esta reserva?')">Borrar</button>
                                </form>
                                <a href="?editarId=<?php echo $fila['id']; ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded <?php echo $editarId ? "opacity-50 pointer-events-none" : ""; ?>">Modificar</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
