<br><br><br><br>
<main class="barberos">
    <section class="barbero">
        <img src="/BackEnd/Assets/imagenes/JUAN DIEGO.png" alt="Juan Diego" />
        <div class="descripcion">
            <h3>Juan Diego</h3>
            <p>Breve descripción de su experiencia y especialidades.</p>
            <a href="/BackEnd/Controllers/agendar_cita.php" class="btn">Agendar cita</a>
        </div>
    </section>
    <section class="barbero">
        <img src="/BackEnd/Assets/imagenes/barbero.jpg" alt="Barbero 2" />
        <div class="descripcion">
            <h3>Nombre del barbero 2</h3>
            <p>Breve descripción de su experiencia y especialidades.</p>
            <a href="" class="btn">Agendar cita</a>
        </div>
    </section>
</main>

<br><br>

<div class="promocional-section">
    <!-- Aquí van los 4 elementos promocionales -->
    <?php for ($i = 0; $i < 4; $i++): ?>
        <div class="elementor-element">
            <div class="elementor-icon-box-wrapper">
                <div class="elementor-icon-box-icon">
                    <span class="elementor-icon">
                        <i class="hm hm-scissor"></i>
                    </span>
                </div>
                <div class="elementor-icon-box-content">
                    <h3 class="elementor-icon-box-title">
                        <?= ["Estilo Inigualable", "Confianza Renovada", "Productos de Calidad", "Experiencia Premium"][$i] ?>
                    </h3>
                    <p class="elementor-icon-box-description">
                        <?php
                        $desc = [
                            "BAR-BER-GO, te ofrece cortes de barba que reflejan tu estilo y resaltan tu singularidad.",
                            "Con nuestros servicios, no solo mejorarás tu estilo, sino también tu confianza. ¡Estás listo para destacar!",
                            "Usamos productos de calidad superior para asegurar que tu piel y barba reciban el mejor cuidado posible.",
                            "Cada vez que nos visites, te garantizamos una experiencia exclusiva y un servicio de calidad superior."
                        ];
                        echo $desc[$i];
                        ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endfor; ?>
</div>

<br><br><br>

<section class="servicios">
    <h2>Servicios que Ofrecemos</h2>
    <div class="servicio-lista">
        <div class="servicio-item">
            <div class="icono">
                <img src="/BackEnd/Assets/imagenes/corte_cabello.jpg" alt="Corte de Cabello" />
            </div>
            <h3>Corte de Cabello</h3>
            <p>Ofrecemos cortes de cabello personalizados, diseñados para reflejar tu estilo único y mantenerte a la moda.</p>
        </div>
        <div class="servicio-item">
            <div class="icono">
                <img src="/BackEnd/Assets/imagenes/arreglo_barba.png" alt="Arreglo de Barba" />
            </div>
            <h3>Arreglo de Barba</h3>
            <p>Te ayudamos a mantener tu barba en su mejor forma con recortes, hidratación y productos especializados.</p>
        </div>
        <div class="servicio-item">
            <div class="icono">
                <img src="/BackEnd/Assets/imagenes/decoloracion.jpg" alt="Decoloración" />
            </div>
            <h3>Decoloraciones capilares</h3>
            <p>Transforma tu estilo con una decoloración personalizada...</p>
        </div>
        <div class="servicio-item">
            <div class="icono">
                <img src="/BackEnd/Assets/imagenes/afeitado.jpg" alt="Afeitado Profesional" />
            </div>
            <h3>Afeitado Profesional</h3>
            <p>Disfruta de un afeitado tradicional con cuchilla...</p>
        </div>
    </div>
</section>

<br><br><br>

<section class="mapa">
    <h2>Nuestra Ubicación</h2>
    <iframe src="https://www.google.com/maps/embed?pb=..." allowfullscreen="" loading="lazy"></iframe>
</section>
