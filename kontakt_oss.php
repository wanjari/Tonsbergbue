<?php
include ("start.html");
?>
<form class="form-horizontal" action="send_mail.php" method="post">
 	<fieldset>
   	<legend class="text-center"> <h2>Kontakt oss</h2></legend>

   	<!-- Name input-->
   	<div class="form-group">
   		<label class="col-md-3 control-label" for="name">Navn</label>
   		<div class="col-md-6">
     		<input id="navn" name="navn" type="text" placeholder="Fornavn og etternavn" class="form-control">
   		</div>
   	</div>
    
   	<!-- Email input-->
   	<div class="form-group">
   		<label class="col-md-3 control-label" for="email">E-postadresse</label>
   		<div class="col-md-6">
     		<input id="email" name="email" type="email" placeholder="eksempel@domain.no" class="form-control">
   		</div>
   	</div>

   	<!-- Telefon input-->
   	<div class="form-group">
   		<label class="col-md-3 control-label" for="telefon">Telefon</label>
   		<div class="col-md-6">
     		<input id="telefon" name="telefon" type="number" placeholder="Nummer" class="form-control">
   		</div>
   	</div>
    
   	<!-- Message body -->
   	<div class="form-group">
   		<label class="col-md-3 control-label" for="message">Melding</label>
   		<div class="col-md-6">
     		<textarea class="form-control" id="melding" name="melding" placeholder="Hei! Hva lurer du på?" rows="8"></textarea>
        <!-- Form actions -->
     		<div class="col-md-12 text-right">
      		<br/>
       	  <button class="btn btn-primary btn-lg" style="width: 49%" id="send" name="send"  type="submit">Send</button>
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