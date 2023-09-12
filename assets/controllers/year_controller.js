import { Controller } from "stimulus";

export default class extends Controller {
    static targets = ["active"];
    
    connect() {
        this.calculateYears();
    }

    calculateYears() {
        const startYear = 2021;
        const currentYear = new Date().getFullYear();
        const yearsActive = currentYear - startYear;

        this.activeTarget.textContent = yearsActive;
    }
}
