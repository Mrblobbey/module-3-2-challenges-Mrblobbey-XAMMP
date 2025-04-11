document.addEventListener('DOMContentLoaded', function() {
    const imagesCanSelect = document.querySelectorAll('.images img');
    const mainImage = document.querySelector('.mainImage');

    imagesCanSelect.forEach(function(image) {
        image.addEventListener('click', function() {
            mainImage.src = image.src;
        });
    });
});