<!DOCTYPE html>
<html lang="fr">
    <head>
         <?php
            include_once 'head.php';
            ?>
    <body>
        <div class="container">
           <head class='row parie1'>
           <div class="col-xs-3 col-md-3 col-lg-2 logo"><img src="img/LogoMc.jpg" class="imageMc" alt="NotreLogo"></div>
            <div class="col-xs-4 col-md-6 col-lg-8">
                   <table class='table table-bordered'>
                       <thead>
                           <tr>
                               <th><p class="center-block TitreFeuille">FICHE DE DEMANDE D'ACHAT</p>
                   
                       </th>
                           </tr>
                       </thead> 
                   </table>
            </div>
            <div class="col-xs-4 col-md-3 col-lg-2"><P>date du <?php echo date("Y-m-d"); ?>
                </p><p>N°:<Strong>BFtdf043531</strong></p>
            </div>
          </head>
            <div class='row'>
            </div>
            <div class='row partie2'>
                <div  class='col-lg-8'>
                    <form>
                <div class="form-group-sm">
                   <div class="row">
                        <div class="col-md-3"><label for="NomDemandeur"><i class="icon-lock"></i> <b>Nom et Prenom(s):</b></label>  </div>
                        <div class="col-md-5"> <input style="color: blue;" class="form-control" id="entre" value="" type="text" required="true"></div>
                   </div>
                </div> 
                        <p>    </p>
                     <div class="form-group-sm">
                   <div class="row">
                        <div class="col-md-3"><label for="ServiceDemandeur"><i class="icon-lock"></i> <b>Service:</b></label>  </div>
                        <div class="col-md-4"> <select class="input-sm">
                                <option>......</option>
                                <option>RHCOM</option>
                                <option>COMPTA</option>
                                <option>LOGISTIQUE</option>
                                <option>ACHAT et prod</option>
                                 
                            </select></div>
                   </div>
                </div>
                   
                </div>
                <div  class='col-lg-offset-3 col-lg-6 col-lg-offset-3'>nombre article :<input type="number" class="input-sm"> <a href="#"><button>Generer</button></a></div>
            </div>    

           <div class='row partie3'>
                <div  class='col-xs-offset-1 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-8 col-lg-10 col-md-10 col-sm-10 col-xs-offset-1 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 table-responsive'> 
                    <table class='table table-bordered'>
                   <thead>
<tr class=''>
      <th class="10p">N°</th>
      <th class="10p">code article</th>
      <th class="60p">code Famille</th>
      <th class="10p">Qté cmdé</th>
      <th class="10p">Stocks Theo</th>
      <th class="60p">designation</th>
      <th class="10p">Observation</th>
      <th class="10p">Justificatifs</th>
</tr>
                   </thead>
<tbody>
    
    <tr class='tab-content'>
        <td>1</td>
        <td>003DDT</td>
        <td>Mami</td>
        <td>34</td>
        <td>4</td>
        <td>Tabac A rechange pour Pieces</td>
        <td>bien</td>
        <td>manque a lusine</td>
    </tr>
    
</tbody>
                </table></div>
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
        <td>
              <p>nom du demandeur</p>
               <p>date de vali</p>  
        </td>
        <td>
               <p>nom C.service</p>
               <p>date vali</p>    
        </td>
        <td>
               <p>nom 2.RspoAchat</p>
               <p>date vali</p>  
        </td>
       
        <td>
            <p> <strong>NON VALABLE POUR<strong></p>
                        <p><strong>UNE COMMANDE A UN</strong></p> 
                        <p><strong>FOURNISSEUR</strong></p>
        </td>
         <td>
             <p>nom RspoAchat</p>
               <p>date vali</p> 
        </td>
    </tr>
</tbody>
                </table> 
                    
                </div>
            </div>   
            <div class='row partie5'>
                <div  class='col-xs-offset-8 col-lg-offset-8 col-md-offset-8 col-sm-offset-8 col-xs-4 col-lg-4 col-md-4 col-sm-4'> <input type="submit" class="btn-sm"></input></div>
            </div>   
        </div>
        </form>
    </body>
</html>