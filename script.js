document.getElementById('download').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // 1. Validation des données
    const formData = {
        lastname: document.getElementById('lastname').value.trim(),
        firstname: document.getElementById('firstname').value.trim(),
        phone: document.getElementById('phone').value.trim(),
        filiere: document.getElementById('filiere').value,
        email: document.getElementById('email').value.trim()
    };

    // Validation simple mais efficace
    const errors = [];
    if (!formData.lastname) errors.push("Le nom est requis");
    if (!formData.firstname) errors.push("Le prénom est requis");
    if (!formData.phone) errors.push("Le téléphone est requis");
    if (!formData.filiere) errors.push("La filière est requise");
    if (!formData.email) errors.push("L'email est requis");
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
        errors.push("Email invalide");
    }

    if (errors.length > 0) {
        alert("Erreurs:\n" + errors.join("\n"));
        return;
    }

    try {
        // 2. Envoi des données au serveur
        const response = await fetch('process-form.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        });

        // 3. Gestion de la réponse
        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || "Erreur serveur");
        }

        // 4. Téléchargement de l'APK
        const apkResponse = await fetch('download.php');
        if (!apkResponse.ok) throw new Error("Fichier APK non disponible");

        const blob = await apkResponse.blob();
        const url = window.URL.createObjectURL(blob);
        
        // Création d'un lien invisible pour déclencher le téléchargement
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = '1xbet_bj.apk'; // Nom du fichier téléchargé
        document.body.appendChild(a);
        a.click();
        
        // Nettoyage
        window.URL.revokeObjectURL(url);
        a.remove();

    } catch (error) {
        console.error('Erreur complète:', error);
        alert("Échec du téléchargement:\n" + error.message);
    }
});