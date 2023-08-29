

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
