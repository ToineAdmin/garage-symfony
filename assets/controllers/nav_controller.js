import { Controller } from 'stimulus';

// CLASS ACTIVE SUR LINK POUR LA NAV

export default class extends Controller {
    connect() {
        this.menuLinks = this.element.querySelectorAll('.nav-link');
        this.setActiveClassBasedOnCurrentPath();
        this.addClickListeners();
    }

    setActiveClassBasedOnCurrentPath() {
        const currentPath = window.location.pathname + window.location.hash;
        this.menuLinks.forEach((link) => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    addClickListeners() {
        this.menuLinks.forEach((link) => {
            link.addEventListener('click', (event) => {
                this.menuLinks.forEach((innerLink) => {
                    innerLink.classList.remove('active');
                });
                event.currentTarget.classList.add('active');
            });
        });
    }
}
