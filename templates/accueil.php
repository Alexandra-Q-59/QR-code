<!-- Hero Section -->
<div class="hero-section" style="background-image: url('images/hero.jpeg'); background-size: cover; background-position: center; position: relative; height: 500px; margin-top: 0;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);"></div>
    <div class="container" style="position: relative; z-index: 1; height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; color: white;">
        <h1 style="font-size: 3.2em; margin-bottom: 20px; font-weight: bold; max-width: 800px;">Découvrez et partagez vos meilleures recettes</h1>
        <p style="font-size: 1.3em; margin-bottom: 40px; max-width: 700px;">Organisez vos repas, trouvez l'inspiration, et cuisinez en toute simplicité.</p>
        
        
        <!-- Boutons d'action -->
        <div class="action-buttons text-center" style="margin-top: 30px;"> <a href="index.php?view=ToutesNosRecettes" class="styled-button" style="border:none; margin:5px;">Explorer les recettes</a>
            <a href="index.php?view=frigo" class="styled-button" style="color:black; background-color:white; margin:5px;">J'ai quoi au frigo?</a>
        </div>
    </div>
</div>

<!-- Comment ça marche Section -->
<div class="container" style="padding: 60px 0;">
    <div class=conteneur>
    <h2 class="text-center" style="margin-bottom: 40px;">Comment ça marche ?</h2>
    </div>
    <div class="row">
        <!-- Bloc 1 -->
        <div class="col-md-3 col-sm-6 text-center">
            <div class="feature-box" style="padding: 20px; margin-bottom: 30px;">
                <div class="icon-circle" style="width: 80px; height: 80px; border-radius: 50%; background-color: #f8f9fa; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                    <span class="glyphicon glyphicon-search" style="font-size: 30px; color: #e74c3c;"></span>
                </div>
                <h4>Trouvez l'inspiration</h4>
                <p>Explorez notre vaste collection de recettes ou trouvez des idées avec ce que vous avez déjà.</p>
            </div>
        </div>
        
        <!-- Bloc 2 -->
        <div class="col-md-3 col-sm-6 text-center">
            <div class="feature-box" style="padding: 20px; margin-bottom: 30px;">
                <div class="icon-circle" style="width: 80px; height: 80px; border-radius: 50%; background-color: #f8f9fa; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                    <span class="glyphicon glyphicon-pencil" style="font-size: 30px; color: #e74c3c;"></span>
                </div>
                <h4>Créez vos recettes</h4>
                <p>Partagez vos créations culinaires et organisez-les dans un seul endroit.</p>
            </div>
        </div>
        
        <!-- Bloc 3 -->
        <div class="col-md-3 col-sm-6 text-center">
            <div class="feature-box" style="padding: 20px; margin-bottom: 30px;">
                <div class="icon-circle" style="width: 80px; height: 80px; border-radius: 50%; background-color: #f8f9fa; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                    <span class="glyphicon glyphicon-cutlery" style="font-size: 30px; color: #e74c3c;"></span>
                </div>
                <h4>Cuisinez facilement</h4>
                <p>Ajoutez les portions, suivez les étapes et cuisinez en toute simplicité.</p>
            </div>
        </div>
        
        <!-- Bloc 4 -->
        <div class="col-md-3 col-sm-6 text-center">
            <div class="feature-box" style="padding: 20px; margin-bottom: 30px;">
                <div class="icon-circle" style="width: 80px; height: 80px; border-radius: 50%; background-color: #f8f9fa; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                    <span class="glyphicon glyphicon-calendar" style="font-size: 30px; color: #e74c3c;"></span>
                </div>
                <h4>Planifiez vos repas</h4>
                <p>Organisez votre semaine et ne vous souciez plus de ce que vous allez manger.</p>
            </div>
        </div>
    </div>
</div>

<div class="conteneur">
    <h2>Nos recettes à la une</h2>
</div>

    <div class="row">
        <div class="col-md-4 col-sm-6">
            <a href="index.php?view=recette&idRecette=<?= $recetteUne['recipe_id'] ?>" style="text-decoration: none; color: inherit; display: block; margin-bottom: 30px;">
                <div class="recette" style="background-image: url('ressources/<?= htmlspecialchars($recetteUne['image_filename'], ENT_QUOTES, 'UTF-8') ?>'); min-height: 320px; background-size: cover; background-position: center; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); position:relative;">
                    <div class="info" style=" /* Style pour le bandeau d'info en bas */
                        position: absolute;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
                        color: white;
                        padding: 15px;
                        border-bottom-left-radius: 8px;
                        border-bottom-right-radius: 8px;
                    ">
                        <h4 style="margin-top:0; margin-bottom:5px; font-size:1.3em;"><strong><?= htmlspecialchars($recetteUne['title'], ENT_QUOTES, 'UTF-8') ?></strong></h4>
                        <p style="font-size:0.9em; margin-bottom:10px; height: 3.6em; overflow:hidden;">
                            <?= htmlspecialchars(substr($recetteUne['description'], 0, 100) . '...', ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <div class="groupe" style="font-size: 0.8em; display:flex; justify-content:space-between;">
                            <span><span class="glyphicon glyphicon-time"></span> <?= htmlspecialchars($recetteUne['prep_time'], ENT_QUOTES, 'UTF-8') ?> min</span>
                            <span><span class="glyphicon glyphicon-user"></span> <?= htmlspecialchars($recetteUne['servings'], ENT_QUOTES, 'UTF-8') ?></span>
                            <span>Par <?= htmlspecialchars($recetteUne['username'], ENT_QUOTES, 'UTF-8') ?></span>
                            <span>
                                <?= htmlspecialchars(number_format(floatval($recetteUne['average_rating']), 1), ENT_QUOTES, 'UTF-8') ?> <span style="color: gold;">★</span>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
        ?>
    </div>

    <div class="text-center" style="margin-top: 20px;">
        <a href="index.php?view=ToutesNosRecettes" class="styled-button">Voir toutes les recettes</a>
    </div>
</div>