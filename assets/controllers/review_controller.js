import { Controller } from 'stimulus';

// ADD "SHOW MORE" FUNCTIONALITY

export default class extends Controller {
    static targets = ["toggle", "moreText", "showButton", "feedbackCard", "feedbackText"];

    toggleText(e) {
        e.preventDefault();

        const action = e.target.getAttribute('data-type');
        const feedbackText = this.feedbackTextTarget;
        const feedbackCard = this.feedbackCardTarget;
        const moreText = this.moreTextTarget;
        const showButton = this.showButtonTarget;

        if (action === 'show') {
            moreText.style.display = 'inline';
            showButton.style.display = 'none';
            feedbackText.style.height = 'auto';
            feedbackCard.style.height = 'auto';
        } else if (action === 'hide') {
            moreText.style.display = 'none';
            showButton.style.display = 'inline';
            feedbackText.style.height = ''; 
            feedbackCard.style.height = '250px'; 
        }
    }
}
