// assets/controllers/lazy-example-controller.js
import { Controller } from '@hotwired/stimulus';
import {waitFor} from "@babel/core/lib/gensync-utils/async";

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = [ "links", "content", "button", "input" ]
    static values = {
        name: String
    }

    openDialog() {

        let tabsContainer = this.buttonTarget.parentElement.id;

        let dialogHtml = '<dialog id="dialog">\n' +
            '            <label id="dialogLabel" for="dialog-title">Title for ' + this.nameValue + '</label>\n' +
            '            <input type="text" id="tabTitle" name="title" data-tabs-target="input">\n' +
            '            <button type="reset" id="cancel">Cancel</button>\n' +
            '            <button id="btnAdd" data-action="tabs#addTab">Add</button>\n' +
            '            </dialog>'

        $("#" + tabsContainer ).append( dialogHtml )
        let dialog = document.getElementById('dialog')
        dialog.showModal();

        $("#cancel").on("click", () => {
            dialog.remove()
        })

        $("#btnAdd").on("click", () => {
            this.addTab()
            dialog.remove()
        })

    }

    addTab() {
        var tabName = this.nameValue;
        var tabCounter = 1;
        var tabId = 'nav-' + tabName.toLowerCase() + '-' + tabCounter + '-tab'
        var tabElement = document.getElementById(tabId);

        while (tabElement) {
            tabCounter++;
            tabId = 'nav-' + tabName.toLowerCase() + '-' + tabCounter + '-tab';
            tabElement = document.getElementById(tabId);

        }

        var tabTitle = $("#tabTitle").val() || tabCounter ;

        const tabLinkTemplateHtml = '<a ' +
            'class="nav-item nav-link" ' +
            'id="'+ tabId + '"' +
            ' data-toggle="tab" ' +
            'href=' + "#nav-" + tabName.toLowerCase() + "-" + tabCounter + " "  +
            'role="tab" ' +
            'aria-controls="nav-' + tabName.toLowerCase() + "-" + tabCounter + '" '  +
            'aria-selected="true">' +
            tabName + ' n°' + (tabTitle || tabCounter) +
            ' <button ' + 'class="btn btn-sm btn-outline-danger" ' +
            ' data-action="tabs#delTab" ' +
            'id="'+ tabName.toLowerCase() + "-" + tabCounter + '">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">\n' +
            '  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>\n' +
            '  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>\n' +
            '</svg>' +
            '</button>' +
            '</a>';


        const tabContentTemplateHtml = '<div' +
            ' class="tab-pane fade" ' +
            'id="nav-' + tabName.toLowerCase() + '-' + tabCounter + '" ' +
            'role="tabpanel" aria-labelledby="nav-' + tabName.toLowerCase() + '-'+tabCounter+'-tab">' +
            '<p class="text-muted mt-2">Fields marked with an <span style="color: red">*</span> are mandatory</p>' +
            '</div>';

        let btnId = (this.buttonTarget.id);
        $("#" + btnId).before(tabLinkTemplateHtml);

        let contentContainerId = this.contentTarget.id;
        $("#" + contentContainerId).append(tabContentTemplateHtml);

        $(".add_item_link").click();

        $("#nav-" + tabName.toLowerCase() + "-" + tabCounter + "-tab").click();

    }

    delTab() {
        let tabToDelete = (event.currentTarget).id;
        console.log(tabToDelete);
        $("#rmvBtn-" + tabToDelete).click();
        $("#nav-" + tabToDelete).remove();
        $("#" + tabToDelete).parent().remove();

    }

}