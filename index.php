<?php
require_once("private/initialize.php");
?>
<?php include(LIB_PATH.DS."htmls".DS."header.php"); ?>
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
   <div id="main">
     <br><br><br><br><br><br><br>
     <h2>Quali sono i costi di spedizione della mia macchina?</h2>
     <div class=answer> Puoi calcolare i costi di spedizione dell'autovettura acquistata in base all'origine e la destinazione della stessa.</div><br>
     <iframe src="transports.php" frameborder="0" height="235px" width="800px"></iframe>
     <h2>Qual è lo stato della documentazione richiesta ?</h2>
     <div class=answer>Puoi eseguire una ricerca con lo StockID della tua vettura per controllare se abbiamo ricevuto i documenti necessari al completamento della pratica:</div><br>
     <iframe src="documents.php" frameborder="0" height="200px" width="800px"></iframe>
   </div>
   <div id="footer">
     <img src="images/footer.png" alt="" align="left">
   </div>
 </body>
 <?php include(LIB_PATH.DS."htmls".DS."footer.php"); ?>
