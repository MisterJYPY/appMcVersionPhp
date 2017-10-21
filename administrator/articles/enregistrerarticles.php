 <?php
      //header('Content-type:text');
        include_once '../../core/config.php';
      //  include_once '../../core/classes/modelPersonnel.php';
        ?>
<body >
    <div id="page-wrapper">
      <div class="row">
       <div class=" col-lg-offset-2 col-lg-4 ">
         <label for="noms">Familles:</label>
         <select class="form-control" id="famille" 
          onchange="">
             <option value="-1"></option>
   <?php echo genererListeDeroulante("famille","designation");?>
   </select>
          </div>
          <div class=" col-lg-4 ">
     <label for="noms">nombre Articles:</label>
     <input type="number" class="form-control input-sm" id="nombrearticless" placeholder='nbre Artcle'>
          </div>
          </div>
         <div class="row">
            <div class="col-lg-offset-6  col-lg-3 ">
<button type="submit" value="generer" class="btn btn-default btn-success" onclick="envoiNombreArticle('../articles/formulairesarticles.php')" value='Enregistrer'>Submit</button>
          </div>
    </div>
        <div id="positionArticles">
         
        </div>
        </div>
     
</body>