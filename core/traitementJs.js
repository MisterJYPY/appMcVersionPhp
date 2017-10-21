function changerValeur(){
}

function Reconstituer(appui,NombreDeDivPourLeType,type,rang){
          //alert(appui+'djjf'+compteurGlobal);
      //first step :we sendata one file
       var tableauDesIdCoches=[];
        var indiceDuTableau=0;
      var id="selects"+appui;
      var app=appui;
      var totalSelect=appui+NombreDeDivPourLeType;
          var compteur=appui+1;
           //  alert('total: '+totalSelect+' compteur: '+compteur+' rang: '+rang);
             // alert(compteur+" gnlo "+compteurGlobal);
          // alert(compteurGlobal+" appui: "+appui);
              if(NombreDeDivPourLeType>1 && compteur<=(appui-rang+NombreDeDivPourLeType)){
              app=app+1;
           var opt="option"+app;
           var ids="selects"+app;
           var idInitail="selects"+appui;
           var idSelectionne=document.getElementById(id).value;
          // alert(idSelectionne);
          //desactivation du second pour ne pas creer des emerdes
             var debutDesDiv=(appui-rang)+1;
             var finDesDiv=appui-rang+NombreDeDivPourLeType;
             // alert("debut : "+(debutDesDiv)+" fin: "+finDesDiv+" rang: "+rang+ "appui: "+appui);
              for(var i=debutDesDiv;i<=finDesDiv;i++){
                      idInitail="selects"+i;
                       if(document.getElementById( idInitail).value!='...'){
                   var elementSelectionne=document.getElementById( idInitail).value;   
                    tableauDesIdCoches[indiceDuTableau]=elementSelectionne;
                    indiceDuTableau++;}
                    }
          //alert(document.getElementById(opt).value);
                          var tailleDuTableau=tableauDesIdCoches.length;
                           var param="";
                           var pa="";
                           var com="&";
                          //  alert("taile table"+tailleDuTableau);
                          //creation des elements pour l'envoi dynamique avec le sendata
                          for(var p=1;p<=tailleDuTableau;p++){  
                           pa="param"+p+"="+tableauDesIdCoches[p-1];
                             param=param.concat(pa);
                      // param.concat(pa);
                         if(p<tailleDuTableau){
                                  param=param.concat(com); 
                            }
                           //  alert(pa);
                          }
                            //alert(param);
           var idOpt="option"+appui;
               // alert(idOpt);
           document.getElementById(ids).disabled=this.selected;
    sendData('var='+idSelectionne+'&type='+type+'&'+param+'&tailleTableau='+tailleDuTableau, 'ajax/listeAcHoisirRetrait.php',ids);
                     }
               else{
                   var opt="option"+app;
                     id=+appui;
                   // alert("FIN");
                          }
   
}
function recuperationDesElementsDejaSelectionnes(appui,NombreDeDivPourLeType,type,rang){
    
    
        }
function afficherLesChamps(nombreDeDiv){
       // alert(nombreDeDiv);
     var xy="";
          var id="select";
          var cocher="materielCocher";
          var cochers="materielCochers";
          var elementSelectionner="";
            var compteurDesLignesCoches=0;
        for(var i=1;i<=nombreDeDiv;i++){
              cocher=cocher+i;
                 id=id+i;
      // alert(cocher+" est selectionne "+document.getElementById(id));
             if(document.getElementById(cocher).checked){
                compteurDesLignesCoches++;  
                   }
               cocher="materielCocher";
               id="select";
        }
        
          if(compteurDesLignesCoches>1){
              alert("VOUS NE DEVREZ QUE COCHEZ UNE SEULE LIGNE ");
          }
          else if(compteurDesLignesCoches==0){
              alert("VOUS DEVREZ COCHEZ UNE LIGNE ");
            }
                else{
                    //recupere l'id cocher
               for(var i=1;i<=nombreDeDiv;i++){
              cocher=cocher+i;
                
                  // alert(cocher+" est selectionne "+document.getElementById(id));
             if(document.getElementById(cocher).checked){
                elementSelectionner=cocher; 
                   }
               cocher="materielCocher";
        }
           //verification des champs selectionnes
                var indiceSelectionne=elementSelectionner.substring(14,15);
                var debut=document.getElementById("debut"+indiceSelectionne).value;
                var fin=document.getElementById("fin"+indiceSelectionne).value;
            //  alert(debut+" "+fin);
           //verification si tous a ete selectionnee du cote de la ligne prise
             var lesSelectionnee=0;
               cocher="select";
                for(var i=debut;i<=fin;i++){
                     // alert(document.getElementById(cocher+i));
          if(document.getElementById(cocher+i).value=='...'){
                     lesSelectionnee++;
                 }       
                cocher="select";
         } 
           if(lesSelectionnee>0){
              //verification des champs identiques pour eviter de refaire a nouveau
               var indiceTBC=0;
               var tableauComparaison=[];
               var tableauDeSomme=[];
               var indicetableauSomme=0;
          //intialistion des elements du Tableau du materiel Choisi
                    var tableaup=[];
             
           
      
              if(confirm("VOUS N'AVEZ PAS SELECTIONNER TOUS LE MATERIEL,VOULEZ VOUS CONTINUEZ ?")){
            //remplissage du tableau pour verifier si il comporte n fois une meme occurence
                        for(var i=debut;i<=fin;i++){
             if(document.getElementById(cocher+i).value!='...') {               
                        tableaup[i]=document.getElementById(cocher+i).value;
                     }    
                 }
                 //verification 
                 
              for(var i=1;i<=tableaup.length;i++){
                var s=""+(i);
               
            for(var j=i+1;j<=tableaup.length;j++){
                if(i!=j && tableaup[i]==tableaup[j] ){
                     
                   s=s+" et "+j;
                }
                if(s!=""+i ){             
                tableauComparaison[indiceTBC]="{"+s+"}";
             }
            }
            indiceTBC++;
                 }
              if(tableauComparaison.length>0){
               alert ("ATTENTION Materiels suivants Identiques :"+tableauComparaison +" ")
                 }
               else{
                 //ici le sendata avec les valeurs du tableau
           // sendData('id=1&lien=1','contenus/traitementRetrait.php','resultatAff');
             alert('OOOOOKKKKKKKKKKKK');
                   }
              }
                else{
                   alert("OK REESSAYER ALORS");    
                }
                   }
                   else{
                for(var i=1;i<=tableaup.length;i++){
                var s=""+(i);
               
            for(var j=i+1;j<=tableaup.length;j++){
                if(i!=j && tableaup[i]==tableaup[j] ){
                     
                   s=s+" et "+j;
                }
                if(s!=""+i ){             
                tableauComparaison[indiceTBC]="{"+s+"}";
             }
            }
            indiceTBC++;
                 }
              if(tableauComparaison.length>0){
               alert ("ATTENTION Materiels suivants Identiques :"+tableauComparaison +" ")
                 }
               else{
                 //ici le sendata avec les valeurs du tableau    
                  //sendData('id=1&lien=1','contenus/traitementRetrait.php','resultatAff');
                  alert('OOOOOKKKKKKKKKKKK');
                   //alert('ok allons y')
                   }}}}
 $(function(){
     $("#formulaire_retrait").submit(function(){
//          var indice=document.getElementById("indice").value;
//          afficherLesChamps(indice);   
                alert("Mr KAKOU");
     })
 });