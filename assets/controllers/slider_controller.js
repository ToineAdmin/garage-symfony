import { Controller } from "stimulus";
import noUiSlider from "nouislider";

export default class extends Controller {
    static targets = ["price", "miles", "year"];

    connect() {
        this.setupPriceSlider();
        this.setupMilesSlider();
        this.setupYearSlider();
    }

    setupPriceSlider() {
        if (this.priceTarget) {
            const minPrice = document.getElementById('minPrice');
            const maxPrice = document.getElementById('maxPrice');
            
            const range = noUiSlider.create(this.priceTarget, {
                start: [minPrice.value || 0, maxPrice.value || 50000],
                connect: true,
                step: 100,
                range: {
                    'min': 500,
                    'max': 50000
                }
            });
            range.on('slide', function (values, handle) {
                if (handle === 0) {
                    minPrice.value = Math.round(values[0]);
                }
                if (handle === 1) {
                    maxPrice.value = Math.round(values[1]);
                }
            });
        }
    }

    setupMilesSlider() {
        if (this.milesTarget) {
            const minMiles = document.getElementById('minMiles');
            const maxMiles = document.getElementById('maxMiles');
            
            const rangeMiles = noUiSlider.create(this.milesTarget, {
                start: [minMiles.value || 0, maxMiles.value || 400000],
                connect: true,
                step: 1000,
                range: {
                    'min': 0,
                    'max': 400000
                }
            });
            rangeMiles.on('slide', function (values, handle) {
                if (handle === 0) {
                    minMiles.value = Math.round(values[0]);
                }
                if (handle === 1) {
                    maxMiles.value = Math.round(values[1]);
                }
            });
        }
    }

    setupYearSlider() {
        if (this.yearTarget) {
            const currentYear = new Date().getFullYear();
            const minYear = document.getElementById('minYear');
            const maxYear = document.getElementById('maxYear');
            
            const rangeYear = noUiSlider.create(this.yearTarget, {
                start: [minYear.value || 1990, maxYear.value || currentYear],
                connect: true,
                step: 1,
                range: {
                    'min': 1995,
                    'max': currentYear
                }
            });
            rangeYear.on('slide', function (values, handle) {
                if (handle === 0) {
                    minYear.value = Math.round(values[0]);
                }
                if (handle === 1) {
                    maxYear.value = Math.round(values[1]);
                }
            });
        }
    }
}
