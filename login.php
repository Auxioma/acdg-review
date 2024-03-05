<?php
    include 'Config/Database.php';

    // je veroifie si le formulaire a été soumis en methof POST 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // je vais recupéré le captcha de google
        if(empty($_POST['recaptcha-response'])) {
            $message = "Veuillez cocher le captcha";
        } else {
            if(isset($_POST['email']) && isset($_POST['pwd'])) {
                // on enleve tous les octé null et retourne un string
                $email = strip_tags($_POST['email']);
                $pwd = strip_tags($_POST['pwd']);

                // on verifie si l'email existe dans la base de donnée
                $sql = "SELECT * FROM users WHERE email = :email";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                // on recupere le resultat
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                // on verifie si le resultat est true 
                if($result) {
                    // on verifie si le mot de passe est correct
                    if(password_verify($pwd, $result['password'])) {
                        // on demarre la session
                        session_start();
                        $_SESSION['email'] = $result['email'];
                        header('Location: account.php');
                    } else {
                        $message = "Mot de passe incorrect";
                    }
                } else {
                    $message = "Email incorrect";
                }
            } else {
                $message = "Veuillez remplir tous les champs";
            }
        }
    } else {
        http_response_code(405);
        //die('Method Not Allowed');
    }

?>

<!DOCTYPE html>
<html lang="en">
<?php include '_partials/head.php'; ?>
<body>
<?php include '_partials/header.php'; ?>
<body>
<main>
    <div id="formulaire" class="my-5">
        <?= isset($message) ? "<div class='alert alert-danger text-center'>$message</div>" : "" ?>
        <form class="row col-xl-6 mx-auto" method="POST">
            <div class="col-12 col-xl-6 mb-4">
                <label for="validationDefault01" class="form-label">* Votre adresse mail</label>
                <input type="email" name="email" class="form-control" id="validationDefault01" value="" required>
            </div>
            <div class="col-12 col-xl-6 mb-4">
                <label for="validationDefault02" class="form-label">* Mot de passe</label>
                <input type="password" name="pwd" class="form-control" id="validationDefault02" value="" required>
            </div>
            <div class="col-12 mt-5 mb-2">
                <input type="hidden" id="recaptchaResponse" name="recaptcha-response">
            </div>
            <div class="col-12 my-5 text-center">
                <button class="btn btn-primary" type="submit" id="bouton_orange">Je me connect</button>
            </div>
        </form>
    </div>
</main>
<?php include '_partials/footer.php'; ?>
<script src="https://www.google.com/recaptcha/api.js?render=6LetgokpAAAAAHO-JNwaDzBsY2Wneo7DvrYhkG-G"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LetgokpAAAAAHO-JNwaDzBsY2Wneo7DvrYhkG-G', {
            action: 'homepage'
        }).then(function(token) {
            document.getElementById('recaptchaResponse').value = token
        });
    });
</script>
</body>
</html>