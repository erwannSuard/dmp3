// assets/controllers/lazy-example-controller.js
import { Controller } from '@hotwired/stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = [ "links", "content", "button" ]
    static values = {
        name: String
    }

    addTab() {
        var tabName = this.nameValue;
        var tabCounter = $("#" + this.linksTarget.id)[0].childElementCount;
        var tabHref = "#nav-" + tabName.toLowerCase() + "-" + tabCounter + " ";

        console.log(tabCounter + ' tabcounter')

        var tabLinkTemplateHtml = '<a ' +
            'class="nav-item nav-link" ' +
            "id=nav-" + tabName.toLowerCase() + "-" + tabCounter + "-tab " +
            'data-toggle="tab" ' +
            'href=' + "#nav-" + tabName.toLowerCase() + "-" + tabCounter + " "  +
            'role="tab" ' +
            'aria-controls="nav-' + tabName.toLowerCase() + "-" + tabCounter + " "  +
            'aria-selected="true">' +
            tabName + ' n°' + tabCounter +
            '</a>'
        var tabContentTemplateHtml = ('<div class="tab-pane fade" id="nav-' + tabName.toLowerCase() + '-' + tabCounter + '" role="tabpanel" aria-labelledby="nav-' + tabName.toLowerCase() + '-'+tabCounter+'-tab">content for ' + tabName + ' n°'+ tabCounter +'</div>');
        console.log(tabName + ' name value');
        let btnId = this.buttonTarget.id;
        $("#" + btnId).before(tabLinkTemplateHtml);
        let contentContainerId = this.contentTarget.id;
        $("#" + contentContainerId).append(tabContentTemplateHtml);
    }
}



//     var tabsContainerName;
//
//     var tabNavId;
//
//     var tabContent;
//     var tabNum;
//
//     var btnName;
//
//     var tabRompCounter = 2;
//     var tabWpCounter = 2;
//
//     var numTabRompDeleted = [];
//     numTabWpDeleted = [];
//
//     var tabName = "";
//
//
//
//     $( "#btnAddRomp" ).on("click",function () {
//         console.log(tabNum + " btn romp del click")
//         if (!numTabRompDeleted.length) {
//             tabNum = numTabRompDeleted[0];
//             numTabRompDeleted.shift();
//             console.log(tabNum + "array pas vide")
//         } else {
//             tabNum = tabRompCounter;
//             console.log(tabNum + " array vide")
//         }
//         tabRompCounter++;
//         addTab("romp", "#btnAddRomp");
//         console.log(tabNum)
//     });
//
//     $("#btnAddWp").on("click",function () {
//         if (!numTabWpDeleted.length) {
//             tabNum = numTabWpDeleted[0];
//             numTabWpDeleted.shift();
//         } else {
//             tabNum = tabRompCounter;
//         }
//         addTab("wp", "#btnAddWp");
//         tabWpCounter++
//
//     });
//
//     // Modal dialog init: custom buttons and a "close" callback resetting the form inside
//     var dialog = $( "#dialog" ).dialog({
//         autoOpen: false,
//         modal: true,
//         buttons: {
//             Add: function() {
//                 addTab();
//                 $( this ).dialog( "close" );
//             },
//             Cancel: function() {
//                 $( this ).dialog( "close" );
//             }
//         },
//         close: function() {
//             form[ 0 ].reset();
//         }
//     });
//
//
//
//     // AddTab form: calls addTab function on submit and closes the dialog
//     var form = dialog.find( "form" ).on( "submit", function( event ) {
//         addTab();
//         dialog.dialog( "close" );
//         event.preventDefault();
//     });
//
//     // AddTab button: just opens the dialog
//     $( "#btnAddRomp" )
// .on( "click", function() {
//         dialog.dialog( "open" );
//     });
//
//     function addTab(tabName, btnName) {
//
//
//
//         tabContent = $("#nav-tabContent-" + tabName)[0];
//         // var tabNum = tab.childElementCount;
//         let tabTitle = tabName.toUpperCase();
//
//         btnDel = '<button type="button" class="btn btn-sm btn-outline-danger delete-btn" onclick="delTab(\'' + tabName + '\','+ tabNum +')"><i class="fa-solid fa-xmark-large">x</i></button>'
//
//         $( btnName ).before( '<a class="nav-item nav-link" id="nav-'+ tabName + '-' + tabNum + '-tab" data-toggle="tab" href="#nav-'+ tabName +'-'+tabNum+'" role="tab" aria-controls="nav-'+ tabName +'-'+tabNum+'" aria-selected="false">'+ tabTitle + ' n°' + tabNum +'  '+ btnDel + '</a>');
//         $( tabContent ).append('<div class="tab-pane fade" id="nav-' + tabName + '-' + tabNum + '" role="tabpanel" aria-labelledby="nav-' + tabName + '-'+tabNum+'-tab">content for ' + tabName + ' n°'+ tabNum +'</div>');
//         activeTab = $("#nav-" + tabName + "-"+ tabNum + "-tab");
//         activeTab.click();
//     }
//
//
//
//
//
//
//     function delTab(tabName, tabNum) {
//         $("#nav-" + tabName + "-" + tabNum).remove();
//         $("#nav-"+ tabName + "-" + tabNum + "-tab").remove();
//         console.log(tabRompCounter);
//         console.log(tabNum + " delTab()")
//         if (tabName == 'romp') {
//             numTabRompDeleted.push(tabNum);
//             tabRompCounter--;
//         }
//         else
//             numTabWpDeleted.push(tabNum);
//         tabWpCounter--;
//     }

