<?php
    include '../Config/database.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // je vais télécharger l'image
        $avatar = $_FILES['avatar'];
        $avatarName = $avatar['name'];
        $avatarTmpName = $avatar['tmp_name'];
        $avatarSize = $avatar['size'];
        $avatarError = $avatar['error'];

        $avatarExtension = explode('.', $avatarName);
        $avatarExtension = strtolower(end($avatarExtension));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if(in_array($avatarExtension, $allowedExtensions)){
            if($avatarError === 0){
                if($avatarSize < 1000000){
                    $avatarNewName = uniqid('', true) . '.' . $avatarExtension;
                    $avatarDestination = '../assets/img/' . $avatarNewName;
                    move_uploaded_file($avatarTmpName, $avatarDestination);
                }else{
                    echo 'Your file is too big';
                }
            }else{
                echo 'There was an error uploading your file';
            }
        }else{
            echo 'You cannot upload files of this type';
        }

        // je vais créer l'utilisateur
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $birth_date = $_POST['birth_date'];
        $gender = $_POST['gender'];
        $is_valide = isset($_POST['is_valide']) ? 1 : 0;

        $data = [
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $password,
            'birth_date' => $birth_date,
            'is_valide' => $is_valide,
            'date' => date('Y-m-d H:i:s'),
        ];

        $sql = "INSERT INTO user (pseudo, email, password, birth_date, is_valide, picture, created_at) 
        VALUES (:pseudo, :email, :password, :birth_date, :is_valide)";
        $req = $conn->prepare($sql);
        $req->execute($data);

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create User</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="pseudo" placeholder="pseudo"><br>
        <input type="email" name="email" placeholder="email"><br>
        <input type="password" name="password" placeholder="password"><br>
        <input type="date" name="birth_date" placeholder="birth_date"><br>
        <select name="gender"><br>
            <option value="Monsieur">Monsieur</option>
            <option value="Madame">Madame</option>
        </select>
        <input type="checkbox" name="is_valide"><br>
        <input type="file" name="avatar"><br>
        <button type="submit">create user</button>
    </form>
</body>
</html>