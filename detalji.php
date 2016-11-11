<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta name="description" content="description"/>
<meta name="keywords" content="keywords"/> 
<link rel="stylesheet" type="text/css" href="default.css" media="screen"/>
<title>Sefovi Safetronics :: WebServis klijent</title>
</head>

<body>
<div class="container">

	<div class="header">
		
		<div class="title">
			<h1>Detalji narudžbine</h1>
		</div>

		<div class="navigation">
			<a href="proba.php">Lista narudžbina koje nisu poslate</a>
			<a href="poslate.php">Lista narudžbina koje su poslate</a>
			<div class="clearer"><span></span></div>
		</div>

	</div>

	<div class="main">
		
		<div class="content">

			<?php
				require_once 'Zend/Loader.php';
				require_once 'Zend/View/Helper/HtmlList.php';
				Zend_Loader::loadClass('Zend_Soap_Client');
	
				$opcije=array(
					'location'=>'http://projekat.ict/WebServis/soap',
					'uri'=>'http://projekat.ict/WebServis/soap'
				);
	
				try
				{
					$klijent = new Zend_Soap_Client(null,$opcije);
					$narudzbina = $klijent->detaljiNarudzbine($_GET['narudzbina']);
				?>
					<table>
						<thead>
						<th>Datum</th>
						<th>Kupac</th>
						<th>Broj mobilnog</th>
						<th>Cena</th>
						<th>Proizvodi</th>
						<th>Cene proizvoda</th>
						<th>Boja</th>
						<th>Količina</th>
						<th>Pošalji</th>
						</thead>
						<tbody>
				<?php
					foreach($narudzbina as $n){
					print "<tr><td>".date('d.m.Y H:i',$n['datum'])."</td>"
					. "<td>".$n['kupac']."</td><td>0".$n['brmob']."</td>"
					. "<td>".$n['ukupno']." €</td><td><ul>";
					foreach($n['naziviProizvoda'] as $naziv){
						print "<li>".$naziv."</li>";
					}
					print "</ul></td><td><ul>";
					foreach($n['ceneProizvoda'] as $cena){
						print "<li>".$cena." €</li>";
					}
					print "</ul></td><td><ul>";
					foreach($n['boja'] as $b){
						print "<li>".$b."</li>";
					}
					print "</ul></td><td><ul>";
					foreach($n['kolicina'] as $k){
						print "<li>".$k."</li>";
					}
					
					print "</ul></td>";
					if($n['poslato'] == 0){
						print "<td><a href='posalji.php?narudzbina=".$n['id']."'>Pošalji</a>";
					}else{
						print "<td>Poslato</td>";
					}
					print "</td></tr>";
					}
					print "</tbody></table>";
				}
				catch(SoapFault $s)
				{
					die('ERROR:['.$s->faultcode.']'.$s->faultstring);
				}
				catch(Exception $e)
				{
					die('ERROR: '.$e->getMessage());
				}
			?>

		</div>

		<div class="sidenav">
		
			<h1>Pretraga</h1>
			<form action="#">
			<div>
				<input type="text" name="search" class="styled" /> <input type="submit" value="Pretraži" class="button" />
			</div>
			</form>

			<h1>Linkovi 1</h1>
			<ul>
				<li><a href="#">Link 1</a></li>
				<li><a href="#">Link 2</a></li>
				<li><a href="#">Link 3</a></li>
			</ul>

			<h1>Linkovi 2</h1>
			<ul>
				<li><a href="#">Link 1</a></li>
				<li><a href="#">Link 2</a></li>
				<li><a href="#">Link 3</a></li>
			</ul>

			<h1>Linkovi 3</h1>
			<ul>
				<li><a href="#">Link 1</a></li>
				<li><a href="#">Link 2</a></li>
				<li><a href="#">Link 3</a></li>
			</ul>

		</div>
	
		<div class="clearer"><span></span></div>

	</div>

</div>

<div class="footer">&copy; 2011 <a href="#">webdizajn.ict.edu.rs</a>. Template design by <a href="#">Marko M Spasojević</a>
</div>

</body>

</html>


			


