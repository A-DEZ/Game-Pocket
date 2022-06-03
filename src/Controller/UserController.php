<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Service\FormService;

class UserController extends AbstractController
{

    public function login(): string
    {
        $messageErreur = "";

        if (isset($_POST['username'])) {
            $username = stripslashes($_REQUEST['username']);
            $password = stripslashes($_REQUEST['password']);
            $userManager = new UserManager();
            $user = $userManager->checkUser($username);
            if (isset($user['password'])) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    header("Location:/");
                } else {
                    $messageErreur = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                }
            } else {
                $messageErreur = "Le nom d'utilisateur ou le mot de passe est incorrect.";
            }
        }
        return $this->twig->render('User/login.html.twig', [
            'erreur' => $messageErreur
        ]);
    }

    public function logout(): string
    {
        unset($_SESSION['user']);
        header("Location:/");
        return $this->twig->render('Home/index.html.twig');
    }


    public function register(): string
    {
        $formSuccess = "";
        $formService = new FormService();
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $username = $formService->testInput($_POST['username']);
            $name =  $formService->testInput($_POST['name']);
            $mail = $formService->testInput($_POST['mail']);
            $passwordIni = $formService->testInput($_POST['password']);
            $role = $formService->testInput($_POST['role']);
            $required = ['username', 'name', 'mail', 'password', 'role'];

            $folder = "../public/assets/images/user/";
            $extAvatar = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $uniqFile = uniqid('', true);
            $avatar = $uniqFile . "." . $extAvatar;

            $password = password_hash($passwordIni, PASSWORD_BCRYPT);
            $formService->emptyCheck($required);
            $formService->mailCheck($mail);
            $formService->textCheck($username);
            $formService->textCheck($name);
            $formService->extensionCheck($extAvatar);
            $formService->sizeCheck($_FILES['avatar']['tmp_name']);
            $newUser = [$username, $name, $mail, $password, $role, $avatar];

            move_uploaded_file($_FILES['avatar']['tmp_name'], $folder . $avatar);


            if (empty($formService->getErrors())) {
                $userManager = new UserManager();
                $userManager->newRegister($newUser);
                $formSuccess = "Votre compte a bien été créé";
                header('Location:/user/login');
            }
        }
        return $this->twig->render('Game/register.html.twig', [
            "errors" => $formService->getErrors(),
            "formSuccess" => $formSuccess
        ]);
    }
}
