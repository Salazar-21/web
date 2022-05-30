<?php
    if(isset($_POST['submit']))
    {
        $nombre = $_POST['nombre'];
        $estatura = $_POST['estatura'];
        $hobby = $_POST['hobby'];
        $id_color=$_POST['id_color'];
        $id_sexo=$_POST['id_sexo'];
        $id_mascota=$_POST['id_mascota'];
       $id_comida=$_POST['id_comida'];
        $id_postre=$_POST['id_postre'];
         $id_deporte=$_POST['id_deporte'];
          $id_electronico=$_POST['id_electronico'];
        //database details. You have created these details in the third step. Use your own.
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "amigos";

        //create connection
        $con = mysqli_connect($host, $username, $password, $dbname);
        //check connection if it is working or not
        if (!$con)
        {
            die("Connection failed!" . mysqli_connect_error());
        }
        //This below line is a code to Send form entries to database
        $sql = "INSERT INTO amigo (id, id_color, id_sexo, id_mascota, id_comida, id_postre,id_deporte,id_electronico, nombre, estatura, hobby) VALUES ('0', '$id_color', '$id_sexo', '$id_mascota','$id_comida', '$id_postre','$id_deporte','$id_electronico' '$nombre', '$estatura', '$hobby')";
      //fire query to save entries and check it with if statement
        $rs = mysqli_query($con, $sql);
        if($rs)
        {
            echo "Successfully saved";
        }
      //connection closed.
        mysqli_close($con);
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<link rel="stylesheet" type="text/css" href="guns.css">
<body>
<?php
echo "<table style='border: solid 1px red;'>";
echo "<tr><th>Id</th><th>Nombre</th><th>Nombre Real</th><th>Poderes</th><th>Primera Aparicion</th><th>Biografia</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }
  function current() {
    return "<td style='width:auto;border:1px solid red;'>" . parent::current(). "</td>";
  }
  function beginChildren() {
    echo "<tr>";
  }
  function endChildren() {
    echo "</tr>" . "\n";
  }
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amigos";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT `amigo`.`nombre`, `amigo`.`estatura`, `amigo`.`hobby`, `color`.`color`, `comida`.`comida`, `deporte`.`deporte`, `electronico`.`electronico`, `mascota`.`mascota`, `postre`.`postre`, `sexo`.`sexo`
FROM `amigo` 
  LEFT JOIN `color` ON `amigo`.`id_color` = `color`.`id` 
  LEFT JOIN `comida` ON `amigo`.`id_comida` = `comida`.`id`
  , `deporte`
  , `electronico` 
  LEFT JOIN `mascota` ON `amigo`.`id_mascota` = `mascota`.`id`
  , `postre` 
  LEFT JOIN `sexo` ON `amigo`.`id_sexo` = `sexo`.`id`;"
);
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>

 <a href="registro.html" >REGRESAR</a>

</body>
</html>
