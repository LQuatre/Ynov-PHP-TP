<?php
// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier et récupérer les données du formulaire
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Destinataire
    $to = "unmecpasfort@gmail.com"; // Remplacez par votre adresse e-mail
    $subject = "Nouveau message de contact de $name";
    $body = "Nom : $name\nEmail : $email\nMessage : $message";
    $headers = "From: $email\r\n";

    // Envoi de l'e-mail
    if (mail($to, $subject, $body, $headers)) {
        $successMessage = "Votre message a été envoyé avec succès.";
    } else {
        $errorMessage = "Une erreur est survenue lors de l'envoi de votre message.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet">
</head>
<body>
<div class="bg-base-200 min-h-screen pt-12 flex items-start justify-center">
        <!-- Affiché seulement sur desktop (taille md et plus) -->
        <div class="hidden md:block mb">
            <div class="hero-content text-center">
                <div class="container mx-auto p-4">
                    <h1 class="text-2xl font-bold mb-4">Contact</h1>
                    <form method="POST" class="card bg-base-100 shadow-md p-8">
                        <div class="mb-6">
                            <label for="name" class="block mb-2">Nom</label>
                            <input type="text" id="name" name="name" class="input input-bordered w-full max-w-xs" required>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2">Email</label>
                            <input type="email" id="email" name="email" class="input input-bordered w-full max-w-xs" required>
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block mb-2">Message</label>
                            <textarea id="message" name="message" class="textarea" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Envoyer</button>
                    </form>
                    <?php if (isset($successMessage)) : ?>
                        <div class="alert alert-success mt-4"><?= $successMessage ?></div>
                    <?php elseif (isset($errorMessage)) : ?>
                        <div class="alert alert-error mt-4"><?= $errorMessage ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Affiché seulement sur mobile (taille inférieure à md) -->
        <div class="block md:hidden">
            <div class="hero-content text-center">
                <div class="container mx-auto p-4">
                    <h1 class="text-2xl font-bold mb-4">Contact</h1>
                    <form method="POST" class="card bg-base-100 shadow-md p-4">
                        <div class="mb-4">
                            <label for="name" class="block mb-2">Nom</label>
                            <input type="text" id="name" name="name" class="input input-bordered w-full max-w-xs" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block mb-2">Email</label>
                            <input type="email" id="email" name="email" class="input input-bordered w-full max-w-xs" required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block mb-2">Message</label>
                            <textarea id="message" name="message" class="textarea" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Envoyer</button>
                    </form>
                    <?php if (isset($successMessage)) : ?>
                        <div class="alert alert-success mt-4"><?= $successMessage ?></div>
                    <?php elseif (isset($errorMessage)) : ?>
                        <div class="alert alert-error mt-4"><?= $errorMessage ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
