<?php ob_start(); ?>

<?php require "App/templates/ui/nav.php" ?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    table {
        border-collapse: collapse;
        width: 60%;
        margin: auto;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f4a261;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    h1 {
        text-align: center;
        color: #264653;
    }
</style>
<h1 style="margin-top: 300px;">Liste des Tickets</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Catégorie</th>
            <th>Prix</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['tickets'] as $ticket): ?>
            <tr>
                <td><?= htmlspecialchars($ticket['id']) ?></td>
                <td><?= htmlspecialchars($ticket['category']) ?></td>
                <td><?= number_format($ticket['price'], 2, ',', ' ') ?> €</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php

$content = ob_get_clean();
render('default', [
    'content' => $content,
], true);
