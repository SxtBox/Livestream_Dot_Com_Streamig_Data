<?php

/*
 ┌────────────────────────────────────────────────────────────┐
 |  For More Modules Or Updates Stay Connected to Kodi dot AL |
 └────────────────────────────────────────────────────────────┘
 ┌───────────┬────────────────────────────────────────────────┐
 │ Product   │ Livestream.com Stream Extractor By Account ID  │
 │ Version   │ v1.0-DEV                                       │
 │ Provider  │ https://livestream.com/                        │
 │ Support   │ M3U8/VLC/KODI/SMART TV/Xream Codes Panel ETC   │
 │ Licence   │ MIT                                            │
 │ Author    │ Olsion Bakiaj                                  │
 │ Email     │ TRC4@USA.COM                                   │
 │ Author    │ Endrit Pano                                    │
 │ Email     │ INFO@ALBDROID.AL                               │
 │ Website   │ https://kodi.al                                │
 │ Facebook  │ /albdroid.official/                            │
 │ Github    │ github.com/SxtBox/                             │
 │ Created   │ Tuesday, 07 April 2020                         │
 │ Modified  │ 0000:00:00:ss                                  │
 └────────────────────────────────────────────────────────────┘

 [PROCEDURE]
 [x] To Get Live Stream Required Account ID
 [EXAMPLE] FULL LINK => https://livestream.com/accounts/22300508/events/6675945
 YOU NEED TO PASSED => YOUR HOST/VLC_by_ID.php?id=accounts/22300508/events/6675945

OEMBED JSON
https://livestream.com/oembed?url= + FULL LINK https://livestream.com/radio21germany/events/6675945
EXAMPLE 1 https://livestream.com/oembed?url=https://livestream.com/radio21germany/events/6675945
EXAMPLE 2 https://livestream.com/oembed?url=https://livestream.com/accounts/22300508/events/6675945

Xtream_Codes_Panel_by_ID.php?id=accounts/22300508/events/6675945
PER XTREAM CODES Panel user_agent Duhet iPhone
http://127.0.0.1/ [YOUR SCRIPT PATH] /Xtream_Codes_Panel_by_ID.php?id=accounts/22300508/events/6675945
PER XTREAM CODES Panel user_agent Duhet iPhone
*/

ob_start();
error_reporting(0);
set_time_limit(0);
date_default_timezone_set("Europe/Tirane");
$channelid = $_GET["id"];
// ini_set("user_agent","iPhone");
if(!$channelid) die("Need ID Parameter");
function get_data($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, "iPhone");
    curl_setopt($ch, CURLOPT_REFERER, "https://livestream.com/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
// NON ARRAY PATTERN
$MAIN_LINK = get_data("https://livestream.com/" . $channelid);
preg_match_all('/secure_m3u8_url":"(.*?)"/',$MAIN_LINK,$matches, PREG_PATTERN_ORDER);
$stream = $matches[1][0];
$stream = str_replace("\/", "/", $stream);
echo $stream;
header("Content-type: application/vnd.apple.mpegurl");
header("Location: $stream");
ob_end_flush();
?>