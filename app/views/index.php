<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituto Superior de Educación - Formando Profesionales de Excelencia</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <!-- Hero Section -->
    <div class="hero-landing">
        <div class="hero-overlay-landing"></div>
        <div class="hero-content-landing">
            <div class="hero-badge">
                <i class="fas fa-award"></i>
                <span>Excelencia Académica desde 1995</span>
            </div>
            <h1 class="hero-title-landing">
                Instituto Superior de Educación Profesional
            </h1>
            <p class="hero-description">
                Formamos profesionales comprometidos con la excelencia, la innovación y el desarrollo de nuestra comunidad
            </p>
            <div class="hero-buttons">
                <a href="#carreras" class="btn-hero btn-hero-primary">
                    <i class="fas fa-book-open"></i>
                    Ver Carreras
                </a>
                <a href="#about" class="btn-hero btn-hero-secondary">
                    <i class="fas fa-info-circle"></i>
                    Conocer Más
                </a>
            </div>
            
            <div class="hero-stats-landing">
                <div class="stat-box">
                    <div class="stat-number-landing">28</div>
                    <div class="stat-label-landing">Años de Trayectoria</div>
                </div>
                <div class="stat-divider-landing"></div>
                <div class="stat-box">
                    <div class="stat-number-landing">2,500+</div>
                    <div class="stat-label-landing">Estudiantes Activos</div>
                </div>
                <div class="stat-divider-landing"></div>
                <div class="stat-box">
                    <div class="stat-number-landing">15+</div>
                    <div class="stat-label-landing">Carreras Disponibles</div>
                </div>
                <div class="stat-divider-landing"></div>
                <div class="stat-box">
                    <div class="stat-number-landing">95%</div>
                    <div class="stat-label-landing">Inserción Laboral</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sobre Nosotros -->
    <section id="about" class="about-section">
        <div class="container-landing">
            <div class="about-content">
                <div class="about-text">
                    <span class="section-label">Sobre Nosotros</span>
                    <h2 class="section-title-landing">Una Institución Comprometida con tu Futuro</h2>
                    <p class="section-description-landing">
                        Desde 1995, el Instituto Superior de Educación Profesional se ha consolidado como una de las instituciones educativas de mayor prestigio en la región. Nuestra misión es formar profesionales altamente capacitados, con valores éticos y responsabilidad social.
                    </p>
                    <p class="section-description-landing">
                        Contamos con un cuerpo docente de excelencia, infraestructura moderna y convenios con empresas líderes que garantizan la inserción laboral de nuestros egresados.
                    </p>
                    <div class="about-features">
                        <div class="about-feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Títulos oficiales reconocidos</span>
                        </div>
                        <div class="about-feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Modalidad presencial y online</span>
                        </div>
                        <div class="about-feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Prácticas profesionales garantizadas</span>
                        </div>
                        <div class="about-feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Bolsa de trabajo activa</span>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <div class="image-placeholder">
                        <i class="fas fa-university"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Carreras Destacadas -->
    <section id="carreras" class="carreras-section">
        <div class="container-landing">
            <div class="section-header-center">
                <span class="section-label">Oferta Académica</span>
                <h2 class="section-title-landing">Nuestras Carreras</h2>
                <p class="section-description-landing">
                    Programas académicos diseñados para formar profesionales competitivos en el mercado laboral actual
                </p>
            </div>

            <div class="carreras-grid">
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
            </div>
        </div>
    </section>

    <!-- Por Qué Elegirnos -->
    <section class="why-us-section">
        <div class="container-landing">
            <div class="section-header-center">
                <span class="section-label">Ventajas</span>
                <h2 class="section-title-landing">¿Por Qué Elegirnos?</h2>
            </div>

            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon blue-gradient">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h4 class="benefit-title">Docentes Calificados</h4>
                    <p class="benefit-text">Profesionales con amplia experiencia en el sector educativo y laboral</p>
                </div>

                <div class="benefit-card">
                    <div class="benefit-icon green-gradient">
                        <i class="fas fa-building"></i>
                    </div>
                    <h4 class="benefit-title">Infraestructura Moderna</h4>
                    <p class="benefit-text">Aulas equipadas, laboratorios y biblioteca con recursos actualizados</p>
                </div>

                <div class="benefit-card">
                    <div class="benefit-icon purple-gradient">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h4 class="benefit-title">Convenios Empresariales</h4>
                    <p class="benefit-text">Alianzas con empresas líderes para prácticas y oportunidades laborales</p>
                </div>

                <div class="benefit-card">
                    <div class="benefit-icon orange-gradient">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h4 class="benefit-title">Títulos Oficiales</h4>
                    <p class="benefit-text">Certificaciones reconocidas a nivel nacional e internacional</p>
                </div>

                <div class="benefit-card">
                    <div class="benefit-icon red-gradient">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h4 class="benefit-title">Horarios Flexibles</h4>
                    <p class="benefit-text">Turnos mañana, tarde y noche adaptados a tus necesidades</p>
                </div>

                <div class="benefit-card">
                    <div class="benefit-icon teal-gradient">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h4 class="benefit-title">Campus Virtual</h4>
                    <p class="benefit-text">Plataforma online 24/7 con materiales y seguimiento académico</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container-landing">
            <div class="cta-content">
                <h2 class="cta-title">¿Listo para Iniciar tu Carrera Profesional?</h2>
                <p class="cta-description">Únete a nuestra comunidad educativa y comienza a construir tu futuro hoy mismo</p>
                <div class="cta-buttons">
                    <a href="#" class="btn-cta btn-cta-primary">
                        <i class="fas fa-edit"></i>
                        Inscribirse Ahora
                    </a>
                    <a href="#" class="btn-cta btn-cta-secondary">
                        <i class="fas fa-phone"></i>
                        Solicitar Información
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?= $this->endSection() ?>
</body>

</html>