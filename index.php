<!DOCTYPE html>
<html>
<head>
<style>
h2{color:#902923;font-size:20px;}
p{color:#902923;font-size:16px;}
a{color:black;font-size:16px;}
</style>
</head>
<body>
<center>
<img src="Movies.jpg" alt="centered image"/>
<center/>
<h2>Search for a movie</h2>
<form action="showMovie.php" method="post">
    <p>Title: <input type="text" name="title" /></p>
    <p>Genre: <input type="text" name="genre" /></p>
	<p>Rating: <input type="text" name="rating" /></p>
	<p>Year: <input type="text" name="year" /></p>
    <p><input type="submit" value="Submit" /></p>
</form>
<p>Top 10 searched movies</p>
<?php /* To display the top 10 movies */
 /* Create local variables -  the code line is too long! */
 $l = "localhost";
 
/* Connect to database */
$dbConnect = mysqli_connect("$l", "root", "usbw", "moviesdb");
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
/* Query the database */
$sql = "SELECT `Title` FROM `movies` WHERE `Counter` > 0 
ORDER BY `Counter` DESC LIMIT 10;";
mysqli_query($dbConnect, $sql);
if ($result = mysqli_query($dbConnect, $sql))
	
/* Display movie Title in a table */
if(mysqli_num_rows($result) > 0) {
echo "<table border='1'>";
while ($record = mysqli_fetch_assoc($result)) {
echo "<tr><td>{$record['Title']}</td></tr>";
}
echo "</table>";
mysqli_free_result($result);
}
mysqli_close($dbConnect);

?>
</body>
</html> 
