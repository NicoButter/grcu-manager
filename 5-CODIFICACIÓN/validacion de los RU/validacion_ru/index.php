<?php
require_once 'config/db.php';

// Obtener requerimientos de la BD
$stmt = $pdo->query("SELECT * FROM requerimientos ORDER BY numero");
$requerimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de Requerimientos - GRCU Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <div class="main-container">
                    <!-- Header Section -->
                    <div class="header-section">
                        <div class="header-content">
                            <div class="logo-container">
                                <img src="img/grcu.jpg" alt="GRCU Manager" height="60" class="logo-img">
                                <div>
                                    <h1 class="h2 mb-0">Validación de Requerimientos</h1>
                                    <p class="mb-0 opacity-90">GRCU Manager - Gestión de Requerimientos y Casos de Uso</p>
                                </div>
                                <img src="img/4bytes.jpg" alt="4BYTES" height="60" class="logo-img">
                            </div>
                            <div class="progress-container">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small">Progreso de validación</span>
                                    <span class="small" id="progress-text">0/18 completados</span>
                                </div>
                                <div class="progress mt-2" style="height: 6px;">
                                    <div class="progress-bar bg-warning" id="progress-bar" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="content-section">
                        <!-- Info Alert -->
                        <div class="info-alert">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-info-circle fa-lg text-primary me-3 mt-1"></i>
                                <div>
                                    <h5 class="mb-2 text-primary">Estimados clientes (docentes)</h5>
                                    <p class="mb-0">Basándose en el <strong>enunciado inicial del proyecto</strong> y nuestra <strong>entrevista del 26 de agosto de 2025</strong>, hemos identificado <strong>18 requerimientos de usuarios</strong>. Solicitamos su validación para confirmar que reflejan correctamente sus necesidades para el proyecto GRCU Manager.</p>
                                </div>
                            </div>
                        </div>

                        <form id="validacionForm" action="procesar.php" method="POST">
                            <!-- User Info Card -->
                            <div class="user-info-card">
                                <h5 class="mb-3">
                                    <i class="fas fa-user-graduate text-primary me-2"></i>
                                    Información del Evaluador
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="docente_nombre" class="form-label fw-semibold">
                                            <i class="fas fa-user me-1"></i> Nombre completo *
                                        </label>
                                        <input type="text" class="form-control form-control-lg" id="docente_nombre" 
                                               name="docente_nombre" required placeholder="Ingrese su nombre completo">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="docente_email" class="form-label fw-semibold">
                                            <i class="fas fa-envelope me-1"></i> Email institucional *
                                        </label>
                                        <input type="email" class="form-control form-control-lg" id="docente_email" 
                                               name="docente_email" required placeholder="nombre@uarg.unpa.edu.ar">
                                    </div>
                                </div>
                            </div>

                            <!-- Requirements Cards -->
                            <div id="requirements-container">
                                <?php foreach($requerimientos as $index => $req): ?>
                                <div class="requirement-card" data-requirement="<?= $req['id'] ?>">
                                    <div class="requirement-header">
                                        <div class="d-flex align-items-center">
                                            <span class="requirement-number">RU-<?= str_pad($req['numero'], 2, '0', STR_PAD_LEFT) ?></span>
                                            <h5 class="requirement-title"><?= htmlspecialchars($req['descripcion']) ?></h5>
                                        </div>
                                    </div>
                                    <div class="requirement-body">
                                        <span class="source-badge">
                                            <i class="fas fa-tag me-1"></i>
                                            Este requerimiento se obtuvo de: <?= htmlspecialchars($req['fuente']) ?><?= ($req['numero'] == 17 && strpos($req['fuente'], 'Karim Hallar') !== false) ? ' - que coincide con la propuesta innovadora que nos habían solicitado, en ese momento nosotros la habíamos llamado "trazabilidad en vivo"' : '' ?>
                                        </span>

                                        <div class="rating-section">
                                            <label class="rating-label">
                                                <i class="fas fa-star text-warning me-2"></i>
                                                Nivel de acuerdo con este requerimiento:
                                            </label>
                                            <div class="rating-options">
                                                <!-- Opción 1: Estoy de acuerdo -->
                                                <div class="rating-option">
                                                    <input type="radio" class="rating-radio" 
                                                           name="req_<?= $req['id'] ?>" 
                                                           id="req_<?= $req['id'] ?>_acuerdo" 
                                                           value="Estoy de acuerdo" required>
                                                    <label class="rating-btn rating-btn-success" 
                                                           for="req_<?= $req['id'] ?>_acuerdo">
                                                        <i class="fas fa-thumbs-up me-2"></i>
                                                        Estoy de acuerdo
                                                    </label>
                                                </div>

                                                <!-- Opción 2: No estoy de acuerdo -->
                                                <div class="rating-option">
                                                    <input type="radio" class="rating-radio" 
                                                           name="req_<?= $req['id'] ?>" 
                                                           id="req_<?= $req['id'] ?>_desacuerdo" 
                                                           value="No estoy de acuerdo" required>
                                                    <label class="rating-btn rating-btn-danger" 
                                                           for="req_<?= $req['id'] ?>_desacuerdo">
                                                        <i class="fas fa-thumbs-down me-2"></i>
                                                        No estoy de acuerdo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="comment-section">
                                            <label for="comentario_<?= $req['id'] ?>" class="form-label fw-semibold">
                                                <i class="fas fa-comment-alt text-muted me-1"></i>
                                                Comentarios adicionales (opcional):
                                            </label>
                                            <textarea class="form-control comment-textarea" 
                                                      id="comentario_<?= $req['id'] ?>" 
                                                      name="comentario_<?= $req['id'] ?>" 
                                                      rows="3" 
                                                      placeholder="Comparta alguna aclaración, modificación sugerida o comentario adicional..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Additional Requirements Card -->
                            <div class="card additional-requirements-card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-lightbulb text-warning me-2"></i>
                                        ¿Falta algún requerimiento importante?
                                    </h5>
                                    <p class="text-muted mb-3">Si considera que hay algún requerimiento adicional que no hemos contemplado, por favor descríbalo a continuación:</p>
                                    <textarea class="form-control comment-textarea" 
                                              name="requerimientos_adicionales" 
                                              rows="4" 
                                              placeholder="Describa cualquier requerimiento adicional que considere necesario para el proyecto GRCU Manager..."></textarea>
                                </div>
                            </div>

                            <!-- Submit Section -->
                            <div class="submit-section">
                                <button type="submit" class="btn submit-btn" id="submit-button" disabled>
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Enviar Validación
                                </button>
                                <p class="text-muted small mt-3">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Sus respuestas se guardarán de forma segura y se enviará una copia a su email
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('validacionForm');
            const submitButton = document.getElementById('submit-button');
            const progressBar = document.getElementById('progress-bar');
            const progressText = document.getElementById('progress-text');
            const totalRequirements = <?= count($requerimientos) ?>;
            
            function updateProgress() {
                const completedRequirements = document.querySelectorAll('input[type="radio"]:checked').length;
                const progress = (completedRequirements / totalRequirements) * 100;
                
                progressBar.style.width = progress + '%';
                progressText.textContent = completedRequirements + '/' + totalRequirements + ' completados';
                
                submitButton.disabled = completedRequirements < totalRequirements;
                
                if (completedRequirements === totalRequirements) {
                    progressBar.classList.remove('bg-warning');
                    progressBar.classList.add('bg-success');
                }
            }
            
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', updateProgress);
            });
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
                submitButton.disabled = true;
                
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });
        });
    </script>
</body>
</html>