<?php ob_start(); ?>

<?php require "App/templates/ui/nav.php" ?>

<div class="enclos__section">
    <div class="enclos__presentation">
        <div class="section__title">
            <h1>Enclos : <?= htmlspecialchars($data['enclosById'][0]['name']) ?></h1> <!-- Affichage du nom de l'enclos -->
            <div class="bar__title"></div>
        </div>
        <p class="description"><?= htmlspecialchars($data['enclosById'][0]['description']) ?></p>
    </div>
    <?php if (empty($data['animals'])) {
        echo "<p class=\"no-animal\">Aucun animal dans cet enclos pour le moment.</p>";
    } ?>
    <div class="enclos__animals">
        <?php
        if (!empty($data['animals'])) {
            $animals = $data['animals'];
            foreach ($data['animals'] as $animal) {
                if (!empty($_SESSION) && $_SESSION['role'] == 'visitor') { ?>
                    <div class="animal__group">
                        <img src="App/<?= htmlspecialchars($animal['image']) ?>" alt="Image d'animal">
                        <p><?= $animal['name'] ?></p>
                        <p><?= htmlspecialchars($animal['name']) ?></p>
                        <p><?= htmlspecialchars($animal['description']) ?></p>
                    </div>
                <?php } elseif (!empty($_SESSION) && $_SESSION['role'] == 'employee') { ?>
                    <div class="animal__group">
                        <img src="App/<?= htmlspecialchars($animal['image']) ?>" alt="">
                        <form action="/animalActions" method="POST">
                            <input type="hidden" name="animal_id" value="<?= htmlspecialchars($animal['id']) ?>">

                            <div class="input__group">
                                <label for="animal_name_<?= $animal['id'] ?>">Nom :</label>
                                <input type="text" id="animal_name_<?= $animal['id'] ?>" name="animal_name" value="<?= htmlspecialchars($animal['name']) ?>">

                            </div>

                            <label for="animal_description_<?= $animal['id'] ?>">Description :</label>
                            <textarea id="animal_description_<?= $animal['id'] ?>" name="animal_description"><?= htmlspecialchars($animal['description']) ?></textarea>



                            <div class="btns">
                                <button type="submit" name="action" value="update">Modifier</button>
                                <button type="submit" name="action" value="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">Supprimer</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>

        <?php
            }
        }
        ?>
    </div>
    <div>
        <form action="/enclos/delete?id=<?= $_GET['id'] ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet enclos ?');">
            <button style="background-color: red;" type="submit">Supprimer l'enclos</button>
        </form>
    </div>
</div>

<script>
    function confirmDelete(id_task, event) {
        if (confirm("Êtes-vous sûr(e) de vouloir supprimer cette enclos ?")) {
            console.log("Enclos supprimée.");
        } else {
            event.preventDefault();
            console.log("Suppression annulée.");
        }
    }
</script>

<?php
$content = ob_get_clean();
render('default', [
    'content' => $content,
], true);
