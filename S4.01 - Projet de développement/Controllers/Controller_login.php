<?php
/**
 * @brief Classe qui prend en charge la connexion de l'utilisateur
 * 
 */

class Controller_login extends Controller
{

    /**
     * @inheritDoc
     */
    public function action_default()
    {
        $this->action_login_form();
    }

    public function action_login_form()
    {
        $this->render("login");
    }

    /**
     * Vérifie que le mot de passe correspond au mail
     * @return void
     */
    public function action_check_pswd()
    {
        $db = Model::getModel();
        if (isset($_POST['mail']) && isset($_POST['password'])) {
            if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST['mail'])) {
                $msg = "Ce n'est pas un email correct !";
            } else {
                $msg = "L'identifiant ou le mot de passe est incorrect !";
                // FIXME il faut mettre le déchiffrage du mot de passe
                if ($db->checkMailPassword(e($_POST['mail']), e($_POST['password']))) {
                    $role = $db->hasSeveralRoles();
                    if (isset($role['roles'])) {
                        $msg = $role;
                    } else {
                        header("Location: index.php?controller=$role&action=default");
                        return;
                    }
                }
            }

            $data = [
                'response' => $msg
            ];
            $this->render('login', $data);
        }
    }


    /**
     * Cette fonction va être appelée eu fur et à mesure que l'utilisateur tape son email afin de lui indiquer si son email existe
     * Elle vérifie si l'email existe dans la base de donnée, renvoie true si oui, false sinon
     * @return bool
     */
    // TODO - action pas appelé 

    public function action_check_mail()
    {
        $mailExisting = false;

        if (isset($_POST['mail'])) {
            $mail = e($_POST['mail']);
            //à chiffrer
            $bd = Model::getModel();
            $mailExisting = $bd->mailExists($mail);
        }

        return $mailExisting;
    }

}

