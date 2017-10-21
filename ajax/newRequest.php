  <?php
     header('Content-type:text');
      include_once '../core/config.php';
          // echo realpath("../ajax/newRequest.php");
      sessionUser::verification("comptes_personnel","login","password","pageSecure.php");
              if(isset($get['stop']) and $get['stop']==md5(base64_encode('couper'))){
                  sessionUser::stop("pageSecure.php");
                  }?>
    <body class="wrapper">
	  
        <div class="container" id="conteneur">
           <head class='row parie1'>
           <div class="col-xs-3 col-md-3 col-lg-2 logo"><img src="img/LogoMc.jpg" class="imageMc" alt="NotreLogo"></div>
            <div class="col-xs-4 col-md-6 col-lg-8">
                   <table class='table table-bordered'>
                       <thead>
                           <tr>
                               <th><p class="center-block TitreFeuille">FICHE DE DEMANDE D'ACHAT </p>
                       </th>
                           </tr>
                       </thead> 
                   </table>
            </div>
            <input type="hidden"  id="champCacher" value="N°:Aucun">
            <div class="col-xs-4 col-md-3 col-lg-2"><P>Date: <?php echo date("Y-m-d"); ?>
                      </p><p id='bordereaux'>N°:<Strong >Aucun</strong></p>
            </div>
           
          </head>
            <div class='row'>
            </div>
            <div class='row partie2'>
                <div  class='col-lg-8'>
                    <form id="" methode="POST" action="#">
                 <div class="form-group-sm">
                   <div class="row">
                        
                        <div class="col-md-3"><label for="ServiceDemandeur"><i class="icon-lock"></i> <b>Service:</b></label>  </div>
                        <div class="col-md-4"> <select class="input-sm" id="ServicePersonnel" onchange="afficherDemende(this.value,'bordereaux','ajax/donnerCode.php')">
                                <option value="rien">.......................................................................</option>
                       <?php
                               
                             echo genererListeDeroulante("services","designation");
                          ?>
                                 
                            </select></div>
                   </div>
                </div>  
                <div class="form-group-sm">
                   <div class="row">
          <div class="col-md-3"><label for="NomDemandeur"><i class="icon-lock"></i> <b>Nom et Prenom(s):</b></label>  </div>
          <div class="col-md-5">   <select class="input-sm" id="NomPremierDemendeur"  onchange="EnvoiDeSaisie(this.value,'nomPremier')">
                <option value="rien">.......................................................................</option>
                     <?php   
                       
                             
                       //  echo genererListeDeroulante("services","designation");
                                
                                 
                      //   include_once '..core/classes/modelArticles.php';
                     //   include_once '..core/classes/modelPersonnel.php';
                    
                          ?>
                
            </select>
                   </div>
                   </div>
                </div> 
                        <p>    </p>
                   
                   
                </div>
             
                <div  class='col-lg-offset-4 col-lg-5 col-lg-offset-4 NbreArticles'>Nbre Articles:<input type="number" value="1" id="nbArtcle" class="input-sm"> <a href="#" onclick="CreerAutreFormulaire()">Generer</a></div>
            </div>    

        <div class='row partie3'>
               <div  class=' col-xs-12 col-lg-12 col-md-12 col-sm-12  table-responsive ' id="tableauAgenerAvecSenData"> 
                    <table class='table table-bordered'>
                   <thead>
<tr class=''>
      <th class="10p">N°</th>
      <th class="10p">code article</th>
      <th class="60p">code Famille</th>
      <th class="10p">Qté cmdé</th>
      <th class="10p">Unité</th>
      <th class="10p">Stocks Theo</th>
      <th class="60p">designation</th>
      <th class="10p">Observation</th>
      <th class="10p">Justificatifs</th>
</tr>
                   </thead>
                   <div id='corpsTableauArticles'>
<tbody>
<div id="number1">
    <tr class='tab-content' >
        <td>1</td>
        <td id="codeArticle1">xxxxxxxx</td>
        <td id="codeFamille1">xxxxxxx</td>
        <td><input type="number" id="quantiteCommander1"  placeholder="Qté Souhaite"></td>
        <td id="unite1">xxxx</td>
        <td id="quantiteStocks1">xxxx</td>
        <td><select class="input-sm"  id="article1" onchange="EnvoiDonnerJs(this.value,1)">
                <option>..............................</option>
                     <?php     
                      
                       $listeDesFamilles=  modelArticle::ListeDesFamilles();
                     for ($i=0;$i<count($listeDesFamilles);$i++){
                          ?>
                <optgroup label="<?php echo html_entity_decode($listeDesFamilles[$i]->getDesignation()); ?>"> 
                    <?php
       $listeArticle= modelArticle::ListeDesArticlesPourUneFamille($listeDesFamilles[$i]);
           if(count($listeArticle)):
            for($p=0;$p<count($listeArticle);$p++):
           $quantite=  modelArticle::Stocksarticle($listeArticle[$p]);
          
   ?>
                    <option value="<?php echo $listeArticle[$p]->getId().'$'.$listeArticle[$p]->getCode().'$'.$listeDesFamilles[$i]->getCode().'$'.$quantite.'$'.$listeArticle[$p]->getDesignation().'$'.$listeArticle[$p]->getUnite(); ?>" > 
                        <?php echo html_entity_decode($listeArticle[$p]->getDesignation()); ?> </option> 
       <?php endfor;
       endif; ?>
   </optgroup> 
                          <?php
                          } 
                          ?>
                
            </select></td>
            <td><textarea type="text"   id="observation1" placeholder="ici votre Observation"></textarea></td>
            <td><textarea type="text"   id="justification1" placeholder="ici votre justificatif"></textarea></td>
    </tr>
       
    </div>

</tbody>
                   </div>
                </table></div>
            </div> 
          <div class="row">
          <div class="col-lg-12 center-block" id="Milieu2" style="width:'100';height:'100';text-align:center">
             </div>
          </div>
            <div class='row partie4'>
                <div  class='col-xs-12 col-lg-12 col-md-12 col-sm-12'>
                        <table class='table table-bordered'>
                   <thead>
</thead>
<tbody>
    <tr class='tab-content'>
        <td>
            <p><strong>NOM</strong></p>
            <p><strong>+</strong></p>
            <p><strong>VISA</strong></p>
        </td>
        <td class="ChampSignaturenewRequest">
            <p id="nomPremier"><strong></strong></p>
              <p id="datePremier"></p>  
        </td>
        <td class="ChampSignaturenewRequest">
               <p>          </p>
               <p>          </p>    
        </td >
        <td class="ChampSignaturenewRequest">
               <p>         </p>
               <p>         </p>  
        </td>
       
        <td class="ChampSignaturenewRequest">
            <p> <strong>NON VALABLE POUR<strong></p>
                        <p><strong>UNE COMMANDE A UN</strong></p> 
                        <p><strong>FOURNISSEUR</strong></p>
        </td>
         <td class="ChampSignaturenewRequest">
             <p></p>
               <p></p> 
        </td>
    </tr>
</tbody>
                </table> 
                    
                </div>
            </div>   
            <div class='row partie5'>
                <div  class='col-xs-offset-8 col-lg-offset-8 col-md-offset-8 col-sm-offset-8 col-xs-4 col-lg-4 col-md-4 col-sm-4'>
                    <input type="button" class="btn-sm " onclick="reception()" value="Valider"></input></div>
            </div>   
        </div>
        </form>
    </body>
   
     