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
 [x] To Get Live Stream Required YOU NEED TO PASSED LINK FROM => $MAIN_LINK VALUE
 [EXAMPLE] FULL LINK => https://livestream.com/accounts/22300508/events/6675945
 REQUIRED LiveStreamsPro ADDON [GET] https://addons.kodi.al/
 JUST RUN => YOUR HOST/Kodi_by_ID.php?id=accounts/22300508/events/6675945
*/

ob_start();
error_reporting(0);
set_time_limit(0);
date_default_timezone_set("Europe/Tirane");
$Stream_Provider = "Livestream Dot Com";
$channelid = $_GET["id"];
$MAIN_LINK = file_get_contents("https://livestream.com/" . $channelid);
preg_match_all("/title>(.*\w)</",
    $MAIN_LINK,
    $GET_STREAMS,
    PREG_SET_ORDER
);
// DEBUG ONLY
//$MAIN_LINK = 'https://livestream.com/accounts/22300508/events/6675945';
//$content = file_get_contents($MAIN_LINK);
// $explode_thumbnail = explode( '50x50.png","small_url":"' , $MAIN_LINK ); // 50x50

// REGEX https://rubular.com/r/37qT7pq2MIwjjk
$explode_thumbnail = explode( 'original_height":1200,"url":"' , $MAIN_LINK ); // FULL COVER
$thumbnail_explode = explode('"' , $explode_thumbnail[1] );
//echo $thumbnail_explode[0];

foreach ($GET_STREAMS as $TITULLI)
{
$STREAM_TITLE = utf8_encode($TITULLI[1]);
}
// REMOVE [on Livestream]
$REPLACE_STREAM_TITLE = str_replace(
    // REPLACE FROM
    array(" on Livestream"),
    // REPLACE TO
    array(""),
    $STREAM_TITLE
);
// M3U8 STREAM
preg_match_all('/secure_m3u8_url":"(.*?)"/',
    $MAIN_LINK,
    $streaming_content,
    PREG_SET_ORDER
);

/* REGEX LOGO
//preg_match_all('/.*small_url.*(http.*?170x170.*?)"/',
preg_match_all('/.*original_height":1200,"url":".*(http.*?.*?)"/',
    $MAIN_LINK,
    $thumbnail_regex,
    PREG_SET_ORDER
);
*/

if(!$channelid) die("<!DOCTYPE html>
<html lang=\"en\">
<head>
<title>Livestream Dot Com</title>
<link rel=\"shortcut icon\" href=\"favicon.ico\"/>
<link rel=\"shortcut icon\" href=\"favicon.ico\" type=\"image/x-icon\" />
<meta http-equiv=\"cache-control\" content=\"no-store\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
<meta name=\"description\" content=\"YouTube Playlist Generator\" />
<meta name=\"author\" content=\"OL.B - EN.P\" />
<meta property=\"og:site_name\" content=\"YouTube Playlist Generator\">
<meta property=\"og:locale\" content=\"en_US\">
<meta name=\"msapplication-TileColor\" content=\"#0F0\">
<meta name=\"theme-color\" content=\"#0F0\">
<meta name=\"msapplication-navbutton-color\" content=\"#0F0\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"apple-mobile-web-app-status-bar-style\" content=\"#0F0\">
<b>
<b>
<center>
<font color=red>Stream Error!!!
</b></center>
</font><br />
<body style='background-color:black'><b>
<center>
<font color=lime>PHP Script Don't Fetching Data From $Stream_Provider Server<br /><br />
Check /ID from Link If Is Online Or Regex Code if it is Correct
</b></center>
</font><br /><b>
<center>
<font color=lime>Contact: TRC4@USA.COM
</b></center>
</font><br /><b>
<center>
<font color=lime>Facebook: /albdroid.official/
</b></center>
<center>
<font color=lime>Github: github.com/SxtBox
</b></center>
</font><br />");
else
{
// die("Need URL parameter");
if(!$MAIN_LINK) die("<!DOCTYPE html>
<html lang=\"en\">
<head>
<title>Livestream Dot Com</title>
<link rel=\"shortcut icon\" href=\"favicon.ico\"/>
<link rel=\"shortcut icon\" href=\"favicon.ico\" type=\"image/x-icon\" />
<meta http-equiv=\"cache-control\" content=\"no-store\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
<meta name=\"description\" content=\"YouTube Playlist Generator\" />
<meta name=\"author\" content=\"OL.B - EN.P\" />
<meta property=\"og:site_name\" content=\"YouTube Playlist Generator\">
<meta property=\"og:locale\" content=\"en_US\">
<meta name=\"msapplication-TileColor\" content=\"#0F0\">
<meta name=\"theme-color\" content=\"#0F0\">
<meta name=\"msapplication-navbutton-color\" content=\"#0F0\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"apple-mobile-web-app-status-bar-style\" content=\"#0F0\">
<b>
<b>
<center>
<font color=red>Stream Error!!!
</b></center>
</font><br />
<body style='background-color:black'><b>
<center>
<font color=lime>PHP Script Don't Fetching Data From $Stream_Provider Server<br /><br />
Check Your Link If Is Online Or Regex Code if it is Correct
</b></center>
</font><br /><b>
<center>
<font color=lime>Contact: TRC4@USA.COM
</b></center>
</font><br /><b>
<center>
<font color=lime>Facebook: /albdroid.official/
</b></center>
<center>
<font color=lime>Github: github.com/SxtBox
</b></center>
</font><br />");
}
header("Content-Type: application/rss+xml; charset=utf-8");
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
foreach ($streaming_content as $item)
{
$stream = trim($item[1]);
//$thumbnail = "https://png.kodi.al/tv/albdroid/smart_x1.png"; // YOUR OWN MANUAL LOGO
// $thumbnail = $thumbnail_regex[0][1]; // REGEX
$thumbnail = $thumbnail_explode[0]; // EXPLODE
$Hosted_by = "Hosted by Albdroid.AL";
echo "<item>\n";
echo "<title>[COLOR lime][B]".$REPLACE_STREAM_TITLE."[/COLOR][/B]</title>\n";
echo "<link>".$stream."</link>\n";
echo "<thumbnail>".$thumbnail."</thumbnail>\n";
echo "<fanart>".$thumbnail."</fanart>\n";
echo "<Stream_Provider>".$Stream_Provider."</Stream_Provider>\n";
echo "<Hosted_by>".$Hosted_by."</Hosted_by>\n";
echo "<genre>[COLOR lime][B][I]Albdroid[/I][/B][/COLOR][COLOR lime][B][I] [COLOR red]([/COLOR]".$REPLACE_STREAM_TITLE."[COLOR red])[/I][/B][/COLOR]</genre>\n";
echo "<info>[COLOR lime][B]Website:[/B][/COLOR] [COLOR red][B]([/B][/COLOR][COLOR lime][B]Albdroid.AL[/B][/COLOR] [COLOR red][B]&amp;[/B][/COLOR] [COLOR lime][B]Kodi.AL[/B][/COLOR][COLOR red][B])[/B][/COLOR]</info>\n";
echo "</item>\n\n";
}
ob_end_flush();
?>
