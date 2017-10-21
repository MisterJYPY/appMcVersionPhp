 
<body class="wrapper">
                   <script type="text/javascript" > 

$('body').css("margin-top","-1000000px"); 
$('body').prepend("<div id='wait' style='position:absolute;width:220px;top:40%;left:40%;text-align:center;font-weight:bold;' >Chargement en cours . . .<br/><img src='./img/chargement.gif' ></img></div>"); 

function body_ready(){$('body').css('margin-top','');$('#wait').css('display','none');} 
$(document).ready(function(){body_ready();}); 

</script>       
    <div class="container">
        <div class="row">
            <div class="col-lg-12 arrondiCentre">
             <table class="table center col-lg-12 tableau1P table-responsive">
                    <tr class="">
                     <td class="Recap1"  > <strong>RECAPITULATIFS DE VOS DIFFERENTES INFORMATIONS</strong> </td>
                    </tr>
                </table>
                <table class=" col-lg-12 center tableauPresentation table-hover">
                      
                 <tr class="recapitulatif" >
                    
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <strong class="indicatif" >Nom: <strong class="rouge" style="margin-left:5px;"><?php echo $_SESSION['nom'] ;?></strong></strong> 
                        </td>
                        
                      <td style="text-align:center;">
                            <strong class="indicatif">Service:<strong class="rouge" style="margin-left:5px;"><?php echo $_SESSION['Nomservice'] ;?></strong></strong> 
                        </td>
                        
                       
                        
                    </tr>
                    <tr style="text-align:center;">
                         <td >
                            <strong class="indicatif">Prenom(s): </strong><strong class="rouge" style="margin-left:5px;"><?php echo $_SESSION['prenom'] ;?> </strong> 
                        </td>
                        
                        
                         <td >
                            <strong class="indicatif">Poste Occupé:</strong>  <strong class="rouge" style="margin-left:5px;"><?php echo $_SESSION['fonction'] ;?></strong>
                        </td>
                    </tr>
                    
                </table>
                  
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php 
//                $sql="SELECT * FOM personnel ";
//                 $table=new Tableau($sql, "LISTE DE TOUS LE PERSONNEL");
//                echo $table->leTableau;
//             $entete=array("nom"=>"Nom","prenoms"=>"Prenom");
//   
//    $listeEnseignant = new Tableau("SELECT * FROM personnel", "Liste Personnel",$entete);
//    echo  $listeEnseignant->leTableau;
                ?>
            </div>
            
        </div>
        
        
    </div>
    
    
    
    
    
    
    
    
</body>