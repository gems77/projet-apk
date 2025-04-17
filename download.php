<?php
require 'config.php';

// Vérifier qu'un enregistrement existe pour cet email
if (empty($_SERVER['HTTP_REFERER']) || !str_contains($_SERVER['HTTP_REFERER'], 'index.html')) {
    die("Accès direct interdit");
}

$file = 'apk/1xbet_bj.apk';

if (!file_exists($file)) {
    http_response_code(404);
    include('404.html');  // Créez cette page
    exit;
}

// Envoi du fichier
header('Content-Type: application/vnd.android.package-archive');
header('Content-Disposition: attachment; filename="1xbet_bj.apk"');
header('Content-Length: ' . filesize($file));
readfile($file);
exit;
?>