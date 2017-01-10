<?php
require_once("private/initialize.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="it" class="no-js">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

 	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="css/public.css" media="all" type="text/css" />
 	<!-- <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
 	<!-- <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
 	<!-- <script src="js/modernizr.js"></script> <!-- Modernizr --> --> --> -->
 	<title>FAQ Merchants | Auto1.com</title>
 </head>

<div id="white_top_bar">
  <img src="images/long.png" alt="" align="left">
</div>
<div id="header">
  <a href="https://www.auto1.com/it/"> <img src="images/auto.png" alt="" align="left"> </a>
  <a href="https://www.auto1.com/it/our-cars"> <img src="images/nostre.png" alt="" align="left"> </a>
  <a href="https://www.auto1.com/it/company"> <img src="images/proposito.png" alt="" align="left"> </a>
  <a href="https://www.auto1.com/it/jobs"> <img src="images/lavora.png" alt="" align="left"> </a>
</div>
 <body>
     <br><br><br><br><br><br><br>
   <div id="main">
     <h1><i>- Quali sono i costi di spedizione della mia macchina?</i></h1><br>
     <div id="answer"> Puoi calcolare i costi di spedizione in base al punto di partenza e di arrivo dell'autovettura acquistata:</div><br>
     <iframe src="transports.php" frameborder="0" height="300px" width="800px"></iframe><hr>
     <h1><i>- Qual è lo stato della documentazione richiesta ?</i></h1><br>
     <div id="answer">Puoi eseguire una ricerca con lo Stock ID della tua vettura per controllare se abbiamo ricevuto i documenti necessari al completamento della pratica:</div><br>
     <iframe src="documents.php" frameborder="0" height="200px" width="800px"></iframe>
   </div>
   <div id="footer">
     <img src="images/footer.png" alt="" align="left">
   </div>
   <script src="js/index.js"></script>
 </body>
 <?php include(LIB_PATH.DS."htmls".DS."footer.php"); ?>
