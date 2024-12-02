<?php ob_start(); ?>

<header>
   <?php require "App/templates/ui/nav.php" ?>
   <div class="info-home">
        <div class="btn-search">
            <input type="text" name="box" placeholder="Rechercher par mots-clés : CPGE, badminton, ...">
            <div class="btn">
                <a href=""><ion-icon name="search-outline"></ion-icon></a>
            </div>
        </div>
        <div class="title">
            <h1>Bienvenue au <span class="name-school">Zoo de Compiègne</span></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio possimus veritatis debitis consequatur suscipit iste cum quidem similique facere incidunt dolore explicabo numquam porro nobis praesentium rerum assumenda, voluptates alias deserunt, laborum saepe quibusdam labore! Beatae atque consequuntur quod sint esse eius totam recusandae necessitatibus, omnis labore nam neque! Repellendus blanditiis dolorum eum consectetur nisi beatae at tenetur, eius ipsam, eligendi molestiae consequatur in velit animi totam nulla mollitia quam minus provident! Sequi quasi, illum ad obcaecati labore et ullam sint placeat cupiditate nulla rem soluta! Sint facilis distinctio pariatur recusandae accusantium laborum dolorum officiis, assumenda quam! Officia, veniam tempora!</p>
        </div>
    </div>
</header>

<div class="home__section">
    <div class="home__presentation">
        <div class="section__title">
            <h1>Bienvenue au <span>Zoo</span></h1>
            <div class="bar__title"></div>
        </div>
        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio veritatis aliquid error sit voluptate eligendi iure voluptates, facilis, hic maiores quis eum accusantium? Iusto dignissimos velit perspiciatis molestiae dicta iste!</p>
        <p class="small">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Id beatae, rerum aut architecto laudantium laboriosam optio dolorem cumque ratione deleniti.</p>
        <span><a href="">Voir la gallerie</a></span>
    </div>
    <div class="home__animals">
        <?php
        foreach ($data['species'] as $specie) {
            if ($specie['id'] == 1) { ?>
                <div class="animal__group">
                    <img src="App/<?= htmlspecialchars($specie['image']) ?>" alt="Image d\'espèce">
                    <p><?= $specie['name'] ?></p>
                    <p><?= $specie['description'] ?></p>
                </div>
                
        <?php } if ($specie['id'] == 2) { ?>
                <div class="animal__group">
                    <img src="App/<?= htmlspecialchars($specie['image']) ?>" alt="Image d\'espèce">
                    <p><?= $specie['name'] ?></p>
                    <p><?= $specie['description'] ?></p>
                </div>
                
        <?php } 
        } ?>
    </div>
</div>
<?php

$content = ob_get_clean();
render('default', [
    'content' => $content,
], true);
