<?php require_once("private/initialize.php"); ?>
<?php include(LIB_PATH.DS."htmls".DS."header.php"); ?>

<!-- <div id="white_top_bar">
  <img src="images/long.png" alt="" align="left">
</div>
<div id="header">
  <a href="https://www.auto1.com/it/"> <img src="images/auto.png" alt="" align="left"> </a>
  <a href="https://www.auto1.com/it/our-cars"> <img src="images/nostre.png" alt="" align="left"> </a>
  <a href="https://www.auto1.com/it/company"> <img src="images/proposito.png" alt="" align="left"> </a>
  <a href="https://www.auto1.com/it/jobs"> <img src="images/lavora.png" alt="" align="left"> </a>
</div> -->

<body>
<header>
	<h1><b>Domande Frequenti</b></h1>
</header>
<section class="cd-faq">
	<ul class="cd-faq-categories">
		<li><a href="#auto1">Auto1.com</a></li>
		<li><a href="#trasporti">Trasporti</a></li>
		<li><a href="#documenti">Documenti</a></li>
		<li><a href="#iva">IVA</a></li>
		<li><a href="#bollo">Bollo</a></li>
		<li><a href="#reclami">Reclami</a></li>
		<li><a href="#altro">Altro</a></li>
	</ul>

	<div class="cd-faq-items">

		<ul id="auto1" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Auto1.com</h2></li>

			<li>
				<a class="cd-faq-trigger" href="#0">Non sono ancora attivo e non vedo i prezzi delle auto, come mai?</a>
				<div class="cd-faq-content">
					<p>Non è possibile vedere i prezzi delle auto fino a quando il merchant non è in possesso delle sue credenziali per accedere al sito AUTO1.<br>
					Il merchant, per poter essere attivato ed avere le proprie credenziali, dovrà inviare una e-mail a: <a href="mailto:commercianti@auto1.com">commercianti@auto1.com</a> allegando la propria visura camerale e il proprio recapito telefonico.<br>
					Verrà contattato da un commerciale per attivare la propria posizione.</p>
				</div>
			</li>
		</ul>

		<ul id="trasporti" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Trasporti</h2></li>

			<li>
				<a class="cd-faq-trigger" href="#0">Come funziona il processo di consegna della macchina?</a>
				<div class="cd-faq-content">
					<p>Sulla DASHBOARD è possibile indicare il metodo di trasporto richiesto: PICK-UP o TRANSPORT.<br>
					La data di pick-up potrà essere inserita solo una volta ricevuta l’e-mail di avvenuto passaggio di proprietà e a seguito del rilascio del ticket.<br>
					È possibile valutare costi di trasporto attraverso la seguente <a href="#transpTool">piattaforma</a> .</p>
				</div>
			</li>

			<li>
				<a id="transpTool" class="cd-faq-trigger" href="#0">Quali sono i costi di spedizione della mia macchina?</a>
				<div class="cd-faq-content">
					<p>Attraverso la seguente piattaforma è possibile calcolare i costi di spedizione in base al punto di partenza e di arrivo dell'autovettura acquistata:</p><br>
					<iframe src="transports.php" frameborder="2" height="234px" width="100%"></iframe>
				</div>
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">Ho scelto come modalità di consegna il trasporto, non mi è ancora arrivata la macchina, come mai?</a>
				<div class="cd-faq-content">
					<p>Nel caso il merchant abbia scelto come modalità di consegna il trasporto e questo sia INTERNAZIONALE, le tempistiche sono di 15 gg lavorativi dall’avvenuto pagamento della fattura di trasporto. Se invece il trasporto fosse NAZIONALE le tempistiche sono di 10 gg lavorativi dal pagamento della fattura di trasporto e del passaggio di proprietà.</p>
				</div>
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">Non riesco a rispettare la data di pick-up che ho inserito, come posso fare?</a>
				<div class="cd-faq-content">
					<p>Auto1 si riserva la possibilità di addebitare al merchant la somma di € 15.00 per ogni giorno successivo alla data di pick-up.</p>
				</div>
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">E’ possibile passare a ritirare l'auto prima della data di pick-up?</a>
				<div class="cd-faq-content">
					<p>Non è possibile ritirare l’auto prima della data di pick-up senza prima aver ricevuto il ticket necessario.</p>
				</div>
				</li>

		</ul> <!-- cd-faq-group -->

		<ul id="documenti" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Documenti</h2></li>

			<li>
				<a class="cd-faq-trigger" href="#0">Come funziona il processo di consegna dei documenti?</a>
				<div class="cd-faq-content">
					<p>Per i nuovi merchant Il giorno dopo il primo acquisto, l’agenzia FINPROGET vi invierà, tramite e-mail, l’elenco dei documenti da rispedire rispondendo all’ e-mail, in particolar modo il modello C-Corr fondamentale per il ritiro DHL dei moduli TT2120 e ACI PRA presso l ‘indirizzo fornitoci.<br>
					Per i merchant che hanno già acquistato in passato, FINPROGET ha gia i vostri documenti. Qualora finproget avesse finito i documenti TT2120 e ACI /PRA  invierà l’e-mail con il modello C-Corr per il ritiro dei documenti attraverso il corriere DHL a carico di AUTO1.<br><i>
					Il passaggio di proprietà avverrà solamente dopo il pagamento dell’auto e la ricezione di tutti i documenti, e verrà fatto in 4-5 gg lavorativi.</i><br>
					È possibile monitorare la ricezione dei documenti da parte di FINPROGET attraverso la seguente <a href="#docsTool">piattaforma</a> .</p>
				</div>
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">In quanto tempo viene effettuato il passaggio di proprietà?</a>
				<div class="cd-faq-content">
					<p>Dall’arrivo del corriere per il ritiro dei documenti originali, si possono considerare 2-3 giorni lavorativi entro i quali sarà effettuato il passaggio di proprietà.</p>
				</div>
			</li>

			<li>
				<a id="docsTool" class="cd-faq-trigger" href="#0">Qual è lo stato dei documenti che vi ho inviato?</a>
				<div class="cd-faq-content">
					<p>Attraverso la seguente piattaforma è possibile eseguire una ricerca dello Stock ID della tua vettura e controllare se abbiamo ricevuto i documenti necessari al completamento della pratica:</p><br>
			     <iframe src="documents.php" frameborder="0" height="163px" width="100%"></iframe><br>
				  <p><u>
				  Per la maggior parte delle auto le informazioni sono disponibili a partire dal primo giorno lavorativo successivo alla data di acquisto. <br>
				  Per alcune auto le informazioni sono disponibili a partire dal primo giorno lavorativo successivo alla data di pagamento.</u></p>
				</div>
			</li>
		</ul>

		<ul id="iva" class="cd-faq-group">
			<li class="cd-faq-title"><h2>IVA</h2></li>

			<li>
				<a class="cd-faq-trigger" href="#0">Come posso chiedere il rimborso dell'IVA?</a>
				<div class="cd-faq-content">
					<p>E’ possibile chiedere il rimborso dell’IVA, per le auto IVA ESPOSTA e per le auto importate in Italia dall’estero, solo se esse hanno raggiunto la loro destinazione finale e il merchant ha pagato la fattura ed è in possesso della bolla di trasporto.  È possibile chiedere il rimborso inviando una e-mail a <a href="mailto:vat-refund-it@auto1.com">vat-refund-it@auto1.com</a>
					allegando modulo di rimborso corrispondente alla nazionalità dell’auto, CMR, IBAN, SWIFT e intestatario del conto.<br><br>
					<a href="files/purchase_declarations_for_export_de.pdf">Scarica il modulo per la GERMANIA</a><br>
					<a href="files/purchase_declarations_for_export_fr.pdf">Scarica il modulo per la FRANCIA</a><br>
					<a href="files/purchase_declarations_for_export_es.pdf">Scarica il modulo per la SPAGNA</a><br>
					<a href="files/purchase_declarations_for_export_be.pdf">Scarica il modulo per il BELGIO</a><br>
					<a href="files/purchase_declarations_for_export_nl.pdf">Scarica il modulo per l'OLANDA</a><br>
					<a href="files/purchase_declarations_for_export_pl.pdf">Scarica il modulo per la POLONIA</a><br>
					<a href="files/purchase_declarations_for_export_se.pdf">Scarica il modulo per la SVEZIA</a><br>
					<a href="files/purchase_declarations_for_export_at.pdf">Scarica il modulo per l'AUSTRIA</a><br>
					</p>
				</div>
			</li>
		</ul>

		<ul id="bollo" class="cd-faq-group">
			<li class="cd-faq-title"><h2>BOLLO</h2></li>

			<li>
				<a class="cd-faq-trigger" href="#0">Come posso conoscere la situazione bollo di un'auto?</a>
				<div class="cd-faq-content">
					<p>In materia di bollo auto la nostra società segue le direttive imposte dalla Regione Lombardia riguardo la sospensione del bollo.<br>
					E’ possibile contattarci per verificare, sul sito della Regione Lombardia, se il veicolo è stato messo in esenzione da parte nostra fornendo Stock ID e targa della vettura richiesta.</p>
				</div>
			</li>

		</ul>

					<ul id="reclami" class="cd-faq-group">
						<li class="cd-faq-title"><h2>RECLAMI</h2></li>

						<li>
							<a class="cd-faq-trigger" href="#0">Come faccio per presentare un reclamo?</a>
							<div class="cd-faq-content">
								<p>E’ possibile presentare un reclamo direttamente dalla propria DASHBOARD.<br><br><a href="files/guida_reclami.pdf">Scarica la GUIDA RECLAMI</a>
								<br>
								</p>
							</div>
						</li>

						<li>
							<a class="cd-faq-trigger" href="#0">Quanto tempo ho per presentare un reclamo?</a>
							<div class="cd-faq-content">
								<p>E’ possibile presentare un reclamo entro 7 giorni dalla consegna dell’auto.</p>
							</div>
						</li>

					</ul>

					<ul id="altro" class="cd-faq-group">
						<li class="cd-faq-title"><h2>Altro</h2></li>
						<li>
							<a class="cd-faq-trigger" href="#0">La mia domanda non è presente tra quelle sopra elencate, come posso fare?</a>
							<div class="cd-faq-content">
								<p>Per qualsiasi domanda è possibile contattare il supporto telefonico al numero: <a href="tel:00390236504884">+39 02 3650 4884</a> oppure inviare una e-mail all’indirizzo <a href="mailto:helpdesk-it@auto1.com">helpdesk-it@auto1.com</a> .<br></p>
							</div>
						</li>

					</ul>



	</div>
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="footer">
  <img src="images/footer.png" alt="" align="left">
</div>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
<?php include(LIB_PATH.DS."htmls".DS."footer.php"); ?>
