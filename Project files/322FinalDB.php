<html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie_proj";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<head>
  <title>Team 8 Movie Database</title>
<style>
  table, th, td {
	  color: #000000;
	  background-color: #ffffff;
    border: 1px solid black;
    border-collapse: collapse;
  }
  th, td {
    padding: 15px;
    text-align: left;
  }
</style>
<header>
	<h1>Team 8 Movie Database</h1>
	<h3>Welcome to Team 8's Movie DB!</h3>
</header>
</head>
<body>
  <p>View all:</p>
  <form method="post">
    <select name = "selectedList">
  		<option value="actors">Actors</option>
  		<option value="directors">Directors</option>
  		<option value="movies">Movies</option>
		  <option value="actors join movies">Actors Join Movies</option>
      <option value="directors join movies">Directors Join Movies</option>
	  <option value="insert actor">Insert New Actor</option>
  	</select>
    <input type="submit" name ="send" value="Submit"/>
</form>
		<table style="width:100%">
		<?php
    if(isset($_POST['send'])) {
    $selectOption = $_POST['selectedList'];
    switch ($selectOption) {
      case 'actors':
        $sql = "SELECT * FROM actors";
        $result = mysqli_query($conn, $sql);
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["actorName"]. "</td>
          <td>" . $row["actorGender"]. "</td>
          <td>" . $row["actorAge"]. "</td>
          </tr>";
        }
        break;
      case 'directors':
        $sql = "SELECT * FROM directors";
        $result = mysqli_query($conn, $sql);
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["directorName"]. "</td>
          <td>" . $row["directorAge"]. "</td>
          </tr>";
        }
        break;
      case 'movies':
        $sql = "SELECT * FROM movies";
        $result = mysqli_query($conn, $sql);
        while($row = $result->fetch_assoc()) {
          echo "<tr><td><img src=" . $row["moviePoster"]. "</td>
          <td>" . $row["movieRating"]. "</td>
          <td>" . $row["movieRuntime"]. "</td>
          <td>" . $row["moviePlot"]. "</td>
          <td>" . $row["movieGenre"]. "</td>
          </tr>";
        }
        break;
	  case 'actors join movies':
		  $sql = "SELECT * FROM Movies m, Acting ag, Actors ac
      WHERE m.movieID = ag.movieID AND ac.actorID = ag.actorID";
		  $result = mysqli_query($conn, $sql);
		  while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["actorName"]. "</td>
          <td>" . $row["actorAge"]. "</td>
          <td>" . $row["movieName"]. "</td>
          <td>" . $row["movieRating"]. "</td>
          </tr>";
        }
    case 'directors join movies':
    	$sql = "SELECT * FROM Movies m, Directing dg, Directors dc
      WHERE m.movieID = dg.movieID AND dc.directorID = dg.directorID";
    	$result = mysqli_query($conn, $sql);
    	while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["directorName"]. "</td>
          <td>" . $row["directorAge"]. "</td>
          <td>" . $row["movieName"]. "</td>
          <td>" . $row["movieRating"]. "</td>
          </tr>";
      }
		  break;
      case 'insert actor':
        $sql = "INSERT INTO actors (actorID, actorName, actorGender, actorAge)
VALUES ('20', 'Matt Damon', 'Male', '45')";
        $sql = "SELECT * FROM actors";		
        $result = mysqli_query($conn, $sql);
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["actorName"]. "</td>
          <td>" . $row["actorAge"]. "</td>
          <td>" . $row["actorGender"]. "</td>
          </tr>";
        }
        break;
    default:
      break;
    }
  }
  ?>
	</table>
	</body>
	<?php $conn->close(); ?>
</html>