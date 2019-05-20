<?php
	include ("start.html");
?>
<legend class="text-center"> <h2>Registrer deg</h2></legend>
    <p class="text-center" style="color:red;"> OBS! gjelder kun klubbens medlemmer</p>
<?php
$registrer=$_POST["registrer"];
if ($registrer)
{
  include ("db-tilkobling-innlegg.php");

  $fornavn=$_POST["fornavn"];
  $etternavn=$_POST["etternavn"];
  $adresse=$_POST["adresse"];
  $postnr=$_POST["postnr"];
  $poststed=$_POST["poststed"];
  $fodselsdato=$_POST["fodselsdato"];
  $telefon=$_POST["telefon"];
  $email=$_POST["email"];
  $passord=$_POST["passord"];
  if (!$fornavn || !$etternavn || !$adresse || !$postnr || !$poststed || !$fodselsdato || !$telefon || !$email || !$passord)
  {

    print ("<div class='alert alert-warning alert-dismissible' role='alert'>
                <strong>OBS!</strong> Alle felt må fylles inn!
            </div>");
  }
  else
  {
    $sqlSetning="SELECT * FROM bruker WHERE username='$email';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente fra databasen. <br/>");
    
    if (mysqli_num_rows($sqlResultat)!=0)
    {
      print ("<div class='alert alert-danger alert-dismissible' role='alert'>
                  <strong>ADVARSEL!</strong> Brukeren eksisterer allerede!
              </div>");
    }
    else
      {
        $kryptertPassord=sha1($passord); /*32 tegn hex*/
        $sqlSetning=" INSERT INTO bruker (fornavn, etternavn, adresse, postnr, poststed, fodselsdato, telefon, username, password, role) 
                      VALUES ('$fornavn','$etternavn','$adresse','$postnr','$poststed','$fodselsdato','$telefon','$email','$kryptertPassord','bruker');";
        mysqli_query ($db, $sqlSetning) or die ("Ikke mulig å registrere i databasen. <br/>");

        print ("  <div class='panel panel-success'>
                    <div class='panel-heading'>Følgende bruker er registrert :</div>
                    <div class='panel-body'> 
                      <strong>Fornavn       : </strong>$fornavn <br/>
                      <strong>Etternavn     : </strong>$etternavn<br/> 
                      <strong>adresse       : </strong>$adresse<br/>
                      <strong>Postnr        : </strong>$postnr<br/>
                      <strong>poststed      : </strong>$poststed<br/>
                      <strong>Fødselsdato   : </strong>$fodselsdato <br/> 
                      <strong>Telefon       : </strong>$telefon <br/> 
                      <strong>E-postadresse : </strong>$email <br/> 
                   </div>
                 </div><br/>");
      }
  }
  
}
?>
<form class="form-horizontal" action="" method="post">
	<fieldset>
	<br/>
  
    <!--Fornavn input-->
    <div class="form-group">
     	<label class="col-md-3 control-label" for="fornavn">Fornavn :</label>
     	<div class="col-md-6">
     		<input id="fornavn" name="fornavn" type="text" placeholder="Ola" class="form-control" required autofocus>
     	</div>
    </div>

    <!-- Etternavn input-->
    <div class="form-group">
     	<label class="col-md-3 control-label" for="etternavn">Etternavn :</label>
     	<div class="col-md-6">
     		<input id="etternavn" name="etternavn" type="text" placeholder="Nordmann" class="form-control" required>
     	</div>
    </div>

    <!--Adresse input-->
    <div class="form-group">
      <label class="col-md-3 control-label" for="adresse">Adresse :</label>
      <div class="col-md-6">
        <input id="adresse" name="adresse" type="text" placeholder="" class="form-control" required >
      </div>
    </div>

    <!-- Postnr input-->
    <div class="form-group">
      <label class="col-md-3 control-label" for="postnr">Postnr :</label>
      <div class="col-md-2">
        <input id="postnr" name="postnr" type="number" placeholder="1234" class="form-control" required>
      </div>
      <label class="col-md-1 control-label" for="poststed">Poststed</label>
      <div class="col-md-3">
        <input id="poststed" name="poststed" type="text" placeholder="Tønsberg" class="form-control" required>
      </div>
    </div>

    <!-- Telefon input-->
    <div class="form-group">
     	<label class="col-md-3 control-label" for="telefon">Telefon :</label>
     	<div class="col-md-6">
     		<input id="telefon" name="telefon" type="number" placeholder="123 45 678" class="form-control" required>
     	</div>
    </div>

    <!-- Fødselsdato input -->
    <div class="form-group">
     	<label class="col-md-3 control-label" for="fodselsdato">Fødselsdato :</label>
     	<div class="col-md-6">
     		<input id="fodselsdato" name="fodselsdato" type="date" class="form-control" required>
     	</div>
    </div>

    <!-- e-post input-->
    <div class="form-group">
    	<label class="col-md-3 control-label" for="email">E-postadresse :</label>
    	<div class="col-md-6">
     		<input id="email" name="email" type="email" placeholder="eksempel@domain.no" class="form-control" required>
    	</div>
    </div>

    <!-- passord input-->
    <div class="form-group">
    	<label class="col-md-3 control-label" for="passord">Passord :</label>
    	<div class="col-md-6">
     		<input id="passord" name="passord" type="password" placeholder="passord" class="form-control" required> 
    		<div class="col-md-12 text-right">
          <br/>
     			<input class="btn btn-primary btn-lg" style="width: 49%" id="registrer" name="registrer"  type="submit" value="Registrer"/>
					<button class="btn btn-primary btn-lg" style="width: 49%" name="nullstill" id="nullstill"  type="reset">Nullstill</button>
 				</div>
 			</div>
  	</div>
  </fieldset>
</form>
</div>
<?php
	include ("slutt.html");
?>