<?php
require 'config.php';

header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validation
    $required = ['lastname', 'firstname', 'phone', 'filiere', 'email'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            throw new Exception("Le champ $field est requis");
        }
    }

    // Insertion en base
    $pdo = getPDO();
    $stmt = $pdo->prepare("INSERT INTO downloads 
                          (nom, prenom, telephone, filiere, email)
                          VALUES (?, ?, ?, ?, ?)");
    
    $stmt->execute([
        $data['lastname'],
        $data['firstname'],
        $data['phone'],
        $data['filiere'],
        $data['email']
    ]);

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>