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
					$narudzbina = $klijent->posaljiNarudzbinu($_GET['narudzbina']);
					header('Location:proba.php');
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
			


