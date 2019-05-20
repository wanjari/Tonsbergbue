<?php
include ("start.html");
?>
<legend class="text-center"> <h2>Påmelding til konkurranser</h2></legend>
<?php
@$submit=$_POST ["submit"];
	if ($submit)
	{
		$ianseo=$_POST["ianseo"];
		$fornavn=$_POST["fornavn"];
		$etternavn=$_POST["etternavn"];
		$stevne_dato=$_POST["stevne_dato"];
		$klasse=$_POST["klasse"];
		$kommentar=$_POST["kommentar"];

		if(!$ianseo || !$fornavn || !$etternavn || !$stevne_dato || !$klasse)
		{
			echo ("<br/><br/>
					<div class='panel panel-danger'>
      					<div class='panel-heading'>Advarsel!</div>
      					<div class='panel-body'>Alle felt må fylles ut. </div>
    				</div>");
		}
		else
		{
			include("db-tilkobling-innlegg.php");
			$sqlSetning="INSERT INTO paamelding (ianseonr,fornavn,etternavn,klasse,stevne_dato,kommentar,registrert) VALUES ('$ianseo','$fornavn','$etternavn','$klasse','$stevne_dato','$kommentar', CURRENT_TIMESTAMP);";
			mysqli_query($db,$sqlSetning) or die ("<br/>Ikke mulig å registrere i databasen");
						
			echo ("	<div class='panel panel-success'>
    					<div class='panel-heading'>Følgende skytter ble påmeldt :</div>
      					<div class='panel-body'>
      						<strong>Ianseo nr  :</strong> $ianseo <br/> 
							<strong>Navn       :</strong> $fornavn $etternavn </br> 
							<strong>Klasse     :</strong> $klasse </br> 
							<strong>Stevne dato:</strong> $stevne_dato </br>
							<strong>Kommentar  :</strong> $kommentar
						</div>
    				</div>");
		}	
	}
							
?>

<form class="form-horizontal" action="" method="post">
 	<fieldset>
    <!-- Ianseo nr input-->
    	<div class="form-group">
       		<label class="col-md-3 control-label" for="ianseo">Ianseo nr :</label>
       		<div class="col-md-6">
           		<input  id="ianseo" name="ianseo" type="number" placeholder="1234" class="form-control" required autofocus>
       		</div>
       	</div>
  
       	<!-- Fornavn input-->
      	<div class="form-group">
      		<label class="col-md-3 control-label" for="fornavn">Fornavn :</label>
      		<div class="col-md-6">
           		<input id="fornavn" name="fornavn" type="text" placeholder="Ola" class="form-control" required>
       		</div>
       	</div>

      	<!-- Etternavn input-->
       	<div class="form-group">
      		<label class="col-md-3 control-label" for="etternavn">Etternavn :</label>
       		<div class="col-md-6">
           		<input id="etternavn" name="etternavn" type="text" placeholder="Nordmann" class="form-control" required>
       		</div>
       	</div>

       	<!-- Klasse select-->
       	<div class="form-group">
       		<label class="col-md-3 control-label" for="klasse">Klasse :</label>
       		<div class="col-md-6">
				<select class="form-control" id="klasse" name="klasse">
				   	<p>Compund</p>
					<option>C1</option>
					<option>C2</option>
					<option>C3</option>
					<option>C4 (Rekrutt)</option>
					<option>C5 (Mini junior)</option>
					<p>Recurve</p>
					<option>R1</option>
					<option>R2</option>
					<option>R3</option>
					<option>R4(Rekrutt)</option>
					<option>R5(Mini junior)</option>
					<p>Barebow</p>
					<option>B1</option>
					<option>B2</option>
					<option>B4 (Rekrutt)</option>
					<option>B5 (Mini junior)</option>
					<p>Instinkt</p>
					<option>IN1</option>
					<option>IN2</option>
					<option>IN4 (Rekrutt)</option>
					<option>IN5 (Mini junior)</option>
					<p>Langbue</p>
					<option>LB1</option>
					<option>LB2</option>
					<option>LB4 (Rekrutt)</option>
					<option>LB5 (Mini junior)</option>
					<p>Fellesklassen</p>
					<option>F6</option>
				</select>
            </div>
       	</div>

       		<!-- stevne dato input-->
       	<div class="form-group">
      		<label class="col-md-3 control-label" for="etternavn">Stevne dato :</label>
       		<div class="col-md-6">
           		<input id="stevne_dato" name="stevne_dato" type="date" class="form-control" required>
       		</div>
       	</div>
    
      	<!-- Kommentar body -->
       	<div class="form-group">
       		<label class="col-md-3 control-label" for="kommentar">Kommentar :</label>
       		<div class="col-md-6">
           		<textarea maxlength="300" class="form-control" id="kommentar" name="kommentar" placeholder="F.eks. hvilket stevne inkl dato, eventuelt spesifisert klasse, hvilken pulje, overnatting osv..." rows="6"></textarea>
   
            <!-- Form actions -->
           		<div class="col-md-12 text-right">
       			<br/>
	               	<input class="btn btn-primary btn-lg" style="width: 49%" id="submit" name="submit" type="submit" value="Registrer">
					<input class="btn btn-primary btn-lg" style="width: 49%" name="nullstill" id="nullstill"  type="reset" value="Nullstill">
	       		</div>
	       		<br/>
	       		<br/>
	       		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	       	</div>
    	</div>

    </fieldset>
</form>
<br/>


<!------------------------------- Se påmeldinger ------------------------>

<legend class="text-center"> <h2>Påmeldte skyttere</h2></legend>
<br/>

<div style="overflow-x:auto;">
<?php

	include("db-tilkobling-innlegg.php");

	$sqlSetning="SELECT * FROM paamelding ORDER BY stevne_dato DESC;";
	$sqlResultat=mysqli_query($db,$sqlSetning) or die ("Feil oppstod! Ikke mulig å hente fra databasen.");

	$antallRader=mysqli_num_rows($sqlResultat);
	
		print ("<table style='border:none;' class='table table-hover'>");
		print ("<thead><tr> <th>Ianseo nr</th> <th>Navn</th> <th>klasse</th> <th>Stevne dato</th> <th>Registrert påmeldt</th> <th>Kommentar</th> </tr></thead>");
	
		for ($r=1;$r<=$antallRader;$r++)
		{
			$rad=mysqli_fetch_array($sqlResultat);
			$ianseonr=$rad["ianseonr"];
			$fornavn=$rad["fornavn"];
			$etternavn=$rad["etternavn"];
			$klasse=$rad["klasse"];
			$stevne_dato=$rad["stevne_dato"];
			$kommentar=$rad["kommentar"];
			$dato=$rad["registrert"];
	
			print ("<tbody><tr> <td>$ianseonr</td> <td>$fornavn $etternavn</td> <td>$klasse</td> <td>$stevne_dato</td> <td>$dato</td> <td>$kommentar</td></tr>");
		}
		print ("</tbody></table>");
?>
</div>
</div>
<?php
include ("slutt.html");
?>