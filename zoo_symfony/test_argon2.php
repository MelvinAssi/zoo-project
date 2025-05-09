<?php
$password = 'AzertyAzerty25';
$hash = password_hash($password, PASSWORD_ARGON2ID);
echo $hash . "\n";
if (password_verify($password, $hash)) {
    echo "Mot de passe vérifié avec succès !\n";
} else {
    echo "Échec de la vérification.\n";
}
?>