



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
        removeFormButton.id = 'rmvBtn-wp-' + navNum;
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

$("#project_submit").hide()

// btn next project a romp
    $("#nextROMP").on("click", () => {
        $("#v-pills-romp-tab").click()
    })
// btn next romp a wp
    $("#nextWP").on("click", () => {
        $("#v-pills-wp-tab").click()
    })





$("#v-pills-project-tab").on("click" , () => {
    $("#project_submit").hide()
})

$("#v-pills-wp-tab").on("click" , () => {
    if (document.getElementById('nav-wp-1-tab')) {
        alert('exist')
        $("#project_submit").show()
    }
    else {
        console.log("test")
        $("#btnAddWp").click()
        $("#project_submit").show()
    }
})

