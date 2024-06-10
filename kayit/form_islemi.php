<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $birthDate = $_POST['birthDate'];
    $gender = $_POST['gender'];
    $kvkk = isset($_POST['kvkk']) ? $_POST['kvkk'] : '';

    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword)) {
        die("Tüm alanlar doldurulmalıdır.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Geçerli bir e-posta adresi giriniz.");
    }

    if ($password !== $confirmPassword) {
        die("Şifreler eşleşmiyor.");
    }

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=kullanici_kaydi', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM kullanicilar WHERE email = ?");
        $stmt->execute([$email]);
        $emailExists = $stmt->fetchColumn();

        if ($emailExists) {
            echo "<script>alert('Bu e-posta adresi zaten kayıtlı. Lütfen farklı bir e-posta adresi giriniz.'); window.history.back();</script>";
            exit;
        }

        

        $stmt = $pdo->prepare("INSERT INTO kullanicilar (firstName, lastName, email, password, birthDate, gender) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $email, password_hash($password, PASSWORD_BCRYPT), $birthDate, $gender]);

        echo "Kullanıcı başarıyla kaydedildi.";
    } catch (PDOException $e) {
        echo "Veritabanı bağlantı hatası: " . $e->getMessage();
    }
}
?>
