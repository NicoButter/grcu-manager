<?php
require_once 'config/db.php';

// Configuración de email
$smtp_host = "c2621905.ferozo.com";
$smtp_port = 465;
$smtp_user = "4bytes@equis.com.ar";
$smtp_pass = "GRcu2025*";

if ($_POST) {
    $docente_nombre = mysqli_real_escape_string($conn, $_POST['docente_nombre']);
    $docente_email = mysqli_real_escape_string($conn, $_POST['docente_email']);
    $requerimientos_adicionales = mysqli_real_escape_string($conn, $_POST['requerimientos_adicionales']);
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
    // Obtener todos los requerimientos
    $query = "SELECT * FROM requerimientos ORDER BY numero";
    $result = mysqli_query($conn, $query);
    
    $validaciones = [];
    $resumen_html = "";
    $resumen_texto = "";
    
    // Procesar cada requerimiento
    while ($req = mysqli_fetch_assoc($result)) {
        $req_field = "req_" . $req['id'];
        $comment_field = "comentario_" . $req['id'];
        
        if (isset($_POST[$req_field])) {
            $validacion = mysqli_real_escape_string($conn, $_POST[$req_field]);
            $comentario = isset($_POST[$comment_field]) ? mysqli_real_escape_string($conn, $_POST[$comment_field]) : '';
            
            // Guardar en BD
            $insert_query = "INSERT INTO validaciones (docente_nombre, docente_email, requerimiento_id, requerimiento_titulo, validacion, comentario, ip_address, user_agent) 
                           VALUES ('$docente_nombre', '$docente_email', {$req['id']}, '{$req['titulo']}', '$validacion', '$comentario', '$ip_address', '$user_agent')";
            
            mysqli_query($conn, $insert_query);
            
            // Preparar para email
            $validaciones[] = [
                'numero' => $req['numero'],
                'titulo' => $req['titulo'],
                'validacion' => $validacion,
                'comentario' => $comentario
            ];
            
            // Agregar a resumen
            $emoji = getEmojiForValidation($validacion);
            $resumen_html .= "
            <tr>
                <td style='padding: 10px; border-bottom: 1px solid #eee;'><strong>{$req['numero']}.</strong> {$req['titulo']}</td>
                <td style='padding: 10px; border-bottom: 1px solid #eee; text-align: center;'>$emoji $validacion</td>
                <td style='padding: 10px; border-bottom: 1px solid #eee;'>" . ($comentario ?: '-') . "</td>
            </tr>";
            
            $resumen_texto .= "{$req['numero']}. {$req['titulo']}: $validacion\n";
            if ($comentario) $resumen_texto .= "   Comentario: $comentario\n";
            $resumen_texto .= "\n";
        }
    }
    
    // Preparar emails
    $fecha = date('d/m/Y H:i');
    
    // Email para el docente
    $subject_docente = "Confirmación de Validación - GRCU Manager";
    $message_docente = generarEmailDocente($docente_nombre, $resumen_html, $requerimientos_adicionales, $fecha);
    
    // Email para el equipo
    $subject_equipo = "Nueva Validación Recibida - $docente_nombre";
    $message_equipo = generarEmailEquipo($docente_nombre, $docente_email, $resumen_html, $requerimientos_adicionales, $fecha);
    
    // Enviar emails
    $email_docente_sent = enviarEmail($docente_email, $subject_docente, $message_docente);
    $email_equipo_sent = enviarEmail($smtp_user, $subject_equipo, $message_equipo);
    
    // Redirigir con resultado
    if ($email_docente_sent && $email_equipo_sent) {
        header("Location: gracias.php?status=success&email=" . urlencode($docente_email));
    } else {
        header("Location: gracias.php?status=email_error");
    }
    exit;
}

function getEmojiForValidation($validacion) {
    switch($validacion) {
        case 'Totalmente de acuerdo': return '💚';
        case 'De acuerdo': return '✅';
        case 'Neutro': return '⚠️';
        case 'En desacuerdo': return '❌';
        case 'Totalmente en desacuerdo': return '🚫';
        default: return '❓';
    }
}

function generarEmailDocente($nombre, $resumen, $adicionales, $fecha) {
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #2563eb, #1e40af); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
            .content { background: white; padding: 30px; border: 1px solid #e5e7eb; }
            .footer { background: #f8fafc; padding: 20px; text-align: center; border-radius: 0 0 10px 10px; color: #666; }
            table { width: 100%; border-collapse: collapse; margin: 20px 0; }
            th { background: #f1f5f9; padding: 12px; text-align: left; font-weight: 600; }
            .logo { width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; margin: 0 10px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <div style='display: flex; align-items: center; justify-content: center;'>
                    <div class='logo'>GRCU</div>
                    <div>
                        <h1 style='margin: 0; font-size: 24px;'>Validación Recibida</h1>
                        <p style='margin: 5px 0 0 0; opacity: 0.9;'>GRCU Manager - Equipo 4BYTES</p>
                    </div>
                    <div class='logo'>4B</div>
                </div>
            </div>
            
            <div class='content'>
                <h2>Estimado/a $nombre,</h2>
                <p>Muchas gracias por completar la validación de requerimientos para el proyecto <strong>GRCU Manager</strong>.</p>
                <p>A continuación, el resumen de sus respuestas registradas el <strong>$fecha</strong>:</p>
                
                <table>
                    <thead>
                        <tr>
                            <th>Requerimiento</th>
                            <th style='text-align: center;'>Validación</th>
                            <th>Comentarios</th>
                        </tr>
                    </thead>
                    <tbody>
                        $resumen
                    </tbody>
                </table>
                
                " . ($adicionales ? "<h3>Requerimientos Adicionales Sugeridos:</h3><div style='background: #fef3c7; padding: 15px; border-radius: 8px; border-left: 4px solid #f59e0b;'>$adicionales</div>" : "") . "
                
                <p>Sus respuestas han sido registradas correctamente y serán analizadas por nuestro equipo para la especificación final del sistema.</p>
                
                <div style='background: #e0f2fe; padding: 15px; border-radius: 8px; margin-top: 20px;'>
                    <strong>Próximos pasos:</strong><br>
                    • Análisis de todas las validaciones recibidas<br>
                    • Ajuste de requerimientos según feedback<br>
                    • Definición de requerimientos funcionales y no funcionales<br>
                    • Inicio de la fase de diseño del sistema
                </div>
            </div>
            
            <div class='footer'>
                <p><strong>Equipo 4BYTES</strong><br>
                Laboratorio de Desarrollo - UNPA UARG<br>
                4bytes@equis.com.ar</p>
            </div>
        </div>
    </body>
    </html>";
}

function generarEmailEquipo($nombre, $email, $resumen, $adicionales, $fecha) {
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #059669, #10b981); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
            .content { background: white; padding: 30px; border: 1px solid #e5e7eb; }
            .footer { background: #f8fafc; padding: 20px; text-align: center; border-radius: 0 0 10px 10px; color: #666; }
            table { width: 100%; border-collapse: collapse; margin: 20px 0; }
            th { background: #f1f5f9; padding: 12px; text-align: left; font-weight: 600; }
            .alert { background: #dbeafe; padding: 15px; border-radius: 8px; border-left: 4px solid #3b82f6; margin: 15px 0; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1 style='margin: 0;'>🎉 Nueva Validación Recibida</h1>
                <p style='margin: 5px 0 0 0; opacity: 0.9;'>Panel de Control - 4BYTES</p>
            </div>
            
            <div class='content'>
                <div class='alert'>
                    <strong>Docente:</strong> $nombre<br>
                    <strong>Email:</strong> $email<br>
                    <strong>Fecha:</strong> $fecha
                </div>
                
                <h3>Resumen de Validaciones:</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Requerimiento</th>
                            <th style='text-align: center;'>Validación</th>
                            <th>Comentarios</th>
                        </tr>
                    </thead>
                    <tbody>
                        $resumen
                    </tbody>
                </table>
                
                " . ($adicionales ? "<h3>🚀 Requerimientos Adicionales:</h3><div style='background: #fef3c7; padding: 15px; border-radius: 8px;'>$adicionales</div>" : "<p><em>No se sugirieron requerimientos adicionales.</em></p>") . "
                
                <div style='background: #f0fdf4; padding: 15px; border-radius: 8px; margin-top: 20px; border-left: 4px solid #22c55e;'>
                    <strong>✅ Acción completada:</strong> Validación registrada en BD y email de confirmación enviado al docente.
                </div>
            </div>
            
            <div class='footer'>
                <p>Sistema de Validación GRCU Manager<br>
                <small>Este email se generó automáticamente</small></p>
            </div>
        </div>
    </body>
    </html>";
}

function enviarEmail($to, $subject, $message) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: GRCU Manager <4bytes@equis.com.ar>' . "\r\n";
    $headers .= 'Reply-To: 4bytes@equis.com.ar' . "\r\n";
    
    return mail($to, $subject, $message, $headers);
}
?>