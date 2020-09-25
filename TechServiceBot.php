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

//receive data from bot
$json = file_get_contents('php://input');
$action = json_decode($json, true);
$message	= $action['message']['text'];
$chat		= $action['message']['chat']['id'];
$user		= $action['message']['from']['id'];
$token	= '113484594:AAHePBzvcBtET8nJfiJCnCYVI6qmRY2nkTc';
$answer	= '';

if (isset($_GET['name'])) {
	$chat		= '-1001114573373';		
	$value	= $_GET['name'];
	file_get_contents( 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$chat.'&text='.$value );

	//1cGate++
	$chat		= '-159425922';
	if (
		stripos($value, "artem") === false &&
		stripos($value, "maksim") === false &&
		stripos($value, "lex") === false &&
		stripos($value, "Vladimir_Polukhin") === false &&
		stripos($value, "Oleg_Semenov") === false &&
		stripos($value, "Anna_1c") === false &&
		stripos($value, "Ivan_T") === false &&
		stripos($value, "VictorB") === false
	) ;
	else file_get_contents( 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$chat.'&text='.$value );
	//1cGate--
}

?>
</html>
