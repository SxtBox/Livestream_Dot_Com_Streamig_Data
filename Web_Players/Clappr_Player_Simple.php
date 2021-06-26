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
 YOU NEED TO PASSED => YOUR HOST/Clappr_Player.php?id=accounts/22300508/events/6675945
Advanced Clappr Player Generator https://demo.kodi.al/My_Tools/Players_Tools/Player_Builder/Clappr_Player/
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
$PHP_FILE = "Clappr_Player_Simple.php" . "?id="; // PHP Name
	if(empty($_REQUEST["id"])) {
		exit( json_encode(array(
		"success" => false,
		"Platform" => "livestream.com Clappr Player",
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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>livestream.com Clappr Player</title>
<link rel="shortcut icon" href="https://kodi.al/favicon.ico"/>
<link rel="icon" href="https://kodi.al/favicon.ico"/>
<script src="https://cdn.jsdelivr.net/clappr/latest/clappr.min.js"></script>
</head>
<style type="text/css">
body,td,th {
	color: #0F0;
}
body {
	background-color: #000;
}
</style>
<body>
<div id="player" style="width:100%; height:100%"></div>
<script>
    var player = new Clappr.Player({
    source: "<?php echo ($stream); ?>",
    parentId: "#player",
    width:'100%',
    height:'100%',
    //mimeType: 'audio/mpeg',
    mimeType: 'video/m3u8',
    autoPlay: false,
});
</script>
</body>
</html>
<?php
exit;
}
?>