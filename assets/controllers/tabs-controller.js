// assets/controllers/lazy-example-controller.js
import { Controller } from '@hotwired/stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = [ "links", "content", "button" ]
    static values = {
        name: String ,
        input : String
    }

    connect() {

    }

    openDialog() {
        console.log(this.buttonTarget.id);
        // console.log(this.inputTarget);
        document.getElementById("dialogLabel").innerText = this.nameValue + ' title to add :';
        const dialog = document.getElementById("dialog");
        dialog.showModal();


        const cancelButton = document.getElementById('cancel');

        const addButton = document.getElementById('add');

        cancelButton.addEventListener("click", () => {
            console.log('close btn clicked');
            dialog.close()
        })

        addButton.addEventListener("click",  () => {
            console.log('add btn clicked');
            var input = document.getElementById("tabTitle");
            if (input.value.length > 0) {
                console.log('input valid');
                this.inputValue = input.value;
                this.addTab();


            }
            else if (input.value.length == 0) {
                console.log(' invalid input')
                alert('invalid input')
                console.log('essai essai')
            }
        })
        //reset
        document.getElementById("tabTitle").value = ""
        this.inputValue = "";



    }


    addTab() {
        console.log(this.buttonTarget);
        var tabName = this.nameValue;
        var tabCounter = $("#" + this.linksTarget.id)[0].childElementCount;
        var tabTitle = this.inputValue || tabCounter ;

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