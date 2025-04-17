<?php
header('Content-Type: application/json');

// Récupération des données
$data = json_decode(file_get_contents('php://input'), true);

// Validation simple
if(empty($data['lastname']) || empty($data['firstname']) || empty($data['phone']) || empty($data['filiere']) || empty($data['email'])) {
    echo json_encode(['success' => false, 'message' => 'Tous les champs sont obligatoires']);
    exit;
}

if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Email invalide']);
    exit;
}

// Ici vous pourriez enregistrer les données dans une base de données
// Exemple simplifié avec enregistrement dans un fichier CSV
$file = 'submissions.csv';
$handle = fopen($file, 'a');
fputcsv($handle, [
    date('Y-m-d H:i:s'),
    $data['lastname'],
    $data['firstname'],
    $data['phone'],
    $data['filiere'],
    $data['email']
]);
fclose($handle);

echo json_encode(['success' => true]);
?>