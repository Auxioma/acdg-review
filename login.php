<?php
    include 'Config/Database.php';

    global $message;

    // je vais verifier que le post est souùis
    if(isset($_POST['mail']) && isset($_POST['pwd'])){
        $sql = "SELECT * FROM user WHERE email = :email AND is_valide = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute(
            [
                'email' => $_POST['mail']
            ]
        );

        $user = $stmt->fetch();

        if($user && password_verify($_POST['pwd'], $user['password'])){
            // je vais stocker les informations de l'utilisateur dans la session
            session_start();
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['email'] = $user['email'];

            // je vais rediriger l'utilisateur vers la page dashboard
            header('Location: dashboard.php');
        } else {
            $message = "Identifiants incorrects";
        }
    } else {
        $message = "Veuillez remplir tous les champs";
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
      <form class="row col-xl-6 mx-auto">
        <div class="col-12 col-xl-6 mb-4">
          <label for="validationDefault01" class="form-label">* Votre adresse mail</label>
          <input type="email" class="form-control" id="validationDefault01" value="" required>
        </div>
        <div class="col-12 col-xl-6 mb-4">
          <label for="validationDefault02" class="form-label">* Confirmer votre adresse mail</label>
          <input type="email" class="form-control" id="validationDefault02" value="" required>
        </div>
        <div class="col-8 mb-4">
          <label for="validationDefaultUsername" class="form-label">* Votre pseudo</label>
          <input type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2"
            required>
        </div>
        <div class="col-4 mb-4">
          <label for="validationDefaultUsername" class="form-label">* Date de naissance</label>
          <input type="date" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2"
            required>
        </div>
        <div class="col-12 mb-4">
          <p>
            Votre mot de passe doit contenir : <br><br>
            - 8 à 72 caractères <br>
            - 1 chiffre <br>
            - 1 minuscule <br>
            - 1 majuscule <br>
          </p>
        </div>
        <div class="col-12 col-xl-6 mb-4">
          <label for="validationDefault03" class="form-label">* Votre mot de passe</label>
          <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-lock"style="color: #f4661B;"></i></span>
            <input type="password" class="form-control" id="validationDefault03" required>
          </div>
        </div>
        <div class="col-12 col-xl-6 mb-4">
          <label for="validationDefault03" class="form-label">* Confirmer votre mot de passe</label>
          <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-lock"></i></span>
            <input type="password" class="form-control" id="validationDefault03" required>
          </div>
        </div>        
        <div class="col-12 my-2">
          <div class="form-check col-xl-12">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
            <label class="form-check-label" for="invalidCheck2">
              J'ai lu et j'accepte les conditions générales d'utilisation *
            </label>
          </div>
        </div>
        <div class="col-12 my-2">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2">
            <label class="form-check-label" for="invalidCheck2">
              Je souhaite recevoir la newsletter partenaire (bon plans, préventes...)
            </label>
          </div>
        </div>
        <div class="col-12 mt-5 mb-2">
          <span
            style="display: inline-block; width: 20px; height: 20px; margin-right: 5px; background-image: url(&quot;https://www.gstatic.com/recaptcha/api2/logo_48.png&quot;); background-repeat: no-repeat; background-size: 100%; background-position: center center; vertical-align: middle;"></span>
          <span>Protection par reCAPTCHA - </span>
          <a href="https://www.google.com/intl/fr/policies/privacy/" target="_blank"
            style="font-size: 10px; display: inline; color: rgb(136, 136, 136); margin-top: 10px; text-decoration: underline;">Confidentialité</a><span>
            - </span>
          <a href="https://www.google.com/intl/fr/policies/terms/" target="_blank"
            style="font-size: 10px; display: inline; color: rgb(136, 136, 136); margin-top: 10px; text-decoration: underline;">Conditions</a>
        </div>
        <div class="col-12 my-5 text-center">
          <button class="btn btn-primary" type="submit" id="bouton_orange">Je m'inscris</button>
        </div>
      </form>
    </div>
  </main>
  <?php include '_partials/footer.php'; ?>
</body>
</html>