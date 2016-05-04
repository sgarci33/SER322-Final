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

      default:
        break;
    }
  }
  ?>
	</table>
	</body>
	<?php $conn->close(); ?>
</html>
