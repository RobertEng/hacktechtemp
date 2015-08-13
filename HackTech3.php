<!DOCTYPE html> <!-- saved from url=(0050)http://getbootstrap.com/examples/starter-template/ -->
<html lang="en"><head></head>

<body style="">


<div class="container"
	<div class="input-group">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<input class="form-control" type="text" name="search" value="<?php echo $search;?>">
		</form>
	</div>
</div>


<?php

// get topic from input box
$search="jon foreman";
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

//get related links
//$url = 'http://en.wikipedia.org/w/api.php?action=query&titles='.$search.'&prop=links&pllimit=500';


//get content text
$url = 'https://en.wikipedia.org/w/api.php?action=query&prop=extracts&exchars=100000&titles='.$search.'&format=xml';


//important code I don't understand
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_USERAGENT, 'MyBot/1.0 (http://www.mysite.com/)');

$result = curl_exec($ch);

if (!$result) {
  exit('cURL Error: '.curl_error($ch));
}

//changes wiki xml to plain text
function to_text($data)
{
	$data=preg_replace('/<\?xml version.+?preserve\">/',"",$data);
	$data=preg_replace('/<\/extr.+?api>/',"",$data);
	$data=preg_replace('/&lt;.*?&gt;/',"",$data);

	return $data;	//return string
}

//splits text into sentences
function sentence($data)
{
	preg_match_all('/[\.]+(^|\w|\s).*?\./',$data,$matches,PREG_SET_ORDER);

	echo count($matches)."<br>";

	$count=0;

	foreach($matches as $value){
		if($keyword!=null&&strripos($value[0],$keyword)==FALSE){
			array_splice($matches,array_search($value,$matches),1);
		}else{
			echo $value[0]."<br>";
			$count++;
		}
	}
	echo $count."=".count($matches)."<br>";
	return $matches;	//return array 
}

function question($data,$regex,$replace)
{
	foreach($data as $value){
		$value[0]=preg_replace($regex,$replace,$value[0]);

		echo $value[0]."<br>";
	}
}

$result=to_text($result);
echo $result;

//echo $result."<br><br>";
file_put_contents("temp.txt",$result);

?>


</body></html>
