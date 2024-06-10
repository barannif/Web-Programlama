<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Listesi</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Kayıtlı Kullanıcılar</h2>
        <div class="user-list">
            <?php
            function calculateAge($birthDate) {
                $birthDate = new DateTime($birthDate);
                $today = new DateTime('today');
                $age = $today->diff($birthDate)->y;
                return $age;
            }

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=kullanici_kaydi', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->query("SELECT firstName, lastName, email, birthDate FROM kullanicilar");

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="user">';
                    echo "<strong>İsim:</strong> " . htmlspecialchars($row['firstName']) . "<br>";
                    echo "<strong>Soyisim:</strong> " . htmlspecialchars($row['lastName']) . "<br>";
                    echo "<strong>E-posta:</strong> " . htmlspecialchars($row['email']) . "<br>";
                    echo "<strong>Yaş:</strong> " . calculateAge($row['birthDate']) . "<br>";
                    echo '</div>';
                }
            } catch (PDOException $e) {
                echo "Veritabanı bağlantı hatası: " . $e->getMessage();
            }
            ?>
        </div>
    </div>
</body>
</html>
