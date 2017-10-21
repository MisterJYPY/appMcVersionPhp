  <?php
     header('Content-type:text');
      include_once '../core/config.php'
  ?>
<body class="wrapper">
<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form action='#'>
			<h2>Veuillez <small>Remplir ces differents champs</small></h2>
			<hr class="colorgraph">
                        <div class="row">
				<div class="col-xs-10 col-sm-9 col-md-9">
					<div class="form-group">
     <input type="text"  id="login" class="form-control input-lg" value="<?php echo $_SESSION['login'];  ?>" tabindex="4" 
                                                   onkeyup="sendData('login='+this.value,'ajax/verificationLogin.php','Notif')">
					</div>
				</div>
				<div class="col-xs-2 col-sm-3 col-md-3">
					<div class="form-group" id="Notif">
				             
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
				<input type="password" id="pass1" class="form-control input-lg" value="" placeholder="Entrer le Password" tabindex="5">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
				<input type="password" id="pass2" class="form-control input-lg" placeholder="Confirmer le Password" tabindex="6">
					</div>
				</div>
			</div>
                         <div class="form-group">
                             <button type="submit" class="btn-dark" onclick="modifInFormation('log');" >Modifier</button>
			</div>
			<hr class="colorgraph">
		</form>
	</div>
</body>