<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todas las Carreras - Instituto Superior de Educación</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <!-- Header de Carreras -->
    <div class="page-header-carreras">
        <div class="container-landing">
            <h1 class="page-title-carreras">
                <i class="fas fa-graduation-cap"></i>
                Todas Nuestras Carreras
            </h1>
            <p class="page-description-carreras">
                Descubre nuestra amplia oferta académica diseñada para formar profesionales de excelencia
            </p>
        </div>
    </div>

    <!-- Carreras Completas -->
    <section class="carreras-section" style="padding-top: 3rem;">
        <div class="container-landing">
            <div class="carreras-grid">
                <!-- Carrera 1: Programación -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="carrera-title">Tecnicatura en Programación</h3>
                    <p class="carrera-description">Desarrollo de software, aplicaciones web y móviles. Formación en las tecnologías más demandadas del mercado.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 3 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Mañana / Noche</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Carrera 2: Enfermería -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3 class="carrera-title">Enfermería Profesional</h3>
                    <p class="carrera-description">Formación integral en salud, cuidados intensivos y atención primaria. Prácticas en hospitales de referencia.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 3 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Mañana / Tarde</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Carrera 3: Administración -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3 class="carrera-title">Administración de Empresas</h3>
                    <p class="carrera-description">Gestión empresarial, finanzas y recursos humanos. Preparación para liderar organizaciones exitosas.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 3 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Tarde / Noche</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Carrera 4: Diseño Gráfico -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h3 class="carrera-title">Diseño Gráfico Digital</h3>
                    <p class="carrera-description">Creatividad y tecnología. Formación en diseño visual, publicidad y medios digitales.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 3 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Mañana / Tarde</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Carrera 5: Educación Inicial -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <i class="fas fa-child"></i>
                    </div>
                    <h3 class="carrera-title">Educación Inicial</h3>
                    <p class="carrera-description">Formación de docentes especializados en primera infancia. Metodologías innovadoras de enseñanza.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 4 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Mañana / Tarde</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Carrera 6: Marketing Digital -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="carrera-title">Marketing Digital</h3>
                    <p class="carrera-description">Estrategias digitales, redes sociales y comercio electrónico. Formación práctica en casos reales.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 2.5 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Tarde / Noche</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- NUEVAS CARRERAS -->

                <!-- Carrera 7: Contabilidad -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3 class="carrera-title">Tecnicatura en Contabilidad</h3>
                    <p class="carrera-description">Formación en gestión contable, auditoría y tributación. Dominio de sistemas de información contable.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 3 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Mañana / Noche</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Carrera 8: Turismo -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                        <i class="fas fa-plane"></i>
                    </div>
                    <h3 class="carrera-title">Gestión de Turismo</h3>
                    <p class="carrera-description">Planificación turística, gestión hotelera y eventos. Formación en servicios de viajes y hospitalidad.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 3 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Tarde / Noche</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Carrera 9: Seguridad e Higiene -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #ff9a56 0%, #ff6a88 100%);">
                        <i class="fas fa-hard-hat"></i>
                    </div>
                    <h3 class="carrera-title">Seguridad e Higiene Laboral</h3>
                    <p class="carrera-description">Prevención de riesgos, seguridad industrial y salud ocupacional. Formación en normativas vigentes.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 3 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Mañana / Tarde</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Carrera 10: Recursos Humanos -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #a890fe 0%, #ffa9ff 100%);">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <h3 class="carrera-title">Recursos Humanos</h3>
                    <p class="carrera-description">Gestión del talento, capacitación y desarrollo organizacional. Liderazgo y relaciones laborales.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 3 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Tarde / Noche</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Carrera 11: Análisis de Sistemas -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #5ee7df 0%, #b490ca 100%);">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="carrera-title">Análisis de Sistemas</h3>
                    <p class="carrera-description">Diseño y desarrollo de sistemas informáticos. Gestión de bases de datos y arquitectura de software.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 3 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Mañana / Noche</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Carrera 12: Comunicación Social -->
                <div class="carrera-card">
                    <div class="carrera-icon" style="background: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%);">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3 class="carrera-title">Comunicación Social</h3>
                    <p class="carrera-description">Periodismo, relaciones públicas y producción audiovisual. Formación en medios tradicionales y digitales.</p>
                    <ul class="carrera-info">
                        <li><i class="fas fa-clock"></i> Duración: 4 años</li>
                        <li><i class="fas fa-calendar"></i> Turno: Mañana / Tarde</li>
                    </ul>
                    <a href="#" class="btn-carrera">Más Información <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Botón para volver -->
            <div class="text-center mt-5">
                <a href="<?= site_url('/') ?>" class="btn-hero btn-hero-primary">
                    <i class="fas fa-arrow-left"></i>
                    Volver al Inicio
                </a>
            </div>
        </div>
    </section>

    <?= $this->endSection() ?>
</body>

</html>
