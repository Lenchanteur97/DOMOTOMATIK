<?php
$mail = $_POST['destinataire']; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn|orange|gmail).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = $_POST['message'];
$message_html =
"<html>
  <head>
    <meta charset='utf-8'>
		<style type='text/css'>
			*{
				font-family: Arial, sans-serif;
			}

			section{
				border: 1px solid black;
				padding: 20px;
				background-color: #E6F3F7;
				width: 300px;
			}

			img{
				height:50px;
				border: 1px solid black;
			}

			.titre{
				display:flex;
			}

			h2{
				margin-left:20px;
			}
		</style>
  </head>
  <body>
    <section>
      <div class='titre'>";

$message_html.="<img src=LOGO.jpg alt='logo'>";

$message_html.=
      	"<h2>DOMOTOMATIK</h2>
      </div>
      <h4>Madame, monsieur,</h4>".$_POST['message']."
	  <p>Cordialement,</p></br>
	  <p>L'équipe DOMOTOMATIK.</p>
    </section>
  </body>
</html>";
//==========

// //=====Lecture et mise en forme de la pièce jointe.
// $fichier = fopen("LOGO.jpg", "r");
// $attachement = fread($fichier, filesize("LOGO.jpg"));
// $attachement = chunk_split(base64_encode($attachement));
// fclose($fichier);
// //==========

//=====Création de la boundary.
$boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());
//==========


//=====Définition du sujet.
$sujet = $_POST['objet'];
//=========

//=====Création du header de l'e-mail.
$header = "From: \"DOMOTOMATIK\"<	donotreply@domotomatik.fr>".$passage_ligne;
$header.= "Reply-to: \"DOMOTOMATIK\" <donotreply@domotomatik.fr>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========

$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

//=====Ajout du message au format HTML.
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========

//=====On ferme la boundary alternative.
$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
//==========

$message.= $passage_ligne."--".$boundary.$passage_ligne;

// //=====Ajout de la pièce jointe.
// $message.= "Content-Type: image/jpeg; name=\"LOGO.jpg\"".$passage_ligne;
// $message.= "Content-Transfer-Encoding: base64".$passage_ligne;
// $message.= "Content-Disposition: attachment; filename=\"LOGO.jpg\"".$passage_ligne;
// $message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
// $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
// //==========

//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);

//==========

header('Location:espace_administrateur.php');

?>
