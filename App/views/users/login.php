<?php
ob_start();

?>
<span><a href="/" class="home">Retour</a></span>
<div class="form-container">
    <div class="login-container">
        <h2>Connexion</h2>
        <form action="/login" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Entrez votre email">

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required placeholder="Entrez votre mot de passe">


            <button type="submit" name="submit">Se connecter</button>
        </form>
    </div>
</div>

<?php


$content = ob_get_clean();


render("default", [
    'content' => $content,
], true);





?>