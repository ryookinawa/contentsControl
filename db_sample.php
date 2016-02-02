<?php
try {

    $pdo = new PDO('sqlite:db.splite');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $pdo->exec("CREATE TABLE IF NOT EXISTS fruit(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR(10),
        price INTEGER
    )");

    $pdo->exec("INSERT INTO fruit(name, price) VALUES ('みかん', '100')");

    $stmt = $pdo->prepare("INSERT INTO fruit(name, price) VALUES (?, ?)");
    foreach ([['りんご', '200'], ['バナナ', '200']] as $params) {
        $stmt->execute($params);
    }

    $r1 = $pdo->query("SELECT * FROM fruit WHERE price = '100'")->fetchAll();
    $stmt = $pdo->prepare("SELECT * FROM fruit WHERE price = ?");
    $stmt->execute(['200']);
    $r2 = $stmt->fetchAll();

    echo "<pre>";
    //var_dump($r1);
    print_r($r1);
    //var_dump($r2);
    echo "</pre>";


} catch (PDOException $e) {

    echo $e->getMessage() . PHP_EOL;
}
?>
