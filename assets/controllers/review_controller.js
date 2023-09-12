import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ["toggle", "moreText", "showButton", "feedbackCard"];

    toggleText(e) {
        e.preventDefault();

        const action = e.target.getAttribute('data-type');
        const feedbackCard = this.feedbackCardTarget;
        const moreText = this.moreTextTarget;
        const showButton = this.showButtonTarget;

        if (action === 'show') {
            moreText.style.display = 'inline';
            showButton.style.display = 'none';
            feedbackCard.style.height = 'auto';
        } else if (action === 'hide') {
            moreText.style.display = 'none';
            showButton.style.display = 'inline';
            feedbackCard.style.height = ''; 
        }
    }
}
