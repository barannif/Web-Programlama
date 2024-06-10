<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Kaydı</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script>
        function validateForm() {
            var email = document.forms["registerForm"]["email"].value;
            var password = document.forms["registerForm"]["password"].value;
            var confirmPassword = document.forms["registerForm"]["confirmPassword"].value;

            if (email == "" || password == "" || confirmPassword == "") {
                alert("Tüm alanlar doldurulmalıdır.");
                return false;
            }

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert("Geçerli bir e-posta adresi giriniz.");
                return false;
            }

            if (password.length < 6) {
                alert("Şifre en az 6 karakter olmalıdır.");
                return false;
            }

            if (password != confirmPassword) {
                alert("Şifreler eşleşmiyor.");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Kullanıcı Kaydı</h2>
        <form name="registerForm" action="form_islemi.php" method="post" onsubmit="return validateForm()">
            İsim: <input type="text" name="firstName" value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : ''; ?>"><br>
            Soyisim: <input type="text" name="lastName" value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>"><br>
            E-posta: <input type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"><br>
            Şifre: <input type="password" name="password"><br>
            Şifre Tekrar: <input type="password" name="confirmPassword"><br>
            Cinsiyet: 
            <select name="gender">
                <option value="male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'male') ? 'selected' : ''; ?>>Erkek</option>
                <option value="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'female') ? 'selected' : ''; ?>>Kadın</option>
                <option value="other" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'other') ? 'selected' : ''; ?>>Diğer</option>
            </select><br>
            Doğum Tarihi: <input type="date" name="birthDate" value="<?php echo isset($_POST['birthDate']) ? htmlspecialchars($_POST['birthDate']) : ''; ?>"><br>
            
            
            <input type="submit" value="Kaydet">
        </form>
    </div>
</body>
</html>
