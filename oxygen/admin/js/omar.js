// javascript Document

$(function(){// vérifier  le chargement
    // on met un écouteur d'évènement au click sur les balises"a" pour cela il faut ajouter yne classe 'supp' sur la balise
   //console.log("coucou")
  $('.supp').on("click",function(event){
       event.preventDefault();// on change le comportement par défaut.
        if(confirm('Voulez-vous effacer cette information')){// on vérifie si l'utilisateur à appuyer sur "oui"
            //alert('oui');
        var lien  = $(this).attr('href');
        window.location.href = lien;    
        }
        
    });
});
