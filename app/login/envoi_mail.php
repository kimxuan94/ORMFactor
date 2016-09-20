<?php
$destinataire = 'ophe1502@gmail.com';
$expediteur   = 'ophelie.toumine@gmail.com';
$reponse      = $expediteur;

echo "Ce script envoie un mail au format HTML à $destinataire";
$codehtml=
    '<html><body>'.
    '<h1>Bonjour Madame Monsieur,</h1>'.
    '<b><u>Vous recevez ce mail, suite à votre demande de mot de passe oublié depuis notre site</u></b><br>'.
    'Veuillez cliquer ici pour réinitialiser votre mot de passe '.
    '<font color=\"blue\">couleurs</font>'.
    '</body></html>';
mail($destinataire,
     'Ce mail est un test envoyé depuis localhost@server',
     $codehtml,
     "From: $expediteur\r\n".
        "Reply-To: $reponse\r\n".
        "Content-Type: text/html; charset=\"UTF-8\"\r\n");
?>
