<?php
// Activation des erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Chemin vers le fichier APK 
$file = 'apk/1xbet_bj.apk';  

// Vérification robuste de l'existence du fichier
if (!file_exists($file)) {
    header('Content-Type: text/plain; charset=utf-8');
    http_response_code(404);
    die("Erreur : Le fichier APK n'existe pas.\nChemin vérifié : " . realpath($file));
}

// Vérification des permissions
if (!is_readable($file)) {
    header('Content-Type: text/plain; charset=utf-8');
    http_response_code(403);
    die("Erreur : Permission refusée pour le fichier APK");
}

// En-têtes pour forcer le téléchargement
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.android.package-archive');
header('Content-Disposition: attachment; filename="1xbet_bj.apk"');  // Nom fixe pour le fichier téléchargé
header('Content-Length: ' . filesize($file));
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');

// Envoi du fichier
readfile($file);
exit;
?>