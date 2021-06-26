<?php
/*
 ┌────────────────────────────────────────────────────────────┐
 |  For More Modules Or Updates Stay Connected to Kodi dot AL |
 └────────────────────────────────────────────────────────────┘
 ┌───────────┬────────────────────────────────────────────────┐
 │ Product   │ Livestream.com Stream Extractor By Account ID  │
 │ Version   │ v1.1-DEV                                       │
 │ Provider  │ https://livestream.com/                        │
 │ Support   │ M3U8/VLC/KODI/SMART TV/Xream Codes/Web Players │
 │ Licence   │ MIT                                            │
 │ Author    │ Olsion Bakiaj                                  │
 │ Email     │ TRC4@USA.COM                                   │
 │ Author    │ Endrit Pano                                    │
 │ Email     │ INFO@ALBDROID.AL                               │
 │ Website   │ https://kodi.al                                │
 │ Facebook  │ /albdroid.official/                            │
 │ Github    │ github.com/SxtBox/                             │
 │ Created   │ Tuesday, 07 April 2020                         │
 │ Modified  │ Saturday, 26 June 2021                         │
 └────────────────────────────────────────────────────────────┘

 [PROCEDURE]
 [x] To Get Live Stream Required Account ID
 [EXAMPLE] FULL LINK => https://livestream.com/accounts/22300508/events/6675945
 YOU NEED TO PASSED => YOUR HOST/JW_Player.php?id=accounts/22300508/events/6675945
 PLAYER GENERATED FROM https://demo.kodi.al/My_Tools/Players_Tools/Player_Builder/JW_Player/
*/
error_reporting(0);
set_time_limit(0);
date_default_timezone_set("Europe/Tirane");

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}
$API_HOST = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/";
$ROOT_URL = $protocol . $_SERVER['SERVER_NAME'] . ($_SERVER['PHP_SELF']) . "";
$API_PATH = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "";
$PHP_FILE = "JW_Player.php" . "?id="; // PHP Name
	if(empty($_REQUEST["id"])) {
		exit( json_encode(array(
		"success" => false,
		"Platform" => "livestream.com JW Player",
		"Version" => "1.1 DEV",
		"Required" => "?id=accounts/xxx/events/xxx",
	    "Example" => "{$API_HOST}{$PHP_FILE}accounts/22300508/events/6675945",
		"GET_Structure" => "Regex",
		"PHP Code Generated From Host" => "demo.kodi.al/Framework",
		"PHP Code Generated Date" => "Saturday, June 26, 2021 - 17:35:35"
	)));
}

$channelid = $_GET["id"];
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

$MAIN_LINK = get_data("https://livestream.com/" . $channelid);
preg_match_all('/secure_m3u8_url":"(.*?)"/',$MAIN_LINK,$matches, PREG_PATTERN_ORDER);
$stream = $matches[1][0];
$stream = str_replace("\/", "/", $stream);
    header("Pragma: no-cache");
    header("Expires: 0");
    if (is_null($matches[1][0]))
    {
    echo 'Stream is NULL';
    }
    else
    {
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>livestream.com JW Player</title>
<link rel="shortcut icon" href="https://demo.kodi.al/My_Tools/Players_Tools/Player_Builder/JW_Player/favicon.ico"/>
<link rel="icon" href="https://demo.kodi.al/My_Tools/Players_Tools/Player_Builder/JW_Player/favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="JW Player Code Builder" />
<meta name="author" content="Olsion Bakiaj - Endrit Pano" />
<meta property="og:site_name" content="JW Player Code Builder">
<meta property="og:locale" content="en_US">
<meta name="msapplication-TileColor" content="#0F0">
<meta name="theme-color" content="#0F0">
<meta name="msapplication-navbutton-color" content="#0F0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#0F0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
<!-- Include CDN Player --/>
<script src="https://content.jwplatform.com/libraries/Jq6HIbgz.js"></script>
<!-- Include CDN Player -->
<script type="text/javascript" src="https://content.jwplatform.com/libraries/Jq6HIbgz.js"></script>

<style type="text/css">
#player{position:absolute;width:100%!important;height:100%!important;}
</style>
<!-- EXTRA CSS -->
<style type="text/css">
body,td,th {
	color: #0F0;
}
body {
	background-color: #000;
}
a:link {
	color: #0FC;
}
a:visited {
	color: #3F6;
}
a:hover {
	color: #09F;
}
a:active {
	color: #009;
}
</style>
<!-- EXTRA CSS -->
</head>

<body>
<?php
// AUTOMATIC PLAYER SWITCHING FOR ANDROID DEVICES
$ipod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iphone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$ipad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$android = stripos(strtolower($_SERVER['HTTP_USER_AGENT']),"android");
if(($ipod != true) &&( $iphone != true)&&( $ipad != true)&&( $android != true)){
?>

<!-- Player Configuration Reference --/>
https://developer.jwplayer.com/jwplayer/docs/jw8-player-configuration-reference
<!-- Player Configuration Reference -->
<!-- Include Player DIV id [Default player] -->
<div id="player"></div>

<script>
<!-- Include Player Instance [Default player] -->
jwplayer("player").setup({
playlist: [
    {
    image: "https://png.kodi.al/tv/albdroid/black.png",
    sources: [ 
    {file:" <?php echo ($stream); ?>"
	,}, 
    ] 
    }
	],
/* LOGO POSITIONS
top-right
bottom-left
bottom-right
bottom-left
*/
logo: {
    file: "https://png.kodi.al/tv/albdroid/smart_x254.png",
    position: "top-right"
},

skin: {
    name: "netflix",
// TO LOAD COLORS FROM CSS SKINS CLOSE THE 3 LINES IN EXTRA CONTROLS COLOR
// EXTRA CONTROLS COLOR
    active: "#0F0",
    inactive: "#0F0",
    background: "transparent"
// EXTRA CONTROLS COLOR
},

/* STRETCHING OPTIONS
RESOLUTION
stretching = object-fit
none =none
exactfit = fill
fill = cover
uniform	= contain*
*/
    //stretching: "uniform",
    stretching: "exactfit",
    controls: true,
    displaytitle: true,
    fullscreen: "true",
    height: "100%",
    width: "100%",
    fallback: false,
    repeat: true,
    autostart: false, 
    //primary: "flash",
    primary: "html5",
    aspectratio: "16:9",
    renderCaptionsNatively: false,
    abouttext: "Albdroid",
    aboutlink: "http://albdroid.al/",
    mute: false
});
</script>

<?php }else{ ?>
<!-- ANDROID PLAYER -->
<!-- Include Player DIV id [Default player] -->
<div id="player"></div>
<script>

<!-- Include Player Instance [Default player] -->
jwplayer("player").setup({
<!--  YOU CAN SET DIFFERENT SOURCE FOR ANDROID DEVICES HERE  -->
playlist: [
    {
    image: "https://png.kodi.al/tv/albdroid/black.png",
    sources: [ 
    {file: "<?php echo ($stream); ?>"
	,}, 
    ] 
    }
	],
/* LOGO POSITIONS
top-right
bottom-left
bottom-right
bottom-left
*/
logo: {
    file: "https://png.kodi.al/tv/albdroid/smart_x254.png",
    position: "top-right"
},

skin: {
    name: "netflix",
// TO LOAD COLORS FROM CSS SKINS CLOSE THE 3 LINES IN EXTRA CONTROLS COLOR
// EXTRA CONTROLS COLOR
    active: "#0F0",
    inactive: "#0F0",
    background: "transparent"
// EXTRA CONTROLS COLOR
},

/* STRETCHING OPTIONS
RESOLUTION
stretching = object-fit
none =none
exactfit = fill
fill = cover
uniform	= contain*
*/
    //stretching: "uniform",
    stretching: "exactfit",
    controls: true,
    displaytitle: true,
    fullscreen: "true",
    height: "100%",
    width: "100%",
    fallback: false,
    repeat: true,
    autostart: false, 
    //primary: "flash",
    primary: "html5",
    aspectratio: "16:9",
    renderCaptionsNatively: false,
    abouttext: "Albdroid",
    aboutlink: "http://albdroid.al/",
    mute: false
});
</script>
<?php } ?>
</body>
<?php
exit;
}
?>