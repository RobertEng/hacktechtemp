<?php
if (!isset($_POST['search']) && $_POST["search"]==0){
	$search = "stars";
	echo "<script>alert('I set it manually');</script>";
} else {
	$search=$_POST["search"];
	echo "<script>alert('Search is $search');</script>";
}
?>

<!DOCTYPE html> 
<html lang="en"><head></head>
<body>

<?php
echo "<form action='hacktech2.php' method='POST'>";
echo "<input type='text' name='search' value='stars'>";
echo "</form>";
 
//<?php
//get links
//$url = 'http://en.wikipedia.org/w/api.php?action=query&titles='.$search.'&prop=links&pllimit=500';

//raw content SAMPLE
//index.php?title=Main%20Page&action=raw
//OTHER SAMPLE
//api.php?action=query&prop=revisions&rvprop=content&format=xml&titles=Main%20Page

//get content text
$url = 'http://en.wikipedia.org/w/api.php?action=query&titles='.$search.'&prop=revisions&rvprop=content';

echo $result."<br><br>";
file_put_contents("temp.txt",$result);

?>
</body></html>
