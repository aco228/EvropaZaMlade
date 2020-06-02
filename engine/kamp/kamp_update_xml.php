<?php
	function xml_dataBase($_k, $organizacija){
		global $db; 
		$zemlja = $db->q("SELECT ime_zemlje FROM zemlje WHERE jezik_zemlje='".$_k['zemlja']."';");

		$db->e("INSERT INTO kamp (ime_kampa, kod_kampa, zemlja, organizacija, lokacija_kampa, regija_kampa, jezik_kampa, tip_kampa, 
			pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina, 
			ukupanBrojVolontera, dodatniTroskovi, minimumGodina, maksimumGodina, 
			opis_kampa, opis_posla, opis_lokacije, opis_potreba, dodatne_info) VALUES (
			'". $_k['ime_kampa'] ."',
			'". $_k['kod'] ."',
			'". $zemlja['ime_zemlje'] ."',
			'". $organizacija ."',
			'". $_k['lokacija_kampa'] ."',
			'". $_k['regija_kampa'] ."',
			'". $_k['jezik_kampa'] ."',
			'". $_k['tipkampa'] ."',

			". $_k['pocetakDan'] .",
			". $_k['pocetakMjesec'] .",
			". $_k['pocetakGodina'] .",
			". $_k['krajDan'] .",
			". $_k['krajMjesec'] .",
			". $_k['krajGodina'] .",

			'". $_k['ukupanBrojVolontera'] ."',
			'". $_k['dodatniTroskovi'] ."',
			'". $_k['minimumGodina'] ."',
			'". $_k['maksimumGodina'] ."',

			'". $_k['opis_kampa'] ."',
			'". $_k['opis_posla'] ."',
			'". $_k['opis_lokacije'] ."',
			'". $_k['opis_potreba'] ."',
			'". $_k['dodatne_informacije'] ."'
			);");
	}

	function xmlE($unos) { return mysql_real_escape_string($unos); }

	function xml_engine($xml){
		$organizacija = $xml->organization;
		foreach($xml->projects->project as $kamp){
			$_k = array(
				"kod" => "",
				"tipkampa" => "",
				"pocetakDan" => "-1",
				"pocetakMjesec" => "-1",
				"pocetakGodina" => "-1",
				"krajDan" => "-1",
				"krajMjesec" => "-1",
				"krajGodina" => "-1",
				"ime_kampa" => "",
				"lokacija_kampa" => "",
				"zemlja" => "",
				"regija_kampa" => "",
				"jezik_kampa" => "",
				"ukupanBrojVolontera" => "",
				"dodatniTroskovi" => "",
				"minimumGodina" => "",
				"maksimumGodina" => "",
				
				"opis_kampa" => "",
				"opis_posla" => "",
				"opis_lokacije" => "",
				"opis_potreba" => "",
				"dodatne_informacije" => ""
			);
			// Preuzimanje osnovnih informacija
			$_k['kod'] = mysql_real_escape_string($kamp->code);
			$_k['tipkampa'] = mysql_real_escape_string($kamp->work);
			
			//echo "QAAAAAAAAAAAAAAAAAAAAAAAAAA_________________ " . $kamp->startDate . " " . $kamp->endDate;
			$startDate = explode("-", $kamp->start_date);
			$endDate = explode("-", $kamp->end_date);
			if(sizeof($startDate)==3){
				$_k['pocetakDan'] = $startDate[2];
				$_k['pocetakMjesec'] = $startDate[1];
				$_k['pocetakGodina'] = $startDate[0];
			}
			if(sizeof($endDate)==3){
				$_k['krajDan'] = $endDate[2];
				$_k['krajMjesec'] = $endDate[1];
				$_k['krajGodina'] = $endDate[0];
			}

			$_k['ime_kampa'] = mysql_real_escape_string($kamp->name);
			$_k['lokacija_kampa'] = mysql_real_escape_string($kamp->location);
			$_k['zemlja'] = mysql_real_escape_string($kamp->country);
			$_k['regija_kampa'] = mysql_real_escape_string($kamp->region);
			$_k['jezik_kampa'] = mysql_real_escape_string($kamp->languages);
			$_k['ukupanBrojVolontera'] = mysql_real_escape_string($kamp->numvol);
			$_k['dodatniTroskovi'] = mysql_real_escape_string($kamp->extrafee) . " " . mysql_real_escape_string($kamp->extrafee_currency);
			$_k['minimumGodina'] = mysql_real_escape_string($kamp->min_age);
			$_k['maksimumGodina'] = mysql_real_escape_string($kamp->max_age);

			$_k['opis_kampa'] = xmlE("DESCRIPTION:".PHP_EOL."" . $kamp->description . "".PHP_EOL."".PHP_EOL."DESCRIPTION ACCOMODATION AND FOOD:".PHP_EOL."" . $kamp->descr_accomodation_and_food . "".PHP_EOL."".PHP_EOL."PARTNER DESCRIPTION: ".PHP_EOL."" . $kamp->descr_partner);
			$_k['opis_posla'] = xmlE($kamp->descr_work);
			$_k['opis_lokacije'] = xmlE($kamp->descr_location_and_leisure . "".PHP_EOL."".PHP_EOL."AIRPORT: " . $kamp->airport . "".PHP_EOL."STATION: " . $kamp->station);
			$_k['opis_potreba'] = xmlE($kamp->descr_requirements);
			$_k['dodatne_informacije'] = xmlE($kamp->notes . " ".PHP_EOL."".PHP_EOL."--------------------------".PHP_EOL."NUMBER OF MALE VOLUNTEERS: " . $kamp->numvol_m . "".PHP_EOL."NUMBER OF FEMALE VOLUNTEERS: " . $kamp->numvol_f .
												"".PHP_EOL."NUMBER OF TEENAGERS: " . $kamp->max_teenagers . "".PHP_EOL."NUMBER OF NATION VOLUNTEERS: " . $kamp->max_national_vols);

			xml_dataBase($_k, xmlE($organizacija));
		}
	}

?>