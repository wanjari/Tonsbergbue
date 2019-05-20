<?php
include ("start.html");
?>
<script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>
<!-- ----------------------- Laste opp nytt innlegg -------------------- -->
<legend class="text-left"> <h2 style="font-weight: bold;">Last opp et nytt innlegg</h2></legend>

<?php
	
	include("db-tilkobling-innlegg.php");
	@$publiser=$_POST ["publiser"];
	if ($publiser)
	{	
		$tittel=$_POST["tittel"];
		$beskrivelse=$_POST["editor"];
	
		if (!$tittel || !$beskrivelse)
		{
			echo ("<br/><br/>
					<div class='panel panel-danger'>
      					<div class='panel-heading'>Advarsel!</div>
      					<div class='panel-body'>Tittel og beskrivelse må fylles ut!</div>
    				</div>");
		}
		else
		{				
			$sqlSetning="INSERT INTO innlegg(tittel,beskrivelse,publisert) VALUES('$tittel','$beskrivelse',CURRENT_TIMESTAMP);";
			mysqli_query($db,$sqlSetning) or die (" <br/>Ikke mulig å registrere i databasen.");
				
			echo ("<div class='panel panel-success'>
      					<div class='panel-heading'>Følgende innlegg er registrert :</div>
      					<div class='panel-body'><strong>Tittel:</strong><br/> $tittel <br/> 
							<strong> Beskrivelse:</strong> <br/> $beskrivelse <br/>
						</div>
    				</div><br/>");
		}		
	}
?>

<form method="post" action="" enctype="multipart/form-data" name="registrerInnlegg" >
    <label class="control-label" for="Tittel">Tittel :</label>
	<input class="form-control" style="width:100%;" type="text" id="tittel" name="tittel"  required autofocus /> <br/>
    <label class="control-label" for="Beskrivelse">Beskrivelse :</label>
    <textarea name="editor" id="editor"></textarea>
		<script>
			ClassicEditor
				.create( document.querySelector( '#editor' ) )
				.then( editor => {
					console.log( editor );
				} )
				.catch( error => {
					console.error( error );
				} );
		</script>
	<br/>
    <input type="submit" style="width: 40%" class="btn btn-primary btn-lg" id="publiser" name="publiser" value="Publiser"/>
	<input type="reset" style="width: 40%" class="btn btn-primary btn-lg" value="Nullstill" name="nullstill" id="nullstill" /> <br/>
	<br/>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<br/>
<br/>


<!-- -------------------- Slette innlegg ---------------------- -->
<form method="post" action="" id="slett-flere-innlegg" name="slett-flere-innlegg" onsubmit="return deleteConfirm();">
	<legend class="text-left"> <h2 style="font-weight: bold;">Oversikt over tidligere innlegg</h2></legend>
	<br/>

	<!-- ------- PHP ------- -->
	<?php

    $query = mysqli_query($db,"SELECT * FROM innlegg ORDER BY publisert DESC;");

	?> <!-- ------- PHP slutt ------- -->
	<div style="overflow-x:auto;">
		<table style='border:none;' class='table table-hover'>
			<thead>
				<tr> 
					<th hidden><input type="checkbox" name="check_all" id="check_all" value=""/></th> 
					<th>Slett</th> 
					<th>Tittel</th> 
					<th>Beskrivelse</th> 
					<th>Publisert</th> 
				</tr>
			</thead>
		
<!-- ------- PHP ------- -->
<?php
	if(mysqli_num_rows($query) > 0)
    {
        while($row = mysqli_fetch_assoc($query))
        {
            extract($row);
 ?><!-- ------- PHP slutt ------- -->
			<tbody>
				<tr> 
					<td>
						<input class='checkbox' type='checkbox' name='selected_id[]' value='<?php echo $id; ?>'/>
					</td>
					<td><?php echo $tittel; ?></td>
            		<td><?php echo $beskrivelse; ?></td>
            		<td><?php echo $publisert; ?></td>
            	</tr>
<!-- ------- PHP ------- -->
<?php 
 		} 
   	}
   	else
	{ 
?> <!-- ------- PHP slutt ------- -->
      			<tr>
            		<td colspan="3">Lista er tom.</td>
            	</tr> 
<!-- ------- PHP ------- -->
<?php 
	} 
?><!-- ------- PHP slutt ------- -->
       		</tbody>
  		</table>
  	</div>

  	<input type="submit" style="width: 40%" class="btn btn-primary btn-lg" id="btn_delete" name="btn_delete" value="Slett"/>
  	<br/>

  	<?php
    if (count($_POST["selected_id"]) > 0 ) 
    {
      $all = implode(",", $_POST["selected_id"]);
      $query="DELETE FROM innlegg WHERE 1 AND id IN($all)";
      mysqli_query($db,$query) or die (" <br/>Ikke mulig å slette fra databasen.");
         echo ("<br/>
         		<div class='panel panel-success'>
                    <div class='panel-heading'>Godkjent</div>
                    <div class='panel-body'>Valgte innlegg er slettet. <br/><br/>
                    <strong>OBS!</strong> Refresh siden for å oppdatere listen med innlegg.<br/>
                </div>
                </div><br/>");
    }
    ?>
</form>

<!-- --------------------------- javascript --------------------- -->
<script type="text/javascript">
function deleteConfirm(){
    var result = confirm("Sikker på at du vil slette disse innleggene?");
    if(result){
        return true;
    }else{
        return false;
    }

	$(document).ready(function(){
	    $('#check_all').on('click',function(){
	        if(this.checked){
	            $('.checkbox').each(function(){
	                this.checked = true;
	            });
	        }else{
	             $('.checkbox').each(function(){
	                this.checked = false;
	            });
	        }
	    });
	    
	    $('.checkbox').on('click',function(){
	        if($('.checkbox:checked').length == $('.checkbox').length){
	            $('#check_all').prop('checked',true);
	        }else{
	            $('#check_all').prop('checked',false);
	        }
	    });
	});
}
</script>
</div>
<?php	
include ("slutt.html");
?>