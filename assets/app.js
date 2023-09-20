import './styles/app.css';
import './bootstrap.js';
import 'bootstrap';
import $ from 'jquery';
import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';




const imagesContext = require.context('./images', false, /\.(png|jpe?g|svg)$/);
imagesContext.keys().forEach(imagesContext);

/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

//REQUETE AJAX POUR FILTRE
$(function() {
    $('#filterButton').on('click', function() {
        $.ajax({
            url: '/voiture-occasion',
            method: 'GET',
            data: $('.filter').serialize(),
            success: function(response) {
                $('#idConteneurResultats').html(response);
            }
        });
    });
});


