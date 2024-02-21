document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM entièrement chargé et analysé");

    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-img');
    const lightboxCategory = document.getElementById('lightbox-category');
    const lightboxRef = document.getElementById('lightbox-ref');
    const closeLightboxButton = document.getElementById('close-lightbox');
    const prevPhotoButton = document.getElementById('prev-photo');
    const nextPhotoButton = document.getElementById('next-photo');
    const imagesContainer = document.querySelector('body');
    let currentIndex = -1;

    imagesContainer.addEventListener('click', function(e) {
        let trigger = e.target.closest('.icon-fullscreen-trigger');
        if (!trigger) return;

        e.preventDefault();
        let imageWrapper = trigger.closest('.photo-card-wrapper, .single-photo-card-wrapper, .related-photo');
        if (!imageWrapper) return;

        currentIndex = Array.from(document.querySelectorAll('.photo-card-wrapper, .single-photo-card-wrapper, .related-photo')).indexOf(imageWrapper);
        console.log(`Ouverture de la lightbox pour l'image à l'index ${currentIndex}`);
        updateLightbox(currentIndex);
    });

    function updateLightbox(index) {
        const images = Array.from(document.querySelectorAll('.photo-card-wrapper, .single-photo-card-wrapper, .related-photo'));
        if (index < 0 || index >= images.length) return;
        currentIndex = index;
        const data = images[index].querySelector('.icon-fullscreen-trigger');
        lightboxImage.src = data.getAttribute('data-lightbox');
        lightboxCategory.textContent = data.getAttribute('data-category');
        lightboxRef.textContent = data.getAttribute('data-ref');
        lightbox.style.display = 'block';
    }

    function closeLightbox() {
        console.log("Fermeture de la lightbox");
        lightbox.style.display = 'none';
    }

    closeLightboxButton.addEventListener('click', function() {
        closeLightbox();
    });

    prevPhotoButton.addEventListener('click', function() {
        if (currentIndex > 0) {
            updateLightbox(currentIndex - 1);
        }
    });

    nextPhotoButton.addEventListener('click', function() {
        const images = Array.from(document.querySelectorAll('.photo-card-wrapper, .single-photo-card-wrapper, .related-photo'));
        if (currentIndex < images.length - 1) {
            updateLightbox(currentIndex + 1);
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && lightbox.style.display === 'block') {
            closeLightbox();
        }
    });
});
