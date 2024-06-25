<?php

if(!$_POST) exit;

// Función para validar formato de correo electrónico
function isEmail($email) {
    return preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|...|zw)$/i", $email);
}

// Captura de datos del formulario
$form_name = $_POST['form_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$no_of_persons = $_POST['no_of_persons'];
$date_picker = $_POST['date-picker'];
$time_picker = $_POST['time-picker'];
$preferred_food = $_POST['preferred_food'];
$occasion = $_POST['occasion'];

// Validación de campos obligatorios
if(trim($form_name) == '') {
    echo '<div class="error_message">Atención! Debes ingresar tu nombre.</div>';
    exit();
} elseif(trim($email) == '') {
    echo '<div class="error_message">Atención! Por favor ingresa una dirección de correo electrónico válida.</div>';
    exit();
} elseif(!isEmail($email)) {
    echo '<div class="error_message">Atención! Has ingresado una dirección de correo electrónico inválida, inténtalo de nuevo.</div>';
    exit();
} elseif(trim($date_picker) == '') {
    echo '<div class="error_message">Atención! Por favor ingresa la fecha.</div>';
    exit();
} elseif(trim($time_picker) == '') {
    echo '<div class="error_message">Atención! Por favor ingresa la hora.</div>';
    exit();
}

// Configuración del correo electrónico
$address = "gimr.carlosayonhdez@gmail.com"; // Dirección de correo a la que se enviará el formulario

$e_subject = 'Has sido contactado por ' . $form_name . '.';

$e_body = "Has sido contactado por $form_name. Detalles de la reserva:" . PHP_EOL . PHP_EOL;
$e_content = "Correo electrónico: $email" . PHP_EOL;
$e_content .= "Teléfono: $phone" . PHP_EOL;
$e_content .= "Número de personas: $no_of_persons" . PHP_EOL;
$e_content .= "Fecha: $date_picker" . PHP_EOL;
$e_content .= "Hora: $time_picker" . PHP_EOL;
$e_content .= "Preferencia de comida: $preferred_food" . PHP_EOL;
$e_content .= "Tipo de evento: $occasion" . PHP_EOL . PHP_EOL;
$e_reply = "Puedes contactar a $form_name por correo electrónico, $email, o por teléfono $phone";

$msg = wordwrap($e_body . $e_content . $e_reply, 70);

$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

// Envío del correo electrónico
if(mail($address, $e_subject, $msg, $headers)) {
    // Éxito al enviar el correo electrónico
    echo "<fieldset>";
    echo "<div id='success_page'>";
    echo "<h1>Correo enviado exitosamente.</h1>";
    echo "<p>Gracias <strong>$form_name</strong>, tu mensaje ha sido enviado correctamente.</p>";
    echo "</div>";
    echo "</fieldset>";
} else {
    // Error al enviar el correo electrónico
    echo 'ERROR!';
}
?>
