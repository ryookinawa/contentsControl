<table border="1">
<tr><th>ID</th><th>NAME</th></tr>

<?php
try {

    $dir    = '/Library/WebServer/Documents';
    //$dir    = '/tmp';
    $files1 = scandir($dir);

    $pdo = new PDO('sqlite:db.splite');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $pdo->exec("DROP TABLE allpath");

    $pdo->exec("CREATE TABLE IF NOT EXISTS allpath(
        id INTEGER PRIMARY KEY ,
        name VARCHAR(100)
    )");

    //print_r ($files1);

    //$sql = "INSERT INTO allpath (id,name) VALUES (:id,:name)";
    $sql = "REPLACE INTO allpath (id , name) VALUES(:id , :name)";
    //$sql = "UPDATE allpath set name = :name , id = :id";
    $stmt = $pdo->prepare($sql);
    foreach ( $files1 as $key => $value) {
      $stmt->bindParam(':id',$key,PDO::PARAM_INT);
      $stmt->bindParam(':name',$value,PDO::PARAM_STR);
      $stmt->execute();
    }

    /*
    $cnt = count($files1);

    for( $i = 0 ;$i < $cnt ;$i++){
      print($files1[$i]."<br />");
      $sql = "INSERT INTO allpath (id,name) VALUES (:id,:name)";
      $stmt=$pdo->prepare($sql);
      $stmt->bindParam(':id',$i,PDO::PARAM_INT);
      $stmt->bindParam(':name','$files1[$i]',PDO::PARAM_STR);
      $stmt->excute();
    }
    */

    $r1 = $pdo->query("SELECT * FROM allpath");
    //$r1 = $pdo->query("SELECT * FROM allpath")->fetchAll();
    /*
    $r1 = $pdo->query("SELECT * FROM allpath");
    while ($row = $r1->fetchAll()) {
	$keys = array_keys($row);
        print($keys);
	//$id = htmlspecialchars($row['id']);
	//$id = $row["id"];
	//$name =  htmlspecialchars($row['name']);
	//echo "<tr><td>$id</td><td>$name</td></tr>";
    }
    */
      foreach ($r1 as $row){
      //echo "<pre>";
      //echo "<tr><td>$row["id"]</td><td>$row["name"]</td></tr>";
      //print ($row["id"]);
      //print ($row["name"]);
      print '<tr><td>' . $row["id"] .'</td><td>' . $row["name"] . '</td></tr>';
      //echo "</pre>";
      }
    //$stmt = $pdo->prepare("SELECT * FROM allpath WHERE name = ?");
    //$stmt = $pdo->prepare("SELECT * FROM allpath);
    //$stmt->execute(['*']);
    //$stmt->execute(['*']);
    //$r2 = $stmt->fetchAll();

    //echo "<pre>";
    //var_dump($r1);
    //print_r($r1);
    //var_dump($r2);
    //echo "</pre>";


} catch (PDOException $e) {

    echo $e->getMessage() . PHP_EOL;
}
?>
</table>
