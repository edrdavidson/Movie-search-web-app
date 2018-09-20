<?php
/**
 * Web Programming Project (18/09/2018)
 *
 * This program demontrates a PHP web portal to a movie database
 * Functionality includes search via fields and show top 10 searched Titles
 *
 * The showMovie.php page
 *
 * PHP version 5.6
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Edward Davidson <author@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */	
 
 /* Create local variables -  the code line is too long! */
 $l = "localhost";
 
/* Connect to database */
$dbConnect = mysqli_connect("$l","root","usbw","moviesdb");
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}

/* Query database to SELECT based on posted variables*/

$sql = "SELECT Title,Studio,Status,Sound,Versions,RecRetPrice,
Rating,Year,Genre,Aspect FROM `movies` WHERE " ;
if(!empty($_POST['title'])) $sql .= " `title` = '"
.mysql_real_escape_string($_POST['title'])."' AND ";
if(!empty($_POST['genre'])) $sql .= " `genre` = '"
.mysql_real_escape_string($_POST['genre'])."' AND ";
if(!empty($_POST['rating'])) $sql .= " `rating` = '"
.mysql_real_escape_string($_POST['rating'])."' AND ";
if(!empty($_POST['year'])) $sql .= " `year` = '"
.mysql_real_escape_string($_POST['year'])."' AND ";
$sql = substr($sql,0,-4);
$sql .= " order by `title`";

if ($result = mysqli_query($dbConnect, $sql)) {
if(mysqli_num_rows($result) > 0) {
printf("Select returned %d rows.<br />\n", mysqli_num_rows($result));
echo "<table border='1'>";
echo "<tr><th>Title</th><th>Studio</th><th>Status</th><th>Sound</th>
<th>Versions</th><th>Price</th><th>Rating</th><th>Year</th>
<th>Genre</th><th>Aspect</th></tr>";
while ($record = mysqli_fetch_assoc($result)) {
echo "<tr><td>{$record['Title']}</td>";
echo "<td>{$record['Studio']}</td>";
echo "<td>{$record['Status']}</td>";
echo "<td>{$record['Sound']}</td>";
echo "<td>{$record['Versions']}</td>";
echo "<td>{$record['RecRetPrice']}</td>";
echo "<td>{$record['Rating']}</td>";
echo "<td>{$record['Year']}</td>";
echo "<td>{$record['Genre']}</td>";
echo "<td>{$record['Aspect']}</td></tr>";
}
echo "</table>";
mysqli_free_result($result);
} else {
echo "<p>Sorry No Movies Were Found..</p>";
}
}	
else {	
printf("%s.<br />\n", mysqli_error($dbConnect));
}
/* UPDATE count */
$title = $_POST['title'];
$sql = "UPDATE `movies` SET `Counter` = `Counter` + 1 WHERE `Title` = '$title';";
if (mysqli_query($dbConnect, $sql) === TRUE) {
printf("Counter UPDATED by: %d<br />\n", mysqli_affected_rows($dbConnect));
}
mysqli_close($dbConnect);
echo "<a href='index.php'> Return to Home</a><br>";
?>