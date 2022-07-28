// ----------------------------- Section : Afficher ou non le formulaire Cost
var costField = document.getElementById("costField");
costField.classList.add("cache");


function startCost()
{
  document.getElementById("research_output_costs").addEventListener("change", checkIfCost, false);
}

function checkIfCost()
{
  var selectCost = document.getElementById("research_output_costs").value;
  if (selectCost == false && costField.classList.contains("cache"))
  {
    costField.classList.remove("cache");
  }
  else
  {
    costField.classList.add("cache");
    // Rajouter de quoi vider les inputs ? (Ou alors je gère dans le controlleur pour ne rien lier au RO)
  }
}
// ----------------------------- Fin section

// ----------------------------- Section : Afficher ou non le formulaire Vocabulary
var vocabField = document.getElementById("vocabField");
function startVocab()
{
  document.getElementById("research_output_vocabulary").addEventListener("change", checkIfVocab, false);
}

function checkIfVocab()
{
  var selectVocab = document.getElementById("research_output_vocabulary").value;
  if (selectVocab == true && costField.classList.contains("cache"))
  {
    vocabField.classList.remove("cache");
  }
  else
  {
    vocabField.classList.add("cache");
  }
}
// ----------------------------- Fin section


// ----------------------------- Section : Afficher Data ou Service
var serviceForm = document.getElementById("serviceField");
var dataForm = document.getElementById("dataField");
serviceForm.classList.add("cache");
function startDataOrService()
{
  document.getElementById("research_output_type").addEventListener("change", checkIfDataOrService, false);
}

function checkIfDataOrService()
{
  var roType = document.getElementById("research_output_type").value;
  if (roType == "dataSet") // Si Data
  {
    dataField.classList.remove("cache");
    serviceField.classList.add("cache");
  }
  else  // Si service
  {
    dataField.classList.add("cache");
    serviceField.classList.remove("cache");
  }
}
// ----------------------------- Fin section

 // // ----------------------------- Section : Afficher ou non embargo
 //  var embargoField = document.getElementById("embargoField");
 //  embargoField.classList.add("cache");
 //  function startEmbargo()
 //  {
 //    document.getElementById("distribution_access").addEventListener("change", checkIfEmbargo, false);
 //  }
 //
 //  function checkIfEmbargo()
 //  {
 //    var selectEmbargo = document.getElementById("distribution_access").value;
 //    if (selectEmbargo == "embargo" && embargoField.classList.contains("cache"))
 //    {
 //      embargoField.classList.remove("cache");
 //    }
 //    else
 //    {
 //      embargoField.classList.add("cache");
 //      // Rajouter de quoi vider les inputs ? (Ou alors je gère dans le controlleur pour ne rien lier au RO)
 //    }
 //  }
// ----------------------------- Fin section




  window.addEventListener("load", startCost, false);
  window.addEventListener("load", startDataOrService, false);
  // window.addEventListener("load", startEmbargo, false);
  window.addEventListener("load", startVocab, false);

  const addVocabToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

    const item = document.createElement('li');

    item.innerHTML = collectionHolder
      .dataset
      .prototype
      .replace(/__name__/g,
        collectionHolder.dataset.index
      );

    collectionHolder.appendChild(item);

    collectionHolder.dataset.index++;

  }
  //onClick
  document.querySelectorAll('.add_item_linkVocab').forEach(btn => {
    btn.addEventListener('click', addVocabToCollection)
  });





  const addDistribToCollection = (e) => {


    const collectionHolderDistrib = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

    const item = document.createElement('li');

    item.innerHTML = collectionHolderDistrib
      .dataset
      .prototype
      .replace(/__name__/g,
        collectionHolderDistrib.dataset.index
      );
    collectionHolderDistrib.appendChild(item);

    collectionHolderDistrib.dataset.index++;
  }
  //onClick
  document.querySelectorAll('.add_item_linkDistrib').forEach(btn => {
    btn.addEventListener('click', addDistribToCollection)
  });
