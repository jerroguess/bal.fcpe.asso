<?php


	$strUrl = 'http://weather.yahooapis.com/forecastrss?w=55863469&u=c';      
	
	// Create the cURL Object here
	$oCrl    = curl_init();
	curl_setopt($oCrl, CURLOPT_HEADER, 0);
	curl_setopt($oCrl, CURLOPT_RETURNTRANSFER, 1);
	
	// Here we ask google to give us the lats n longs in XML format
	curl_setopt($oCrl, CURLOPT_URL, $strUrl);
	$gXML = curl_exec($oCrl);    // Here we get the google result in XML


	$resultat = utf8_encode($gXML);
	$resultat = str_replace("yweather:condition", "yweather_condition", $resultat);
	$resultat = str_replace("yweather:forecast", "yweather_forecast", $resultat);
	
	// Using SimpleXML (Built-in XML parser in PHP5) to parse google result
	$goo = simplexml_load_string($resultat); // VERY IMPORTANT ! - ACHTUNG ! - this line is for documents that are UTF-8 encoded

	$atab_WeatherCode = array();
	$atab_WeatherCode[0] = "Tornade";
	$atab_WeatherCode[1] = "TempÃªte tropicale";
	$atab_WeatherCode[2] = "Ouragan";
	$atab_WeatherCode[3] = "Orages violents";
	$atab_WeatherCode[4] = "Orages";
	$atab_WeatherCode[5] = "Pluie et neige";
	$atab_WeatherCode[6] = "Pluie et grésil";
	$atab_WeatherCode[7] = "Neige mÃªlées de grésil";
	$atab_WeatherCode[8] = "Bruine verglaÃ§ante";
	$atab_WeatherCode[9] = "Bruine";
	$atab_WeatherCode[10] = "Pluie verglaÃ§ante";
	$atab_WeatherCode[11] = "Pluie";
	$atab_WeatherCode[12] = "Pluie";
	$atab_WeatherCode[13] = "Chutes de neige";
	$atab_WeatherCode[14] = "LégÃ¨re chute de neige";
	$atab_WeatherCode[15] = "Neige";
	$atab_WeatherCode[16] = "Neige";
	$atab_WeatherCode[17] = "GrÃªle";
	$atab_WeatherCode[18] = "Grésil";
	$atab_WeatherCode[19] = "PoussiÃ¨re";
	$atab_WeatherCode[20] = "Brumeux";
	$atab_WeatherCode[21] = "Haze";
	$atab_WeatherCode[22] = "Brumeux";
	$atab_WeatherCode[23] = "Venteux";
	$atab_WeatherCode[24] = "Venteux";
	$atab_WeatherCode[25] = "Froid";
	$atab_WeatherCode[26] = "Nuageux";
	$atab_WeatherCode[27] = "TrÃ¨s nuageux (nuit)";
	$atab_WeatherCode[28] = "TrÃ¨s nuageux (jour)";
	$atab_WeatherCode[29] = "Partiellement ensoleillé (nuit)";
	$atab_WeatherCode[30] = "Partiellement nuageux (jour)";
	$atab_WeatherCode[31] = "Claire (de nuit)";
	$atab_WeatherCode[32] = "Ensoleillé";
	$atab_WeatherCode[33] = "Beau temps (nuit)";
	$atab_WeatherCode[34] = "Beau temps (jour)";
	$atab_WeatherCode[35] = "Pluie mÃªlée de grÃªle";
	$atab_WeatherCode[36] = "Chaud";
	$atab_WeatherCode[37] = "Orages isolés";
	$atab_WeatherCode[38] = "Orages intermittents";
	$atab_WeatherCode[39] = "Orages intermittents";
	$atab_WeatherCode[40] = "Averses éparses";
	$atab_WeatherCode[41] = "Fortes chutes de neige";
	$atab_WeatherCode[42] = "Averses de neige éparses";
	$atab_WeatherCode[43] = "Fortes chutes de neige";
	$atab_WeatherCode[44] = "Partiellement nuageux";
	$atab_WeatherCode[45] = "Orages";
	$atab_WeatherCode[46] = "Chutes de neige";
	$atab_WeatherCode[47] = "Orages isolés";
	$atab_WeatherCode[3200] = "Non disponible";

	$atab_Icone = array();
	$atab_Icone[0] = "Wind";
	$atab_Icone[1] = "Wind";
	$atab_Icone[2] = "Wind";
	$atab_Icone[3] = "ThunderStorm";
	$atab_Icone[4] = "ThunderStorm";
	$atab_Icone[5] = "IcyRain";
	$atab_Icone[6] = "IcyRain";
	$atab_Icone[7] = "IcyRain";
	$atab_Icone[8] = "Drizzle";
	$atab_Icone[9] = "Drizzle";
	$atab_Icone[10] = "IcyFrozenSnow";
	$atab_Icone[11] = "Showers";
	$atab_Icone[12] = "Showers";
	$atab_Icone[13] = "WindySnow";
	$atab_Icone[14] = "WindySnow";
	$atab_Icone[15] = "WindySnow";
	$atab_Icone[16] = "WindySnow";
	$atab_Icone[17] = "GrÃªle";
	$atab_Icone[18] = "Sleet";
	$atab_Icone[19] = "Wind";
	$atab_Icone[20] = "Fog";
	$atab_Icone[21] = "Haze";
	$atab_Icone[22] = "Smoke";
	$atab_Icone[23] = "Wind";
	$atab_Icone[24] = "Wind";
	$atab_Icone[25] = "WindySnow";
	$atab_Icone[26] = "Clouds";
	$atab_Icone[27] = "MostlyCloudyNight";
	$atab_Icone[28] = "MostlyCloudyDay";
	$atab_Icone[29] = "PartlyCloudyNight";
	$atab_Icone[30] = "PartlyCloudyDay";
	$atab_Icone[31] = "Moon";
	$atab_Icone[32] = "Sun";
	$atab_Icone[33] = "FairNight";
	$atab_Icone[34] = "FairDay";
	$atab_Icone[35] = "IcyRain";
	$atab_Icone[36] = "Hot";
	$atab_Icone[37] = "ThunderStorm";
	$atab_Icone[38] = "ThunderStorm";
	$atab_Icone[39] = "ThunderStorm";
	$atab_Icone[40] = "Showers";
	$atab_Icone[41] = "WindySnow";
	$atab_Icone[42] = "IcyRain";
	$atab_Icone[43] = "WindySnow";
	$atab_Icone[44] = "PartlyCloudyDay";
	$atab_Icone[45] = "SunnyShowers";
	$atab_Icone[46] = "Snow";
	$atab_Icone[47] = "ThunderStorm";
	$atab_Icone[3200] = "Unknown";
	
	$atab_Jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
	$atab_Mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","AoÃ»t","Septembre","Octobre","Novembre","Décembre");
	$lstr_DateFr = $atab_Jour[date("w", strtotime($goo->channel->item->yweather_condition["date"]))] . " " . date("d", strtotime($goo->channel->item->yweather_condition["date"])) . " " . $atab_Mois[date("n", strtotime($goo->channel->item->yweather_condition["date"]))] . " " . date("Y", strtotime($goo->channel->item->yweather_condition["date"]));

	echo "<br/>";
	echo "<span>Echirolles</span>";
	echo "<br/>";
	echo "<img src=\"" . $atab_Icone[intval($goo->channel->item->yweather_condition["code"])] . "2.png\" alt=\"météo\"/>";
	echo "<br/>";
	echo "<span>";
	echo $atab_WeatherCode[intval($goo->channel->item->yweather_condition["code"])] . "<br/>" . intval($goo->channel->item->yweather_condition["temp"]) . "Â°c" ;
	echo "</span>";
	echo "<br/>";
	echo "<br/>";
	echo "<span>";
	echo $lstr_DateFr;
	echo "</span>";
	echo "<br/>";
	echo "<br/>";
	
	print_r($goo);
	//<yweather:condition text="Mostly Cloudy" code="26" temp="57" date="Tue, 29 Nov 2005 3:56pm PST"></yweather:condition>
	//<yweather:forecast day="Tue" date="29 Nov 2005" low="45" high="62" text="Mostly Cloudy" code="27"></yweather:forecast>
?>