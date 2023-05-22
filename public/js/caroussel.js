document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.carousel');
    const slides = Array.from(carousel.querySelectorAll('.slide'));
    const prevButton = document.createElement('button');
    const nextButton = document.createElement('button');

    prevButton.classList.add('prev');
    nextButton.classList.add('next');
    prevButton.textContent = 'Précédent';
    nextButton.textContent = 'Suivant';

    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i !== index) {
                slide.style.display = 'none';
            }
        });

        slides[index].style.display = 'block';
    }

    function goToPrevSlide() {
        currentSlide--;
        if (currentSlide < 0) {
            currentSlide = slides.length - 1;
        }
        showSlide(currentSlide);
    }

    function goToNextSlide() {
        currentSlide++;
        if (currentSlide >= slides.length) {
            currentSlide = 0;
        }
        showSlide(currentSlide);
    }

    carousel.appendChild(prevButton);
    carousel.appendChild(nextButton);

    prevButton.addEventListener('click', goToPrevSlide);
    nextButton.addEventListener('click', goToNextSlide);

    showSlide(currentSlide);
});