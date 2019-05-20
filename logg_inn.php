<?php
	include ("start.html");
?>  
	<form class="form-horizontal"  method="POST" action="" id="loggInn" name="loggInn" >
		<fieldset>
    	<legend class="text-center"> <h2>Logg inn</h2></legend>
    
     	<!-- Ianseo nr input-->
     	<div class="form-group">
     		<label class="col-md-3 control-label" for="E-postadresse">E-postadresse :</label>
     		<div class="col-md-6">
       		<input id="username" name="username" type="email" placeholder="E-postadresse" class="form-control" required autofocus>
     		</div>
     	</div>

		  <!-- Ianseo nr input-->
      <div class="form-group">
      	<label class="col-md-3 control-label" for="Passord">Passord :</label>
      	<div class="col-md-6">
       		<input id="password" name="password" type="password" placeholder="passord" class="form-control" required>
       		<div class="col-md-12 text-right">
	       		<br/>
		       	<input class="btn btn-primary btn-lg" style="width: 49%" id="login" name="login"  type="submit" value="Logg inn" />
			      <input class="btn btn-primary btn-lg" style="width: 49%" name="nullstill" id="nullstill"  type="reset" value="Nullstill"/>
	       	</div>
	     	</div>
      </div>
      <p style="color: red;"> OBS! husk å skille mellom store og små bokstaver på E-postadressen og passordet! </p>
  </fieldset>
</form>
<?php
$username=$_POST['username'];
$password=sha1($_POST['password']);

$login=$_POST['login'];
if(isset($login)){
  include 'db-login.php';
  $res = $mysqli->query("SELECT * FROM bruker where username='$username' and password='$password'");
  $row = $res->fetch_assoc();
  $name = $row['fornavn'];
  $user = $row['username'];
  $pass = $row['password'];
  $type = $row['role'];
  if($user==$username && $pass=$password){
    session_start();
    if($type=="admin"){
      $_SESSION['username']=$user;
      $_SESSION['mysesi']=$name;
      $_SESSION['mytype']=$type;
      echo "<script>window.location.assign('admin/innlegg.php')</script>";
    } else if($type=="bruker"){
      $_SESSION['username']=$user;
      $_SESSION['mysesi']=$name;
      $_SESSION['mytype']=$type;
      echo "<script>window.location.assign('bruker/hoved.php')</script>";
    } else{
?>
<div class="alert alert-warning alert-dismissible" role="alert">
  <strong>OBS!</strong> Alle felt må fylles inn!
</div>
<?php
    }
  } else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <strong>ADVARSEL!</strong> Feil brukernavn eller passord!
</div>
<?php
  }
}
?> 
</div>
<?php
	include ("slutt.html");
?>