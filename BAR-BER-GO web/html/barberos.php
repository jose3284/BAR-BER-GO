<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAR-BER-GO</title>
    <link rel="stylesheet" href="../css/barberos.css">
</head>
<body>
    <div class="Body fondo">
        <!-- Header -->
        <header class="encabezado">
            <img id="bar" src="../imagenes/bar-ber-go.png" alt="Logo" />
            <nav>
                <ul>
                    <li id="calificacion">
                        <a href="./calificaciones.html"><h3>Calificación</h3></a>
                    </li>
                    <li id="tienda">
                        <a href="./carrito1.html"><h3>Tienda virtual</h3></a>
                    </li>
                    <!-- Enlace para cerrar sesión -->
                    <li id="tienda">
                        <a href="cerrar_sesion.php"><h3>Cerrar sesión</h3></a>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Main content with barber sections -->
        <main class="barberos">
            <section class="barbero">
                <img src="../imagenes/JUAN DIEGO.png" alt="Juan Diego" />
                <div class="descripcion">
                    <h3>Juan Diego</h3>
                    <p>Breve descripción de su experiencia y especialidades.</p>
                    <a href="./citas.html" class="btn">Agendar cita</a>
                </div>
            </section>
            <section class="barbero">
                <img src="../imagenes/barbero.jpg" alt="Barbero 2" />
                <div class="descripcion">
                    <h3>Nombre del barbero 2</h3>
                    <p>Breve descripción de su experiencia y especialidades.</p>
                    <a href="./citas.html" class="btn">Agendar cita</a>
                </div>
            </section>
        </main>

        <br><br>

        <!-- Promotional section -->
        <div class="promocional-section">
            <div class="elementor-element">
                <div class="elementor-icon-box-wrapper">
                    <div class="elementor-icon-box-icon">
                        <span class="elementor-icon">
                            <i class="hm hm-scissor"></i>
                        </span>
                    </div>
                    <div class="elementor-icon-box-content">
                        <h3 class="elementor-icon-box-title">Estilo Inigualable</h3>
                        <p class="elementor-icon-box-description">
                            BAR-BER-GO, te ofrece cortes de barba que reflejan tu estilo y resaltan tu singularidad.
                        </p>
                    </div>
                </div>
            </div>

            <div class="elementor-element">
                <div class="elementor-icon-box-wrapper">
                    <div class="elementor-icon-box-icon">
                        <span class="elementor-icon">
                            <i class="hm hm-scissor"></i>
                        </span>
                    </div>
                    <div class="elementor-icon-box-content">
                        <h3 class="elementor-icon-box-title">Confianza Renovada</h3>
                        <p class="elementor-icon-box-description">
                            Con nuestros servicios, no solo mejorarás tu estilo, sino también tu confianza. ¡Estás listo para destacar!
                        </p>
                    </div>
                </div>
            </div>

            <div class="elementor-element">
                <div class="elementor-icon-box-wrapper">
                    <div class="elementor-icon-box-icon">
                        <span class="elementor-icon">
                            <i class="hm hm-scissor"></i>
                        </span>
                    </div>
                    <div class="elementor-icon-box-content">
                        <h3 class="elementor-icon-box-title">Productos de Calidad</h3>
                        <p class="elementor-icon-box-description">
                            Usamos productos de calidad superior para asegurar que tu piel y barba reciban el mejor cuidado posible.
                        </p>
                    </div>
                </div>
            </div>

            <div class="elementor-element">
                <div class="elementor-icon-box-wrapper">
                    <div class="elementor-icon-box-icon">
                        <span class="elementor-icon">
                            <i class="hm hm-scissor"></i>
                        </span>
                    </div>
                    <div class="elementor-icon-box-content">
                        <h3 class="elementor-icon-box-title">Experiencia Premium</h3>
                        <p class="elementor-icon-box-description">
                            Cada vez que nos visites, te garantizamos una experiencia exclusiva y un servicio de calidad superior.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <br><br><br>

        <!-- Services section -->
        <section class="servicios">
            <h2>Servicios que Ofrecemos</h2>
            <div class="servicio-lista">
                <div class="servicio-item">
                    <div class="icono">
                        <img src="../imagenes/corte_cabello.jpg" alt="Corte de Cabello" />
                    </div>
                    <h3>Corte de Cabello</h3>
                    <p>Ofrecemos cortes de cabello personalizados, diseñados para reflejar tu estilo único y mantenerte a la moda.</p>
                </div>
                <div class="servicio-item">
                    <div class="icono">
                        <img src="../imagenes/arreglo_barba.png" alt="Arreglo de Barba" />
                    </div>
                    <h3>Arreglo de Barba</h3>
                    <p>Te ayudamos a mantener tu barba en su mejor forma con recortes, hidratación y productos especializados.</p>
                </div>
                <div class="servicio-item">
                    <div class="icono">
                        <img src="../imagenes/decoloracion.jpg" alt="Decoloración" />
                    </div>
                    <h3>Decoloraciones capilares</h3>
                    <p>Transforma tu estilo con una decoloración personalizada. Desde rubios brillantes hasta tonos vibrantes, nuestros expertos te ayudarán a lograr el look que deseas.</p>
                </div>
                <div class="servicio-item">
                    <div class="icono">
                        <img src="../imagenes/afeitado.jpg" alt="Afeitado Profesional" />
                    </div>
                    <h3>Afeitado Profesional</h3>
                    <p>Disfruta de un afeitado tradicional con cuchilla, diseñado para una experiencia única y una piel suave.</p>
                </div>
            </div>
        </section>

        <br><br><br>

        <!-- Map Section -->
        <section class="mapa">
            <h2>Nuestra Ubicación</h2>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.92662214166!2d-74.17762558923788!3d4.607158395348204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9e5e5c9b20a9%3A0x1580bb80a1cc9076!2sCl.%2058%20Sur%20%2378f2%2C%20Bogot%C3%A1!5e0!3m2!1ses!2sco!4v1726608361122!5m2!1ses!2sco"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </section>

        <br><br><br>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2024 BAR_BER_GO.</p>
        </footer>
    </div>

    <!-- Mostrar alerta si la sesión fue cerrada -->
    <?php
    if (isset($_GET['mensaje'])) {
        echo "<script>
                alert('" . $_GET['mensaje'] . "');
              </script>";
    }
    ?>
</body>
</html>


