   // var timer=setInterval(voirNotif,5000);
    function redirection(pages)
    {
        
        top.location.href="";
    }
function voirNotif()
{
  sendData('nbre=1','ajax/notificationChange.php', 'notifications');  
}
function traitementModal(valeur,numero,demandeAchat)
{
   //      var tableda=demandeAchat.split(' ');
  //       alert(tableda.length);
    var table=valeur.split('_');
    var mail=table[1];
    var telecopie=table[2];
    var nom=table[3];
    var contact=table[4];
    var id=table[0];
   
        //contacts+=contact;
    document.getElementById('nom'+numero).value="".concat(nom);
    document.getElementById('contact'+numero).value=contact;
    document.getElementById('mail'+numero).value="".concat(mail);
    document.getElementById('telecopie'+numero).value="".concat(telecopie);
    document.getElementById('ol'+numero).value="".concat(id);
 
}
 function traitementModalInsert(numero,demandeAchat,idCotation)
{
      var idCotation=idCotation;
       var da='';
      var tableda=demandeAchat.split(' ');
      var nbre=tableda.length;
       //  alert(nbre);
      //creation des elements pour la demande
            for(var i=1;i<=nbre;i++)
         {
         
                   da+='da';
                    da+=i;
                    da+='=';
                    da+=tableda[i-1];   
                       if(i<nbre){
                                 da+='&'; 
                           }
           
             }
             da+='&';
              da+='nbre=';
              da+=nbre;
          
          
      var variableControle=document.getElementById('ol'+numero).value;
      
  var nom=document.getElementById('nom'+numero).value;
  var contact=document.getElementById('contact'+numero).value;
  var mail=document.getElementById('mail'+numero).value;
  var telecopie=document.getElementById('telecopie'+numero).value;
  var validite=document.getElementById('validite'+numero).value;
  var conditionReglement=document.getElementById('condition'+numero).value;
  var attention=document.getElementById('attention'+numero).value;
  var delaiLivraison=document.getElementById('livraison'+numero).value;
      // if(nom=="" || contact=="" mail=="" mail )
      // alert(mail);
   da+='&nom=';   
   da+=nom;
   da+='&contact=';
   da+=contact;
   da+='&mail=';
   da+=mail;
   da+='&telecopie=';
   da+=telecopie;
   da+='&validite=';
   da+=validite;
   da+='&condition=';
   da+=conditionReglement;
   da+='&attention=';
   da+=attention;
   da+='&livraison=';
   da+=delaiLivraison;
   da+='&controle=';
   da+=variableControle;
   da+='&cotation=';
   da+=idCotation;
   sendData(da,'ajax/pageEnregistrerFournisseur.php','messageErr'+numero); 
  //window.location.reload();
 document.getElementById('nom'+numero).value="";
 document.getElementById('contact'+numero).value="";
 document.getElementById('mail'+numero).value="";
 document.getElementById('telecopie'+numero).value="";
 document.getElementById('validite'+numero).value="";
 document.getElementById('condition'+numero).value="";
 document.getElementById('attention'+numero).value="";
 document.getElementById('livraison'+numero).value="";
}
function ValiderDemande(idDemaande,code,id,page,type,service,fonction,nbreArticle)
                 {
                         var valeur="";
                           valeur+="da=";
                           valeur+=idDemaande;
                           valeur+="&bor=";
                           valeur+=code;
                          var quantiteCommander='';
                          var nombreArticles=nbreArticle;
                   if(type=="valider"){
                       if(fonction=="RESPONSABLE" && service=="ACHAT ET PRODUCTION"){
                                    for(var i=1;i<=nombreArticles;i++)
         {
           if(document.getElementById('quantiterArt'+i)){
                var valeur3=document.getElementById('quantiterArt'+i).value;
                    quantiteCommander+='quantiterArt';
                    quantiteCommander+=i;
                    quantiteCommander+='=';
                    quantiteCommander+=valeur3;   
                       if(i<nombreArticles){
                                 quantiteCommander+='&'; 
                           }
               }
             }
             var idDA='';
                               for(var i=1;i<=nombreArticles;i++)
         {
           if(document.getElementById('article'+i)){
                var valeur3=document.getElementById('article'+i).value;
                    idDA+='article';
                    idDA+=i;
                    idDA+='=';
                    idDA+=valeur3;   
                       if(i<nombreArticles){
                                 idDA+='&'; 
                           }
               }
             }
                 valeur+='&';
                 valeur+=quantiteCommander;
                 valeur+='&';
                 valeur+=idDA;
                 valeur+='&';
                 valeur+='nbre=';
                 valeur+=nbreArticle;
                if(confirm("CONFIRMER LA VALIDATION")){
                    sendData(''+valeur,page,id);
                           //    alert(valeur);
                                               }

                          }
                     else{
                       //c'es que c un assistant
                        if(confirm("CONFIRMER LA VALIDATION")){
                               sendData(''+valeur,page,id);
                                               }
                       }
                 }
                 else{
             if(confirm("ANNULATION::CONFIRMER")){
                //on envoi les Donnees et on affiche la page de Annulation
                    
                     sendData(''+valeur,id,'milieu');
                     }
                 }
                 }
          function EnvoiDonnerJs(chaine,nombreDeDiv){
      //recuperation sous forme de tableau les diffrents elements envoyer
       if(chaine==".............................."){
          document.getElementById("codeArticle"+nombreDeDiv).innerHTML ='xxxxx';
          document.getElementById("codeFamille"+nombreDeDiv).innerHTML ='xxxxx';
          document.getElementById("quantiteStocks"+nombreDeDiv).innerHTML ='xxxxx'; 
          document.getElementById("unite"+nombreDeDiv).innerHTML ='xxxxx'; 
       }
           else{
         var tableauDesMots=chaine.split('$');
         var idArticles=tableauDesMots[0];
         var codeArticles=tableauDesMots[1];
         var codeFamille=tableauDesMots[2];
         var quantiteStocks=tableauDesMots[3];
         var designation =tableauDesMots[4];
         var unite =tableauDesMots[5];
      //modifier le text des variable
             document.getElementById("codeArticle"+nombreDeDiv).innerHTML =codeArticles;
             document.getElementById("codeFamille"+nombreDeDiv).innerHTML =codeFamille;
             document.getElementById("quantiteStocks"+nombreDeDiv).innerHTML =quantiteStocks;
              document.getElementById("unite"+nombreDeDiv).innerHTML =unite;
                  }
     // alert(quantiteStocks);
      // sendData('valeur=1','ajax/donnerCode.php', 'bordereaux');
   }
   function successs(){
       alert("BRAVA AFRICA");
   }
   function danser()
   {
       alert('dansons');
   }
   function EnvoiDeSaisie(donnee,id){
         //mettre ce qui etait present a vide
         //
         var element=donnee.split(' ');
           //alert(element[0]);
           //ENLEVER L'ID 
         var tailleTableau=element.length;
             element[tailleTableau-1]=' ';
             //reconstruction du de la donnee
             donnee="";
            
           for(var i=0;i<tailleTableau;i++){
              donnee=donnee.concat(element[i]+' ')  ;
             }
              document.getElementById(id).innerHTML =' ';    
         document.getElementById('datePremier').innerHTML ='<strong>'+ +'</strong>';
             if(element[0]!=='rien'){
         document.getElementById(id).innerHTML ='<strong>'+donnee+'</strong>';    
         document.getElementById('datePremier').innerHTML ='<strong>'+dateFr()+'</strong>';
           }
   }
   //sendData('valeur='+this.value,'ajax/donnerCode.php', 'bordereaux')
   function dateFr()

{
  
     // les noms de jours / mois

     var jours = new Array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");

     var mois = new Array("janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre");

     // on recupere la date

     var date = new Date();

     // on construit le message

     var message = jours[date.getDay()] + " ";   // nom du jour

     message += date.getDate() + " ";   // numero du jour

     message += mois[date.getMonth()] + " ";   // mois

     message += date.getFullYear();

     return message;

}
 function GenerateLigneTableau(){
     //  alert("RECU JS");
  sendData('valeur=2','ajax/multiplesArticles.php', 'number2');
}
 function CreerAutreFormulaire()
 {
     var nbre=document.getElementById('nbArtcle').value;
     sendData('nbre='+nbre,'ajax/multiplesArticles.php', 'tableauAgenerAvecSenData');
     
 }
 function afficherDemende(valeur,div,page)
 {
      
              sendData('valeur='+valeur,page, div);
       //(essai(valeur,'ajax/listePersonnelService.php'), 500); 
         essai(valeur,'ajax/listePersonnelService.php');
      // alert('ok');
        if(div=="bordereaux"){
      
         }
 }
   function alerts(val){
       alert(val);
   }
 function mettreMileu(valeur,page,div){
//       alert(valeur);
//       alert(page);
//        alert(div);
      sendData(''+valeur,div,page);
 }
    
 function essai(valeur,page){
 sendData('valeur='+valeur,page, 'NomPremierDemendeur');}
 function reception()
 { 
   //document.getElementById('Milieu2').innerHTML ="<img class='loader' src='img/loading-gif1.gif' width:'100' height:'100' ></img>";
   sendData('v=first','ajax/loaderAttente.php','Milieu2');
   var code=document.getElementById('champCacher2').value.toString();
   var taille=code.length;
   var InformationPersonnel=document.getElementById('NomPremierDemendeur').value;
   var nouveauCode=code.substring(3,18);
   var element=InformationPersonnel.split(' ');
           //ENLEVER L'ID 
   var tailleTableau=element.length;
   var idPersonnel=element[tailleTableau-1];
     //recuperation de l'id de service du personnel
   var IdService=document.getElementById('ServicePersonnel').value;
        var nombreArticles=document.getElementById('nbArtcle').value;  
   var dataStrings='idPersonnel='+idPersonnel+'&idService='+IdService+'&code='+nouveauCode+'&nombreArticle='+nombreArticles;
   //petit code ici pour faire patienter
         var observation='&';
         var justification='&';
         var quantiteCommander='&';
         var article='&'; 
          
         for(var i=1;i<=nombreArticles;i++)
         {
          if(document.getElementById('observation'+i)){
              var valeur1=document.getElementById('observation'+i).value;
                    observation+='observation';
                    observation+=i;
                    observation+='=';
                    observation+=valeur1;
                    if(i<nombreArticles){
                                 observation+='&'; 
                           }
           
                       }
                   }
                   for(var i=1;i<=nombreArticles;i++)
         {
             if(document.getElementById('justification'+i)){
                var valeur2=document.getElementById('justification'+i).value;
                if(valeur1=" "){
                      valeur1="Aucune";
                  }
                    justification+='justification';
                    justification+=i;
                    justification+='=';
                    justification+=valeur2;
                           if(i<nombreArticles){
                                 justification+='&'; 
                           }
                     }}
                 for(var i=1;i<=nombreArticles;i++)
         {
           if(document.getElementById('quantiteCommander'+i)){
                var valeur3=document.getElementById('quantiteCommander'+i).value;
                    quantiteCommander+='quantiteCommander';
                    quantiteCommander+=i;
                    quantiteCommander+='=';
                    quantiteCommander+=valeur3;   
                       if(i<nombreArticles){
                                 quantiteCommander+='&'; 
                           }
           }
       }
       for(var i=1;i<=nombreArticles;i++)
         {
           if(document.getElementById('article'+i)){
                var valeur4=document.getElementById('article'+i).value;
                var tab=valeur4.split(' ');
                    var element=tab[0];
                    article+='article';
                    article+=i;
                    article+='=';
                    article+=element;  
                    if(i<nombreArticles){
                                 article+='&'; 
                           }
           }}
  
         var premier=dataStrings.concat(observation);
         //var second=premier.concat(justification);
        // var tertio=quantiteCommander.concat(article);
          var finals=premier+=justification+=quantiteCommander+=article;
           // alert(final);
           sendData(finals,'ajax/traitementDemande.php','milieu');
 
 }
   function retournerListeValeurConcatener(nombreArticles,nom)
   {
         var variable='&'
        for(var i=1;i<=nombreArticles;i++)
         {
           if(document.getElementById(nom+=i)){
                var valeur4=document.getElementById(nom.concat(i)).value;
                var tab=valeur4.split(' ');
                    var element=tab[0];
                    variable+=nom;
                    variable+=i;
                    variable+='=';
                    variable+=element;  
                    if(i<nombreArticles){
                                 variable+='&'; 
                           }
           }}
       return variable;
       
   }
 function mySoNiceSound(s)
{
	var e=document.createElement('audio');
	e.setAttribute('src',s);
	e.play();
}
function envoiNombreArticle(url)
{
    var famille=parseInt(document.getElementById('famille').value, 10);
    var nbre=parseInt(document.getElementById('nombrearticless').value, 10);
      var verNbre=false;
      var verifieFamille=false;
      //alert(famille);
      if(is_int(nbre)){
          if(nbre<=0){
              alert("SVP METTEZ UNE VALEUR STRICTEMENT POSITIVE");
          }
          else{
            verNbre=true;
            }
      }
      else{
          alert("entrer un nombre entier svp");
      }
      if(famille==-1){
          alert("VEUILLEZ CHOISIR UNE FAMILLE SVP");
      }
      else{
          verifieFamille=true;
      }
      var nbres='nbre=';
      if(verifieFamille==true &&  verNbre==true){
          nbres+=nbre;
          nbres+='&famille=';
          nbres+=famille;
    sendData(nbres,url, 'positionArticles');
      }
}
 function is_int(value){
       if((parseFloat(value)==parseInt(value)) && !isNaN(value)){
           return true;
       }
       else{
           return false;
       }
   }
   function EnregistrementDesArticle(nbre,famille)
   {
     //nous allons recuperer chaque valeur et faire
  //verifier si un chmap n pas vide
  //  alert('nanou');
  var desi='';
  var code='';
   var cpt=0;
     for(var i=1;i<=nbre;i++)
      {
     var designation=document.getElementById('designationArticle'+i).value;  
         if(designation==""){
             cpt++;
         }
      }
      if(cpt==0){
     var Nbremag=document.getElementById('nbreM').value; 
        //nous allons recuperer toutes les designations suivi de leur code
        for(var p=1;p<=nbre;p++)
      {
     var designation=document.getElementById('designationArticle'+p).value;  
     var code=document.getElementById('codeArticle'+p).value; 
     var unite=document.getElementById('unite'+p).value; 
     var stocks=document.getElementById('stocks'+p).value; 

       //pour la designation
           desi+='article';
           desi+=p;
           desi+='=';
           desi+=designation;
        //pour l code
          desi+='&code';
           desi+=p;
           desi+='=';
           desi+=code;
        //pour lunite
          desi+='&unite';
           desi+=p;
           desi+='=';
           desi+=unite;
         //end of unite ,begin stocks
           desi+='&stocks';
           desi+=p;
           desi+='=';
           desi+=stocks;
         //end of stocks begin of mag quanitie
           for(var cpt=1;cpt<=Nbremag;cpt++)
           {
      var quantiteM=document.getElementById('mag'+cpt).value; 
      var idM=document.getElementById('st'+cpt).value;      
           //pour les quantite
           desi+='&quantiteM';
           desi+=p;
           desi+=cpt;
           desi+='=';
           desi+=quantiteM;
           //pour les id
           //desi+='&'; 
           
          desi+='&idM';
           desi+=p;
           desi+=cpt;
           desi+='=';
           desi+=idM;
//             if(cpt<Nbremag)
//               {
//                desi+='&'; 
//             }
           }
         
         if(p<nbre){
             desi+='&';
         }
      }
       //gestion unite 
             
       //end of unite
        desi+='&nbre=';
        desi+=nbre;
        desi+='&famille=';
        desi+=famille;
         sendData(desi,'../articles/traitementInsertion.php', 'positionArticles');
    //  alert(desi);
          }
          else{
              alert("VERIFIER TOUS VOS CHAMPS");
          }
   }
     function modifInFormation(type){
           var concate="";
         if(type=='name'){
         var nom=document.getElementById('nomM').value;  
         var prenom=document.getElementById('prenomM').value;  
         var contact=document.getElementById('contactM').value;
         var adresse=document.getElementById('adresseM').value;
         var mail=document.getElementById('mailM').value;
         
       //faire les concatenations
        concate+='nom=';
        concate+=nom;
        concate+='&prenom=';
        concate+=prenom;
        concate+='&contact=';
        concate+=contact;
        concate+='&adresse=';
        concate+=adresse;
        concate+='&mail=';
        concate+=mail;
        concate+='&name=name';
        sendData(concate,'ajax/informationPersonnel.php', 'milieu');
    }
         if(type=='log'){
          var nom=document.getElementById('login').value;  
          var pass1=document.getElementById('pass1').value;  
          var pass2=document.getElementById('pass2').value;
           if(pass1!=pass2){
              alert('LES 2 PASSWORD ENTRER SONT DIFFERENTS VEUILLEZ REESAYER');
           }
           else{
        concate+='login=';
        concate+=nom;
        concate+='&pass=';
        concate+=pass1;
         concate+='&log=log';
     sendData(concate,'ajax/informationPersonnel.php', 'milieu');
         }
     }
     }