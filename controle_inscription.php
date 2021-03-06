<?php
session_start();

if (isset($_POST['submit'])) {
    include('modele_inscription.php');
        }



    //erreurs
    if(empty($nom) || empty($prenom) ||  empty($numero) || empty($password)) {
      header("Location: Enregistrement2.php?enregistrement=vide");
      exit();
    } else {
      //caractères valides
              if (!preg_match("/^[a-zA-Z ]*$/", $nom) || !preg_match("/^[a-zA-Z ]*$/", $prenom)) {
                  header("Location: vue_inscription.php?enregistrement=invalidenoms");
                  exit();
              } else {
                    if (!preg_match("/^[0-9]*$/", $numero)) {
                    header("Location: vue_inscription.php?enregistrement=invalidetel");
                    exit();
                } else {
                  if (!preg_match("/^[a-zA-Z0-9 ]*$/", $adresse)) {
                    header("Location: vue_inscription.php?enregistrement=invalideadr");
                    exit();
                  } else {
                    if (!preg_match("/^[0-9]*$/", $codepostal)) {
                      header("Location: vue_inscription.php?enregistrement=invalidecp");
                      exit();
                    } else {
                      if (!preg_match("/^[a-zA-Z -]*$/", $ville)) {
                        header("Location: vue_inscription.php?enregistrement=invalidevil");
                        exit();
                      } else {                  }

                      // mot de passe égaux
                      if ($password != $passwordconfirmation) {
                        header("Location: vue_inscription.php?enregistrement=mdp");
                        exit();
                    } else {
                  if (isset($_POST['CGU'])) {
                    //Hash mdp
                    $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
                    //inserer
                        $req = $bdd->prepare("INSERT INTO personne(nom, prenom, email, telephone, mot_de_passe) VALUES(:nom, :prenom, :email, :numero, :password)");
                        $req->execute(array(
                        	'nom' => $nom,
                        	'prenom' => $prenom,
                        	'email' => $email,
                        	'numero' => $numero,
                        	'password' => $hashedpassword,
                        	));
                        $id_personne = $bdd->lastInsertId();
                        $date = date("Y-m-d");
                        $req2 = $bdd->prepare("INSERT INTO utilisateur(id_personne, newsletter, date_adhesion, numero, rue, complement, code_postal, ville, pays) VALUES(:id_personne, :newsletter, :date_adhesion, :numero, :rue, :complement, :codepostal, :ville, :pays)");
                        $req2->execute(array(
                          'id_personne' => $id_personne,
                          'newsletter' => $newsletter,
                          'date_adhesion' => $date,
                          'numero' => $numerop,
                          'rue' => $rue,
                          'complement' => $complement,
                          'codepostal' => $codepostal,
                          'ville' => $ville,
                          'pays' => $pays,
                          ));
                          session_destroy();
                          // if ($req->execute()) {
                          header("Location: vue_accueil.php");
                          exit();
                        // } else {header("Location: Enregistrement2.php?enregistrement=erreur");
                        // exit();}
                  } else {
                    header("Location: vue_inscription.php?enregistrement=CGU");
                    exit();
                  }
                }
              }
            }
          }
        }
      }
?>
