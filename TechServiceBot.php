<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>TechServiceBot</title>
</head>
<form method='get'>
</form>

<?php
function prepareStringForReturn($value)
{
	$value	= str_replace('+','%2B',$value);
	$value	= str_replace(' ','%20',$value);
	$value	= str_replace('\n','%0a',$value);
	return $value;
}

function Query($query)
{
	$host	= "localhost";
	$user	= "root";
	$pwd	= "";
	$dbase	= "u440813_ice";
	$answerLine	= "";

	$link = mysqli_connect($host, $user, $pwd, $dbase);

	/* check connection */
	if (mysqli_connect_errno()) {
	    $answerLine	= $answerLine."Unable to connect DB: %s\n".mysqli_connect_error();
	    exit();
	}

	/* run multiquery */
	if (mysqli_multi_query($link, $query)) {
	    do {
	        /* get first result data */
	        if ($result = mysqli_store_result($link)) {
	            while ($row = mysqli_fetch_row($result)) {
	                $answerLine	= $answerLine.implode(' # ',$row)."\n";
	            }
	            mysqli_free_result($result);
	        }
	        /* print divider */
	        if (mysqli_more_results($link)) {
	        	$answerLine	= $answerLine."### ";
	        }

	    } while (mysqli_next_result($link));
	}
	/* close connection */
	mysqli_close($link);

	return $answerLine;

}

function saveToLog($value)
{
	$host='u440813.mysql.masterhost.ru';
	$database='u440813_ice';
	$user='u440813';
	$pswd='2ndESs.NGlITi';
	$dbh = mysql_connect($host, $user, $pswd) or die("can't connect MySQL.");
	mysql_select_db($database) or die("can't connect base.");
	if (substr($value,0,2)=='in')
	{
		$state	= "0";
		$username	= substr($value,3-strlen($value));
	}
	else
	{
		$state="1";
		$username	= substr($value,4-strlen($value));
	}

	$query = "INSERT INTO `u440813_ice`.`iceDoorEvents` (`EventDate`, `State`, `UserName`) VALUES ('".date("Y-m-d H:i:s",time())."','".$state."','".$username."')";
	$res = mysql_query($query);
}

//receive data from bot
$json = file_get_contents('php://input');
$action = json_decode($json, true);
$message	= $action['message']['text'];
$chat		= $action['message']['chat']['id'];
$user		= $action['message']['from']['id'];
$token	= '113484594:AAHePBzvcBtET8nJfiJCnCYVI6qmRY2nkTc';
$answer	= '';

if (substr($message,0,5)=='/sql ')
{
	if ($chat=='-159425922')
	{
		$answer	= urlencode(Query(substr($message,5-strlen($message))));
		//elseif (substr($message,0,5)=='/help') $answer='I am an SQL terminal bot.%0aU can send me a queries, then i send u an answer.%0aReference manual of MySql query language:%0ahttp://dev.mysql.com/doc/refman/5.7/en/examples.html%0aFor example, send me this query:%0a/sql select 1';
		//elseif ($chat==$user) $answer	= urlencode(Query($message));
		if ($answer!='') {
			$safe_vars = array();
			$safe_vars[0] = urlencode('text').'='.$answer;
			$safe_vars[1] = urlencode('chat_id').'='.$chat;
			file_get_contents('https://api.telegram.org/bot'.$token.'/sendMessage?'.join('&',$safe_vars));
		}
	}
}
else
{
	if (isset($_GET['name'])) {
		$chat		= '-1001114573373';		
		$value	= $_GET['name'];
		//saveToLog($value);//DISABLED
		file_get_contents( 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$chat.'&text='.$value );

		//1cGate++
		$chat		= '-159425922';
		if (
			stripos($value, "artem") === false &&
			stripos($value, "maksim") === false &&
			stripos($value, "lex") === false &&
			stripos($value, "Vladimir_Polukhin") === false &&
			stripos($value, "Oleg_Semenov") === false &&
			stripos($value, "in_VictorB") === false
		) ;
		else file_get_contents( 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$chat.'&text='.$value );
		//1cGate--
	}
}

?>
</html>
