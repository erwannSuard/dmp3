// assets/controllers/lazy-example-controller.js
import { Controller } from '@hotwired/stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = [ "input" ]

    tabNaming() {
        console.log('enter in method tab naming');
        this.dispatch("tabNaming", { detail: { content: this.inputTarget.value } })
        this.inputTarget.select()
        console.log(this.inputTarget.value + " du controller dialog ");
        const tabsController = this.application.getControllerForElementAndIdentifier(this.tabsTarget, 'other')
        tabsController.addTabMethod()
    }
}