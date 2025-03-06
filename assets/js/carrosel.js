  // JavaScript Document
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.nk-image-slider-item');
    const dots = document.querySelectorAll('.nk-dot');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.add('active'); // Agregar clase active
                slide.style.display = 'block'; // Asegurarse de que se muestre
            } else {
                slide.classList.remove('active'); // Quitar clase active
                slide.style.display = 'none'; // Ocultar otros slides
            }
            dots[i].classList.toggle('active', i === index);
        });
    }

    // Función para avanzar al siguiente slide
    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length; // Ciclo a través de los slides
        showSlide(currentSlide);
    }

    // Inicializa el slider mostrando el primer slide
    showSlide(currentSlide);

    // Maneja el clic en los puntos
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });

    // Cambia automáticamente cada 5 segundos
    setInterval(nextSlide, 5000); // Cambia cada 5 segundos
});

  