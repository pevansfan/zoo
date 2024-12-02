<nav>
    <div class="conteneur-nav">
        <div class="img-group">
            <a href="/"><ion-icon name="airplane-outline"></ion-icon></a>
        </div>
        <ul class="ul">
            <li>
                <a href="/">Accueil</a>
            </li>
            <li class="deroulant"><a href="/">Enclos &ensp;</a>
                <ul class="sous">
                    <?php foreach ($data['enclos'] as $enclos) { ?>
                        <li><a href="/enclos?id=<?= $enclos['id'] ?>"><?= $enclos['name'] ?></a></li>
                    <?php } ?>
                </ul>
            </li>

            <li>
                <a href="/infoTickets">Tarifs</a>
            </li>
            <?php if (!empty($_SESSION) && $_SESSION['role'] == 'visitor') { ?>
                <li class="deroulant"><a href="/" class="user"><ion-icon name="person-circle-outline"></ion-icon></a>
                    <ul class="sous">
                        <li><a href="/infoUser">Mon profil</a></li>
                        <li><a href="/logout">Déconnexion</a></li>
                    </ul>
                </li>
            <?php } elseif (!empty($_SESSION && $_SESSION['employee_firstname'] == 'Mr le Directeur')) { ?>
                <li class="deroulant"><a href="/" class="user"><ion-icon name="person-circle-outline"></ion-icon></a>
                    <ul class="sous">
                        <li><a href="/addEnclosure">Ajouter un enclos</a></li>
                        <li><a href="/addAnimal">Ajouter des animaux</a></li>
                        <li><a href="/infoUser">Mon profil</a></li>
                        <li><a href="/logout">Déconnexion</a></li>
                    </ul>
                </li>
            <?php  } else { ?>
                <li>
                    <a href="/login">Connexion</a>
                </li>
            <?php  } { ?>

            <?php } ?>
        </ul>
    </div>

</nav>