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

if (isset($_GET['name'])) {
	//
	$chat		= '-156425806';
	$token	= '113484594:AAHePBzvcBtET8nJfiJCnCYVI6qmRY2nkTc';
	$value	= $_GET['name'];
	file_get_contents( 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$chat.'&text='.$value );

	//event history group
	$chat		= '-37549110';
	if ($value=='in_Lex'||$value=='out_lex') 
		file_get_contents( 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$chat.'&text='.$value );

	

//keylog++
$chat		= '-232990075';
if (stripos($value, "turkey") === false) ;
else file_get_contents( 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$chat.'&text=key');
//keylog--

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
else file_get_contents( 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$chat.'&text=tur_'.$value );
//1cGate--
}
?>
</html>
