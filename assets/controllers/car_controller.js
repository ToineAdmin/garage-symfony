import { Controller } from 'stimulus';

// FONCTIONNALITE PLUS DE DETAIL SUR CAR CARD

export default class extends Controller {
    static targets = ["details", "toggleButton"];

    toggleDetails() {
        const details = this.detailsTarget;
        const toggleButton = this.toggleButtonTarget;
        const card = toggleButton.closest('.card');

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
}

