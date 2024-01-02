<?php
define('DB_HOST', 'postgres');
define('DB_USER', 'admin');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'caller.ID');

try {
    $pdo = new PDO("pgsql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $phone_number = $_POST['phone_number'];
        $phone_number = str_replace('+', '', $phone_number);

        $sql = "SELECT * FROM number WHERE phone_number = :phone_number";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            echo "+" . $phone_number . "<br>";
            foreach ($result as $row) {
                echo $row["name"] . "<br>";
            }
        } else {
            echo "Номер не найден";
        }
    }

    $pdo = null;
} catch (PDOException $e) {
    echo 'Ошибка подключения к БД: ' . $e->getMessage();
}
?>
