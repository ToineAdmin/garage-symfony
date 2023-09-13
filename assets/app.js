import './styles/app.css';
import './nouislider.min.js';
import './bootstrap.js';
import './styles/nouislider.css';
import 'bootstrap';


const imagesContext = require.context('./images', false, /\.(png|jpe?g|svg)$/);
imagesContext.keys().forEach(imagesContext);

/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉')
