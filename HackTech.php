<!DOCTYPE html> <!-- saved from url=(0050)http://getbootstrap.com/examples/starter-template/ -->
<html lang="en"><head>
</head>

<body>


<?php
$search='star';
if (isset($_POST["search"])&&$_SERVER["REQUEST_METHOD"] == "POST")
{
	$search=test_input($_POST["search"]);
}
function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	<input type="text" name="search" value="<?php echo $search;?>">
</form>
<?php 

//get links
//$url = 'http://en.wikipedia.org/w/api.php?action=query&titles='.$search.'&prop=links&pllimit=500';


//get content text
$url = 'http://en.wikipedia.org/w/api.php?action=query&titles='.$search.'&prop=revisions&rvprop=content';




$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_USERAGENT, 'MyBot/1.0 (http://www.mysite.com/)');

$result = curl_exec($ch);

if (!$result) {
  exit('cURL Error: '.curl_error($ch));
}

function to_text($data)
{
	$data=preg_replace('/^(.|\n)*?information\./',"",$data);
	$data=strip_tags($data);
	$data=preg_replace('/\{\{(.|\n)*?\}\}/',"",$data);
//	$data=preg_replace('/\{(.|\n)*?\}/',"",$data);
//	$data=preg_replace('/\[\[File.*?\n/',"",$data);
//	$data=preg_replace('/\[\[[^\]]*?\|/',"",$data);
//	$data=preg_replace('/\[\[|\]\]/',"",$data);
//	$data=preg_replace('/&lt;(.|\n)*?gt;/',"",$data);
//	$data=trim($data);
//	$data=preg_replace('/&amp;.*?name.*?quot;/',"",$data);
//	$data=preg_replace('/&amp;.*?quot;/',"",$data);
//	$data=preg_replace('/&amp;.*?gt;/',"",$data);
//	$data=preg_replace('/&amp;.*?\n/',"",$data);
//	$data=preg_replace('/\'\'\'/',"",$data);

	return $data;
}
/*
function question($data)
{
	global $search;
//	preg_match_all('/(^| )a '.$search.'.+?\./',$data,$matches1,PREG_SET_ORDER);
	preg_match_all('/(^|\w|\s).*?\./',$data,$matches2,PREG_SET_ORDER);

//	echo count($matches1)."<br>";
	echo count($matches2)."<br>";
//	if(count($matches1)>count($matches2))
//		$matches=$matches1;
//	else
		$matches=$matches2;

	foreach($matches as $value){
		echo $value[0]."<br>";
	}
}*/

$result=to_text($result);
echo $result."<br><br>";
file_put_contents("temp.txt",$result);

//echo question($result);
?>





</body></html>
