<!-- database tilkobling -->

<?php
include "db-config.php";
	$db=mysqli_connect($HOST,$USERNAME,$PASSWORD,$DBNAME) or die ("Ingen kontakt med database-serveren.");

?>	