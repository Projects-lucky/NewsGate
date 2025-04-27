document.addEventListener('DOMContentLoaded', () => {
    const carouselInner = document.querySelector('.vp-slide-post-container');
    const carouselItems = document.querySelectorAll('.vp-post-container');
    const prevBtn = document.getElementById('left');
    const nextBtn = document.getElementById('right');

    let currentIndex = 0; // Tracks the current slide index
    const totalSlides = carouselItems.length;

    // Clone the first and last slides for infinite effect
    const firstClone = carouselItems[0].cloneNode(true);
    const lastClone = carouselItems[totalSlides - 1].cloneNode(true);

    carouselInner.appendChild(firstClone); // Append first slide to the end
    carouselInner.insertBefore(lastClone, carouselItems[0]); // Prepend last slide to the beginning

    // Update the total number of slides after cloning
    const updatedSlides = document.querySelectorAll('.vp-post-container');

    // Set initial position to show the first real slide
    carouselInner.style.transform = `translateX(${-100 * (currentIndex + 1)}%)`;

    // Function to move to the next slide
    function moveToNextSlide() {
        if (currentIndex >= totalSlides) {
            // If at the cloned first slide, reset to the real first slide
            currentIndex = 0;
            carouselInner.style.transition = 'none'; // Disable transition for instant reset
            carouselInner.style.transform = `translateX(${-100 * (currentIndex + 1)}%)`;
            setTimeout(() => {
                carouselInner.style.transition = 'transform 0.5s ease-in-out'; // Re-enable transition
            }, 50);
        } else {
            currentIndex++;
            carouselInner.style.transform = `translateX(${-100 * (currentIndex + 1)}%)`;
        }
    }

    // Function to move to the previous slide
    function moveToPrevSlide() {
        if (currentIndex <= 0) {
            // If at the cloned last slide, reset to the real last slide
            currentIndex = totalSlides - 1;
            carouselInner.style.transition = 'none'; // Disable transition for instant reset
            carouselInner.style.transform = `translateX(${-100 * (currentIndex + 1)}%)`;
            setTimeout(() => {
                carouselInner.style.transition = 'transform 0.5s ease-in-out'; // Re-enable transition
            }, 50);
        } else {
            currentIndex--;
            carouselInner.style.transform = `translateX(${-100 * (currentIndex + 1)}%)`;
        }
    }

    // Event listeners for buttons
    nextBtn.addEventListener('click', moveToNextSlide);
    prevBtn.addEventListener('click', moveToPrevSlide);

    // Optional: Auto-play functionality
    setInterval(moveToNextSlide, 3000); // Auto-advance every 3 seconds
});