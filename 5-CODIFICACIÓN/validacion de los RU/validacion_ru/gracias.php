<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación Completada - GRCU Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .success-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .success-header {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }
        .success-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: bounce 1s infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="success-card">
                    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                    <div class="success-header">
                        <i class="fas fa-check-circle success-icon"></i>
                        <h1>¡Validación Completada!</h1>
                        <p class="mb-0">Sus respuestas han sido registradas exitosamente</p>
                    </div>
                    <div class="p-4">
                        <div class="alert alert-success">
                            <i class="fas fa-envelope me-2"></i>
                            Se ha enviado una copia de confirmación a <strong><?= htmlspecialchars($_GET['email'] ?? '') ?></strong>
                        </div>
                        <p>Muchas gracias por su tiempo y valuable feedback. Sus respuestas nos ayudarán a desarrollar un mejor sistema GRCU Manager.</p>
                        <div class="text-center mt-4">
                            <a href="index.php" class="btn btn-primary">
                                <i class="fas fa-arrow-left me-2"></i>Volver al formulario
                            </a>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="text-center p-4">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                        <h2 class="mt-3">Error al procesar</h2>
                        <p>Hubo un problema al enviar los emails. Sus respuestas se guardaron correctamente.</p>
                        <a href="index.php" class="btn btn-primary">Volver</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>