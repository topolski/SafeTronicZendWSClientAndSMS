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
			<h1>Narudžbine</h1>
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
	Zend_Loader::loadClass('Zend_Soap_Client');
	
	$opcije=array(
		'location'=>'http://projekat.ict/WebServis/soap',
		'uri'=>'http://projekat.ict/WebServis/soap'
	);
	
	try
	{
		$klijent = new Zend_Soap_Client(null,$opcije);
		$narudzbine = $klijent->listaNarudzbina();
		echo "<table><thead><th>Datum</th><th>Kupac</th><th>Broj mobilnog telefona</th><th>Ukupno</th><th>Detaljnije</th></thead><tbody>";
		foreach($narudzbine as $narudzbina){
			echo "<tr><td>".date("d.m.Y H:i",$narudzbina['datum'])."</td>";
			echo "<td>".$narudzbina['kupac']."</td>";
			echo "<td>0".$narudzbina['brmob']."</td>";
			echo "<td>".$narudzbina['ukupno']." €</td>";
			echo "<td><a href='detalji.php?narudzbina=".$narudzbina['id']."'>Detalji</a></td></tr>";
		}
		echo "</tbody></table>";
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


			


