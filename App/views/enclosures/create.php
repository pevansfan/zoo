<?php ob_start(); ?>

<style>
    /* Conteneur du formulaire */
    .form__section {
        margin-top: 200px;
        padding: 40px;
    }

    /* Contenu du formulaire */
    .form__container {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Titre du formulaire */
    .form__container h2 {
        font-size: 1.8em;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Groupe de champs */
    .form__group {
        margin-bottom: 15px;
    }

    /* Label des champs */
    .form__group label {
        font-size: 1.1em;
        display: block;
        margin-bottom: 8px;
    }

    /* Champ de saisie */
    .form__group input,
    .form__group select,
    .form__group textarea {
        width: 100%;
        padding: 10px;
        font-size: 1em;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    /* Texte d'aide dans les champs */
    .form__group textarea {
        resize: vertical;
    }

    /* Bouton d'envoi */
    .btn {
        background-color: #4CAF50;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 5px;
        font-size: 1.2em;
        cursor: pointer;
        width: 100%;
        margin-top: 20px;
    }

    .btn:hover {
        background-color: #45a049;
    }

    /* Style pour les messages d'erreur et de succès */
    .message {
        text-align: center;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-weight: bold;
    }

    .message.success {
        background-color: #4CAF50;
        color: white;
    }

    .message.error {
        background-color: #f44336;
        color: white;
    }
</style>

<span class="home"><a href="/">Retour</a></span>
<div class="form__section">
    <div class="form__container">
        <h2>Créer un nouvel enclos</h2>

        <!-- Affichage des messages de succès ou d'erreur -->
        <?php if (isset($data['message'])): ?>
            <div class="message <?= strpos($data['message'], 'succès') !== false ? 'success' : 'error' ?>">
                <?= htmlspecialchars($data['message']) ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire de création d'enclos -->
        <form action="/addEnclosure" method="POST">
            <div class="form__group">
                <label for="name">Nom de l'enclos</label>
                <input type="text" id="name" name="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" required>
            </div>
            <div class="form__group">
                <label for="description">Description de l'enclos</label>
                <textarea id="description" name="description" rows="4" required><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn">Créer l'enclos</button>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
render('default', [
    'content' => $content,
], true);
?>
