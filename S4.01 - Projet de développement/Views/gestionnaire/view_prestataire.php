<!-- Vue permettant de faire la liste d'un type de personne -->
<?php
require 'Views/view_begin.php';
require 'Views/view_header.php';
?>
<section class="main">
    <div class="main-body dispa">
        <div class="search-box">
            <form action="<?= $rechercheLink ?>" method="post" class="search_form">
                <input type="text" placeholder="Rechercher un/une <?= strtolower($title) ?>..." value="<?php if (isset($val_rech)) {
                      echo htmlspecialchars($val_rech);
                  } ?>">
                <div class="search-icon">
                    <i class="fas fa-search"></i>
                </div>
                <div class="cancel-icon">
                    <i class="fas fa-times"></i>
                </div>
                <div class="search-data">
                </div>
            </form>
            <?php if (!empty($buttonLink)): ?>
                <button type="button" class="button-primary font"
                    onclick="window.location='<?= htmlspecialchars($buttonLink) ?>'">Ajouter</button>
            <?php endif; ?>
        </div>
    </div>
    <div class="main-body appa">
        <?php if (!empty($buttonLink)): ?>
            <button type="button" class="button-primary font"
                onclick="window.location='<?= htmlspecialchars($buttonLink) ?>'">Ajouter</button>
        <?php endif; ?>
    </div>

    <div class="row">
        <p>Il y a plus de <span><?= count($person) ?></span> <?= strtolower($title) ?></p>
    </div>
    <!-- Popup Container -->
    <div id="messagePopup" class="popup2" data-message="<?php if (isset($message))
        echo htmlspecialchars($message); ?>">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h1 id="popupMessage"></h1>
        </div>
    </div>

    <div class="element-block">
        <?php if (is_string($person)): ?>
            <p class=""><?= htmlspecialchars($person); ?></p>
        <?php elseif (isset($person) && !empty($person)): ?>
            <?php foreach ($person as $p): ?>
                <div class="job_card">
                    <div class="job_details">
                        <div class="img">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="text">
                            <a href='<?= $cardLink ?>&id=<?php if (isset($p['id_personne'])):
                                  echo htmlspecialchars($p['id_personne']);
                              endif; ?>' class="block">
                                <h2>
                                    <?php if (array_key_exists('nom', $p)): ?>
                                        <?= htmlspecialchars($p['nom'] . ' ' . $p['prenom']); ?>
                                    <?php endif; ?>
                                </h2>
                                <span>
                                    <?php if (array_key_exists('mail', $p)): ?>
                                        <?= htmlspecialchars($p['mail']); ?>
                                    <?php endif; ?>
                                </span>

                            </a>
                        </div>
                    </div>
                    <div class="job_action">
                        <span>
                            <?php if (array_key_exists('telephone', $p)): ?>
                                <?= htmlspecialchars($p['telephone']); ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="job_salary">
                        <!-- <a href="?controller=gestionnaire&action=consulterBDLs">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            <span>Voir BDL</span>
                        </a><br>
                        <a href="?controller=gestionnaire&action=consulterAbsences">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            <span>Absences</span>
                        </a> -->
                        <a
                            href='?controller=gestionnaire&action=consulterBDLPrestataire&id_prestataire=<?= htmlspecialchars($p['id_personne']) ?>'>
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            <span>Voir BDL</span>
                        </a><br>
                        <a
                            href='?controller=gestionnaire&action=consulterAbsencesPrestataire&id_prestataire=<?= htmlspecialchars($p['id_personne']) ?>'>
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            <span>Absences</span>
                        </a>

                    </div>


                </div>

            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (
            ((str_contains($_GET['controller'], 'gestionnaire') || str_contains($_GET['controller'], 'administrateur')) && !isset($_GET['id']))
            || ((str_contains($_GET['controller'], 'prestataire') && isset($person[0]['id_bdl'])))
        ): ?>

        <?php endif; ?>
    </div>
    </div>
</section>
<?php
require 'Views/view_end.php';
?>