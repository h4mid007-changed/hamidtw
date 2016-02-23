<?php
if (file_exists('status')) {
	goto a;
	}
	else {
		echo 'has been disabled';
		exit();
		}
		a:
ini_set('display_errors', 1);
$de = file_get_contents('php://input');
$d = json_decode($de);
$cid = $d->message->message_id;
$mid = $d->message->chat->id;
$mes = urldecode($d->message->text);
if ($mes == 'on') {
	file_put_contents('status', 'started');
file_get_contents("https://api.telegram.org/bot187599120:AAHda6D2dDQGcwl7Ly830YoJPTSj_0_Tk-A/sendMessage?chat_id=$mid&text=ok");
exit();
}
if ($mes == 'off') {
	//file_put_contents('status', 'started');
	unlink(realpath('status'));
	unlink('status');
	exec('rm status');
exec('rm maxid');
	file_get_contents("https://api.telegram.org/bot187599120:AAHda6D2dDQGcwl7Ly830YoJPTSj_0_Tk-A/sendMessage?chat_id=$mid&text=ok");
exit();
	}
	if(strpos($mes, '/change')) {
		$key = str_replace('/change ', '', $mes);
		file_put_contents('status', '?q=' . $key . ' -filter:replies&result_type=recent&count=100');
		exit();
		}
		$max = file_get_contents('maxid');
		$maxid = '&max_id=' . $max;
		$get = file_get_contents('status');
$ur = 'https://api.twitter.com/1.1/search/tweets.json';
$url = $ur . $get . $maxid;
$ch = curl_init($url);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer AAAAAAAAAAAAAAAAAAAAALNCkQAAAAAAXvKjcKMxIZanY3CmSZu%2FPzqijm0%3DivK1tnZQxDXKk8tIPCsshupbshclYxp7ftXh7EiVFKhm7msMdL')); 
$res = curl_exec($ch);
$tweets = json_decode($res);
//echo $url;
//echo $res;
$tweet = $tweets->statuses;
$x = 99;
while ($x >= 0) {
	if ($tweet[x]->id_str > $max) {
$text = $tweet[$x]->text;
$named = $tweet[$x]->user->name;
$username = $tweet[$x]->user->screen_name;
$createdat = $tweet[$x]->created_at;
$src_dt = $createdat;
$src_tz =  new DateTimeZone
('UTC');
$dest_tz = new DateTimeZone
('Asia/Tehran');
$dt = new DateTime($src_dt, $src_tz);
$dt->setTimeZone($dest_tz);
$twtime = $dt->format('Y-m-d H:i:s');
$tosen = "$named (@$username):\n$text\n$twtime";
$tosend = urlencode($tosen);
file_get_contents("https://api.telegram.org/bot187599120:AAHda6D2dDQGcwl7Ly830YoJPTSj_0_Tk-A/sendMessage?chat_id=32709704&text=$tosend");
}
$x--;
}
file_put_contents('maxid', $tweet[0]->id_str);
