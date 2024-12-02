<?php ob_start(); ?>

<style>
    /* Styles similaires à ceux du formulaire d'enclos */
    .form__section {
        margin-top: 50px;
        padding: 40px;
    }

    .form__container {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 0 auto;
    }

    .form__container h2 {
        font-size: 1.8em;
        margin-bottom: 20px;
        text-align: center;
    }

    .form__group {
        margin-bottom: 15px;
    }

    .form__group label {
        font-size: 1.1em;
        display: block;
        margin-bottom: 8px;
    }

    .form__group input,
    .form__group textarea,
    .form__group select {
        width: 100%;
        padding: 10px;
        font-size: 1em;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

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
</style>

<div class="form__section">
    <div class="form__container">
        <h2>Ajouter un nouvel animal à l'enclos</h2>

        <?php if (isset($data['message'])): ?>
            <div class="message <?= strpos($data['message'], 'succès') !== false ? 'success' : 'error' ?>">
                <?= htmlspecialchars($data['message']) ?>
            </div>
        <?php endif; ?>

        <form action="/addAnimal" method="POST">
            <div class="form__group">
                <label for="name">Nom de l'animal</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form__group">
                <label for="description">Description de l'animal</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form__group">
                <label for="species_id">Espèce</label>
                <select id="species_id" name="species_id" required>
                    <?php foreach ($data['enclos'] as $enclos) { ?>
                    <option value="<?= $enclos['id'] ?>"><?= $enclos['name'] ?></option>
                    <?php } ?>
                    <!-- Ajoute d'autres espèces si nécessaire -->
                </select>
            </div>
            <div class="form__group">
                <label for="image">Image (URL ou chemin)</label>
                <input type="text" id="image" name="image">
            </div>
            <button type="submit" name="submit" class="btn">Ajouter l'animal</button>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
render('default', [
    'content' => $content,
], true);
?>