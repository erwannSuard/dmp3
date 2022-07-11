// assets/controllers/lazy-example-controller.js
import { Controller } from '@hotwired/stimulus';
import {waitFor} from "@babel/core/lib/gensync-utils/async";

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = [ "links", "content", "button", "input" ]
    static values = {
        name: String
    }

    //todo : essayer dinserer le dialog dans le formulaire et de l'ouvrir quand le bouton est cliqué
    //todo : puis lancer add tab avec la target input et retirer le dialog
    //todo : le faire que ce soit possbile pour chaque instance du controller

    openDialog() {
        let btn = this.buttonTarget.id;

        let test = this.buttonTarget.parentElement.id;
        console.log(test)

        let dialogHtml = '<dialog id="dialog">\n' +
            '            <label id="dialogLabel" for="dialog-title">Title for ' + this.nameValue + '</label>\n' +
            '            <input type="text" id="tabTitle" name="title" data-tabs-target="input">\n' +
            '            <button type="reset" id="cancel">Cancel</button>\n' +
            '            <button id="btnAdd" data-action="tabs#addTab">Add</button>\n' +
            '            </dialog>'
        $("#" + test ).append( dialogHtml )
        console.log('ok');
        let dialog = document.getElementById('dialog')
        dialog.showModal();
        this.context

        $("#cancel").on("click", () => {
            dialog.remove()
        })

        $("#btnAdd").on("click", () => {
            this.addTab()
            dialog.remove()
        })


    }

    submitDialog() {


    }


        // // console.log(this.inputTarget);
        // document.getElementById("dialogLabel").innerText = this.nameValue + ' title to add :';
        // const dialog = document.getElementById("dialog");
        // dialog.showModal();
        //
        //
        // const cancelButton = document.getElementById('cancel');
        //
        // const addButton = document.getElementById('add');
        //
        // cancelButton.addEventListener("click", () => {
        //     console.log('close btn clicked');
        //     dialog.close()
        // })
        //
        // addButton.addEventListener("click",  () => {
        //     console.log('add btn clicked');
        //     var input = document.getElementById("tabTitle");
        //     if (input.value.length > 0) {
        //         console.log('input valid');
        //         this.inputValue = input.value;
        //         this.addTab(btnid);
        //
        //
        //     }
        //     else if (input.value.length == 0) {
        //         console.log(' invalid input')
        //         alert('invalid input')
        //         console.log('essai essai')
        //     }
        // })
        // //reset
        // document.getElementById("tabTitle").value = ""
        // this.inputValue = "";
        //
        //




    addTab() {
        console.log('button target : '+ this.buttonTarget.id + ' content targer :'+this.contentTarget.id);
        var tabName = this.nameValue;
        var tabCounter = $("#" + this.linksTarget.id)[0].childElementCount;
        // var tabTitle = this.inputValue || tabCounter ;
        var tabTitle = $("#tabTitle").val() || tabCounter ;

        const tabLinkTemplateHtml = '<a ' +
            'class="nav-item nav-link" ' +
            "id=nav-" + tabName.toLowerCase() + "-" + tabCounter + "-tab " +
            'data-toggle="tab" ' +
            'href=' + "#nav-" + tabName.toLowerCase() + "-" + tabCounter + " "  +
            'role="tab" ' +
            'aria-controls="nav-' + tabName.toLowerCase() + "-" + tabCounter + " "  +
            'aria-selected="true">' +
            tabName + ' n°' + tabTitle || tabCounter +
            ' <button ' + 'class="btn btn-sm btn-outline-danger" ' +
            ' data-action="tabs#delTab" ' +
            'id='+ tabName.toLowerCase() + "-" + tabCounter + '>' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">\n' +
            '  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>\n' +
            '  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>\n' +
            '</svg>' +
            '</button>'
            '</a>'

        const tabContentTemplateHtml = ('<div' +
            ' class="tab-pane fade" ' +
            'id="nav-' + tabName.toLowerCase() + '-' + tabCounter + '" ' +
            'role="tabpanel" aria-labelledby="nav-' + tabName.toLowerCase() + '-'+tabCounter+'-tab">' +
            'content for ' + tabName + ' n°'+ tabCounter +'</div>');

        console.log('btnId: ' + btnId)
        let btnId = (this.buttonTarget.id);
        $("#" + btnId).before(tabLinkTemplateHtml);
        console.log('btnid: ' + btnId)
        let contentContainerId = this.contentTarget.id;
        $("#" + contentContainerId).append(tabContentTemplateHtml);
        $("#nav-" + tabName.toLowerCase() + "-" + tabCounter + "-tab").click();



    }

    delTab() {
        let cible = (event.currentTarget).id;
        $("#nav-" + cible).remove();
        $("#" + cible).parent().remove();

        console.log(test);
    }

    test() {
        alert('method test');
    }
}