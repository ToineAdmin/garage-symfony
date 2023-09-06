

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
function toggleDetails(index) {
    var details = document.getElementById('details_' + index);
    var toggleButton = document.getElementById('toggle-button_' + index);
    var card = toggleButton.closest('.card');

    if (details.style.display === 'none') {
        details.style.display = 'block';
        toggleButton.textContent = 'Moins d\'infos';
        card.classList.add('expanded-card');
    } else {
        details.style.display = 'none';
        toggleButton.textContent = 'En savoir plus';
        card.classList.remove('expanded-card');
    }
}

// Filter slider noUiSlider

const slider = document.getElementById('price-slider');

if(slider){
    const minPrice = document.getElementById('minPrice');
    const maxPrice = document.getElementById('maxPrice');
    const range = noUiSlider.create(slider, {
        start: [minPrice.value || 0, maxPrice.value || 50000],
        connect: true,
        step:100,
        range: {
            'min': 500,
            'max': 50000
        }
    });

    range.on('slide', function (values,handle){
        if (handle === 0 ){
            minPrice.value = Math.round(values[0])
        }
        if (handle === 1){
            maxPrice.value = Math.round(values[1])
        }
    })
}

// Kilomètres
const milesSlider = document.getElementById('miles-slider');

if(milesSlider){
    const minMiles = document.getElementById('minMiles');
    const maxMiles = document.getElementById('maxMiles');
    const rangeMiles = noUiSlider.create(milesSlider, {
        start: [minMiles.value || 0, maxMiles.value || 400000], 
        connect: true,
        step:1000,
        range: {
            'min': 0,
            'max': 400000
        }
    });

    rangeMiles.on('slide', function (values, handle){
        if (handle === 0 ){
            minMiles.value = Math.round(values[0])
        }
        if (handle === 1){
            maxMiles.value = Math.round(values[1])
        }
    });
}

// Année
const yearSlider = document.getElementById('year-slider');

if(yearSlider){
    const currentYear = new Date().getFullYear();
    const minYear = document.getElementById('minYear');
    const maxYear = document.getElementById('maxYear');
    const rangeYear = noUiSlider.create(yearSlider, {
        start: [minYear.value || 1990, maxYear.value || currentYear], 
        connect: true,
        step:1,
        range: {
            'min': 1990,
            'max': currentYear
        }
    });

    rangeYear.on('slide', function (values, handle){
        if (handle === 0 ){
            minYear.value = Math.round(values[0])
        }
        if (handle === 1){
            maxYear.value = Math.round(values[1])
        }
    });
}

// MODIFICATION AGE DU GARAGE
document.addEventListener("DOMContentLoaded", function() {
    const startYear = 2021;
    const currentYear = new Date().getFullYear(); // Récupère l'année actuelle
    const yearsActive = currentYear - startYear;
    
    document.getElementById("yearsActive").textContent = yearsActive;
});

// FEEDBACK CARD

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-text').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const action = e.target.getAttribute('data-action');
            const feedbackCard = e.target.closest('.feedback-card');
            const feedbackText = e.target.closest('.feedback-text');
            const moreText = feedbackText.querySelector('.more-text');
            const showButton = feedbackText.querySelector('button[data-action="show"]');
            const hideButton = moreText.querySelector('button[data-action="hide"]');

            if (action === 'show') {
                moreText.style.display = 'inline';
                showButton.style.display = 'none';
                feedbackCard.style.height = 'auto';
            } else if (action === 'hide') {
                moreText.style.display = 'none';
                showButton.style.display = 'inline';
                feedbackCard.style.height = ''; // Remet la hauteur à sa valeur par défaut
            }
        });
    });
});


