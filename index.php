<?php
	include ("start.html");
?>
<legend class="text-left"> <h2 style="font-weight: bold;">Velkommen til Tønsberg og Omegn Bueskyttere!</h2></legend>
<h4 style="font-weight: bold"> Er du nysgjerrig og lurer på om du vil prøve en liten men kjempekul sport? da har du kommet riktig! </h4>
<strong><p>Våre treningstider er: </p> </strong>
<ul>
	<li>Tirsdag kl 18:00 - 21:00</li>
	<li>Torsdag kl 18:00 - 21:00</li>
</ul>  
<p>Mellom kl 18:30 - 19:30 så er det satt av tid til å hjelpe nybegynnere med å komme igang ved å vise og tilpasse utlånsbuer, i tillegg gi en innføring i idretten </p>
<br/>
<br/>

<legend class="text-left"><h2 style="font-weight: bold;">Nyheter</h2></legend>
<!-- ------------ PHP ------------------ -->
<?php

include("db-tilkobling-innlegg.php");

$limit = 5;
 
// GET PAGE AND OFFSET VALUE
if (isset($_GET['page'])) {
    $page = $_GET['page'] - 1;
    $offset = $page * $limit;
} else {
    $page = 0; 
    $offset = 0;
}
 
// COUNT TOTAL NUMBER OF ROWS IN TABLE
$sql = "SELECT count(id) FROM innlegg";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
$total_rows = $row[0];
 
// DETERMINE NUMBER OF PAGES
if ($total_rows > $limit) {
    $number_of_pages = ceil($total_rows / $limit);
} else {
    $pages = 1;
    $number_of_pages = 1;
}
 
// FETCH DATA USING OFFSET AND LIMIT
$result = mysqli_query($db, "SELECT * FROM innlegg ORDER BY publisert DESC LIMIT $offset, $limit");
?>
 
<html>
<head>    
    <title>Homepage</title>
</head>
 
<body>
    <div style="overflow-x:auto;">   
    <?php 
    while($res = mysqli_fetch_array($result)) {

    echo ("<h3 class='tittel' style='float: left; font-weight:bold;'>".$res['tittel']."</h3> <br/><br/><br/>
                <p style='font-size:70%; font-style:italic; border-bottom:1px solid grey;'>Publisert:".$res['publisert']."</p>
                <p>".$res['beskrivelse']."</p>
                <br/><br/>");               
    }
    ?>
    <div class="col-sm-12" style="border-bottom: none !important;">
        <ul class="pagination";">
    <?php
    // SHOW PAGE NUMBERS
    if ($page) {
        echo "<li><a style='color: black !important;'href='index.php?page=1'> < </a></li> ";
    }
    for ($i=1;$i<=$number_of_pages;$i++) {
        echo "<li><a style='color: black !important;' href='index.php?page=$i'>".$i."</a></li> ";
    }    
    if (($page + 1) != $number_of_pages) {
        echo "<li><a style='color: black !important;' href='index.php?page=$number_of_pages'> > </a></li> ";
    }
?>
    
    </ul>
</div>
</div>
</div>

<?php
    include ("slutt.html");
?>