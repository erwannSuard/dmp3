/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
import {findLast} from "core-js/internals/array-iteration-from-last";






//numéro de l'onglet de depart
let navNum = 1;

//ajoute un wp a la collectionholderclass
const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
    let navLink = document.getElementById("nav-wp-" + navNum)
    const item = document.createElement('div');

    item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(/__name__/g,
            collectionHolder.dataset.index
        );
    addTagFormDeleteLink(item);

    navLink.appendChild(item);

    collectionHolder.dataset.index++;

    navNum++;
    console.log(navNum);
}

//ajoute un bouton rmove au wp
const addTagFormDeleteLink = (item) => {
    const removeFormButton = document.createElement('button');

    removeFormButton.innerText = 'Delete this WP';
    removeFormButton.id = 'rmvBtn-wp-'+navNum;
    removeFormButton.classList.add("v-hidden")

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        item.remove();
        navNum--
    });

}

//onClick ajoute a wp
document.querySelectorAll('.add_item_link').forEach(btn => {
    btn.addEventListener('click', addFormToCollection)
});



document
    .querySelectorAll('ul.idRefProject li')
    .forEach((idRefProject) => {
        addTagFormDeleteLink(idRefProject)
    })


