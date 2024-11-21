<?php

function validarFormulario($datos) {
    foreach ($datos as $campo => $valor) {
        if (empty($valor)) {
            return false;
        }
    }
    return true;
}

// Recoger los datos del formulario
$empresa = $_POST['empresa'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$tipo_unidad = $_POST['tipo_unidad'];
$modalidad = $_POST['modalidad'];
$tipo_mercancia = $_POST['tipo_mercancia'];
$embalaje = $_POST['embalaje'];
$dimensiones = $_POST['dimensiones'];
$piezas = $_POST['piezas'];
$peso = $_POST['peso'];
$origen = $_POST['origen'];
$destino = $_POST['destino'];
$descripcion = $_POST['descripcion'];

$correoequipobamapesh = 'mgacarrera@gmail.com';

$telefonoRegex = "/^[0-9]{10}$/";
$numerosEnterosRegex = "/^[0-9]+$/";
$numerosFlotantesRegex = "/^[0-9]+(\.[0-9]+)?$/";

// Crear array de los datos del formulario
$datosFormulario = [
    'empresa' => $empresa,
    'nombre' => $nombre,
    'correo' => $correo,
    'telefono' => $telefono,
    'tipo_unidad' => $tipo_unidad,
    'modalidad' => $modalidad,
    'tipo_mercancia' => $tipo_mercancia,
    'embalaje' => $embalaje,
    'dimensiones' => $dimensiones,
    'piezas' => $piezas,
    'peso' => $peso,
    'origen' => $origen,
    'destino' => $destino,
    'descripcion' => $descripcion
];

// Eliminar espacios en blanco extra
$datosFormulario = array_map('trim', $datosFormulario);

if (validarFormulario($datosFormulario)) {
    // Validación del correo electrónico
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Validación del teléfono
        if (preg_match($telefonoRegex, $telefono)) {
            // Validación de no. de piezas / pallets
            if (preg_match($numerosEnterosRegex, $piezas)) {
                // Validación de peso neto en kg
                if (preg_match($numerosFlotantesRegex, $peso)) {

                    // Construcción del mensaje con los datos capturados
                    $message = "Estimado equipo,<br><br>";
                    $message .= "La empresa <strong>" . $empresa . "</strong> con contacto de <strong>" . $nombre . "</strong> ha enviado un formulario. A continuación, los detalles de la solicitud:<br><br>";
                    $message .= "<strong>Correo:</strong> " . $correo . "<br>";
                    $message .= "<strong>Teléfono:</strong> " . $telefono . "<br>";
                    $message .= "<strong>Tipo de Unidad:</strong> " . $tipo_unidad . "<br>";
                    $message .= "<strong>Modalidad:</strong> " . $modalidad . "<br>";
                    $message .= "<strong>Tipo de Mercancía:</strong> " . $tipo_mercancia . "<br>";
                    $message .= "<strong>Embalaje:</strong> " . $embalaje . "<br>";
                    $message .= "<strong>Dimensiones:</strong> " . $dimensiones . "<br>";
                    $message .= "<strong>Piezas:</strong> " . $piezas . "<br>";
                    $message .= "<strong>Peso:</strong> " . $peso . "<br>";
                    $message .= "<strong>Origen:</strong> " . $origen . "<br>";
                    $message .= "<strong>Destino:</strong> " . $destino . "<br>";
                    $message .= "<strong>Descripción:</strong> " . $descripcion . "<br><br>";

                    // Configuración de los encabezados del correo
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: <support@transport.com>' . "\r\n";

                    // Enviar el correo
                    if (mail($correoequipobamapesh, 'Mensaje desde formulario de contacto', $message, $headers)) {
                        echo '1#<p style="color:green;">Correo enviado exitosamente. En breve nos ponemos en contacto.</p>';
                    } else {
                        echo '2#<p style="color:red;">Por favor intente nuevamente.</p>';
                    }

                } else {
                    echo '2#<p style="color:red">Por favor ingrese un valor válido para el peso neto en kg (número entero o decimal).</p>';
                }

            } else {
                echo '2#<p style="color:red">Por favor ingrese un número válido para las piezas/pallets (solo números enteros).</p>';
            }
        } else {
            echo '2#<p style="color:red">Por favor ingrese un número de teléfono válido (10 dígitos numéricos).</p>';
        }

    } else {
        echo '2#<p style="color:red">Por favor proporcione un correo válido.</p>';
    }

} else {
    echo '2#<p style="color:red">Por favor proporcione todos los datos.</p>';
}
?>
