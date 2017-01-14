<?php
set_time_limit(0);
error_reporting(0);
ini_set("default_socket_timeout",5);


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

$sitem = $argv[1];

if (isset($sitem) and isset($argv[2]))
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






    

    // Bing Verileri Çekiliyor ....


        for ($b=1;$b<100;$b++)
        {

        
        $url = 'http://www.bing.com/search?q=ip%3a'.$sitem.'&first='.$b;
        $cr = curl_init();
        curl_setopt($cr, CURLOPT_URL, $url);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cr, CURLOPT_COOKIEJAR, "cookie.txt");
        curl_setopt($cr, CURLOPT_COOKIEFILE, "cookie.txt");
        curl_setopt($cr, CURLOPT_FOLLOWLOCATION, 1);
        $cal = curl_exec($cr);
        curl_close($cr);
		
        $say = preg_match_all('@<div class="b_attribution" u="(.*?)"><cite>(.*?)</cite>@si',$cal,$ycal);
		
            for ($i=0;$i<$say;$i++)
            {
                if (!strstr($ycal[2][$i],"http://"))
                {
                    $bol = parse_url($ycal[2][$i]);
					
                    if (@!strstr($boltoplam,strip_tags($bol['path'])))
                        {
						$yazb = fopen($argv[2], "a+");
                        @($boltoplam = $boltoplam."http://".strip_tags($bol['path']));
                        print "http://".strip_tags($bol['path'])."\r\n";
                        fwrite($yazb,"http://".strip_tags($bol['path'])."\r\n");
						 fclose($yazb);
                        }
                }
            }


        }
   
    }
else
    {
    echo 'php bing.php http://arsle.org sitelistesi.txt';
    }
?>
