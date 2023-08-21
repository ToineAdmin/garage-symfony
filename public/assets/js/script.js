var menuLinks = document.querySelectorAll('.nav-link');

function updateActiveClass(event) {
    var clickedLink = event.target;

    menuLinks.forEach(function(link) {
        link.classList.remove('active');
    });
    clickedLink.classList.add('active');
}

menuLinks.forEach(function(link) {
    link.addEventListener('click', updateActiveClass);
});


// BOUTON EN SAVOIR PLUS CAR_CARD
function toggleDetails(button, carId) {
    var card = button.closest('.card');
    var details = card.querySelector('#details_' + carId);

    card.classList.toggle('active');
    details.style.display = card.classList.contains('active') ? 'block' : 'none';
    button.textContent = card.classList.contains('active') ? '-' : 'En savoir plus';
}