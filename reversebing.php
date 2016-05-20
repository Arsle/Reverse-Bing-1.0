<?php 
set_time_limit(0);
error_reporting(0);

print "|----------------Bing Searcher 1.1---------------------|\n";
print "|      _             _                    _            |\n";
print "|     | |           (_)                  (_)           |\n";
print "|     | | __ _ _ __  _ ___ ___  __ _ _ __ _  ___  ___  |\n";
print "| _   | |/ _` | '_ \| / __/ __|/ _` | '__| |/ _ \/ __| |\n";
print "|| |__| | (_| | | | | \\__ \\__ \\ (_| | |  | |  __/\\__ \\ |\n";
print "| \\____/ \\____|_| |_|_|___/___/\\____|_|  |_|\\___||___/ |\n";
print "|------------------------------------------------------|\n";
print "|             /\\            | |                        |\n";
print "|            /  \\   _ __ ___| | ___                    |\n";
print "|           / /\ \\ | '__/ __| |/ _ \\                   |\n";
print "|          / ____ \\| |  \\__ \\ |  __/                   |\n";
print "|         /_/    \\_\\_|  |___/_|\\___|                   |\n";
print "|------------------------------------------------------|\n";
print "\n";



Function IpCek($sitem)
{
	if (strstr($sitem, "http"))
        {
        $sitem = parse_url($sitem);
        $sitem = $sitem["host"];
        $sitem = gethostbyname($sitem);
        }
    else
        {
        $sitem = gethostbyname($sitem);
        }
	
	return $sitem;
	
}

Function CurlCek($ip)
{
	for($i=0;$i<100;$i++){
	$link="http://www.bing.com/search?q=ip:$ip&first=$i";
	$bot='Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)';


	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$link);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_REFERER,"http://www.bing.com/");
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
	curl_setopt($ch,CURLOPT_USERAGENT,$bot);
	
	$yaz=curl_exec($ch);
	
	return $yaz;
	}
}

Function Bol($veri)
{
	
	$yaz=fopen("site.txt","a+");
	$ayrac='@<div class="b_attribution" u="(.*?)"><cite>(.*?)</cite>@si';
	$sayi=preg_match_all($ayrac,$veri,$siteler);
	
	print "Siteler\n";
	
	foreach($siteler[2] as $site)
	{
		if(strstr($site,"http://"))
		{
		print strip_tags($site)."<br>";
		}
		else
		{
			$bol=parse_url("http://".strip_tags($site));
						if (!strstr($toplamsite,$bol['host']))
                        {
                        $boltoplam = $boltoplam."http://".$bol['host'];
                        print "http://".$bol['host']."\r\n";
                        fwrite($yaz,"http://".$bol['host']."\n");
                        }
		}
	}
	print "-------------------------------\n";
	print "Site.txt olarak kaydedilmistir.";
	fclose($yaz);
	
}

if(isset($argv[1]))
{
$site=$argv[1];
$ipadres=IpCek($site);
$baglan=CurlCek($ipadres);
Bol($baglan);
}
else
{
	print "Kullanim:php $argv[0] http://wwww.siteismi.com";
}




?>
