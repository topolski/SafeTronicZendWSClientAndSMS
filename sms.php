<?php 
	
	mb_internal_encoding("UTF-8");
	mb_http_output('UTF-8');
	
	$phone = $_GET['phone'];
	$smscenter = $_GET['smscenter'];
	$text = rawurldecode($_GET["text"]);
	
	$headers = getallheaders();
	if(empty($phone)){
		$phone = $headers["phone"];
	}
	if(empty($smscenter)){
		$smscenter = $headers["smscenter"];
	}
	if(empty($text) || strlen($text) == 0 || $text == ""){
		sendResponse("Prosledili ste praznu poruku. Pošaljite INFO da vidite spisak funkcija.");
	}else{
		$reci=explode(' ', $text);
		if(strtolower($reci[0]) == "info"){
			sendResponse("Spisak funkcija: \"TIP\"(Da dobijete siguran tip dana), \"MEGA TIP\"(Da dobijete siguran tip dana sa velikom kvotom), \"TIKET\"(Da dobijete siguran tiket dana (četiri utakmice)), \"MEGA TIKET\"(Da dobijete siguran tiket dana sa velikom kvotom(šest utakmica)).");
		}elseif(count($reci) == 1 && strtolower($reci[0]) == "tip"){
			$result = vratiTipTiket($reci[0]);
			if($result != $reci[0]." za današnji dan nije pronađen!"){
				sendResponse("Tip dana je: ".$result);
			}else{
				sendResponse("Greška: ".$result);
			}
		}elseif(count($reci) == 1 && strtolower($reci[0]) == "tiket"){
			$result = vratiTipTiket($reci[0]);
			if($result != $reci[0]." za današnji dan nije pronađen!"){
				sendResponse("Tiket dana je: ".$result);
			}else{
				sendResponse("Greška: ".$result);
			}
		}elseif(count($reci) == 2 && strtolower($reci[0]) == "mega" && strtolower($reci[1]) == "tip"){
			$result = vratiTipTiket($reci[0].$reci[1]);
			if($result != $reci[0].$reci[1]." za današnji dan nije pronađen!"){
				sendResponse("Mega tip dana je: ".$result);
			}else{
				sendResponse("Greška: ".$result);
			}
		}elseif(count($reci) == 2 && strtolower($reci[0]) == "mega" && strtolower($reci[1]) == "tiket"){
			$result = vratiTipTiket($reci[0].$reci[1]);
			if($result != $reci[0].$reci[1]." za današnji dan nije pronađen!"){
				sendResponse("Mega tiket dana je: ".$result);
			}else{
				sendResponse("Greška: ".$result);
			}
		}else{
			sendResponse("Pogrešno unet zahtev. Pošaljite INFO da vidite spisak funkcija.");
		}
	}
	
	function vratiTipTiket($t){
		$conn = connect();
		$query="SELECT ".$t." FROM sms WHERE datum=".date("dmY").";";
        $result= mysql_query($query);
        if(mysql_num_rows($result)==1){
                $result=mysql_fetch_assoc($result);
                return $result[$t];
        }else{
			return $t." za današnji dan nije pronađen!";
		}
	}
	
	function connect(){
        $db_serverName="localhost";        
        $db_username="497594";
        $db_password="tope91";
        $db_database="497594";
        $conn=mysql_connect($db_serverName,$db_username,$db_password);
        $baza=mysql_select_db($db_database,$conn);
        mysql_set_charset('utf8',$conn);
        return $conn;
	}

	function disconnect($conn){
        mysql_close($conn);
	}
	
	function sendResponse($t){
		$reply = rawurlencode($t);
		header("Content-Type: text/html; charset=utf-8");
		header("text: ".$reply);
	}
	
	//echo date("dmY");
?>