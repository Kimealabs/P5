<div class="container">
    <p class="display-6 text-primary mb-0">LISTE DES BLOGPOSTS</p>
    <p class="mt-0 fs-6">Cliquez sur un Blogpost pour le Modifier/Supprimer</p>
    <?php
    foreach ($blogposts as $blogpost) {
        $user = $userManager->get($blogpost->getUserId());
    ?>
        <!-- Post preview-->
        <div class="post-preview bg-white p-1 mb-4">
            <a href="admin/blogpost/<?= $blogpost->getId(); ?>">
                <h2 class="post-title fs-6"><?= $blogpost->getTitle(); ?></h2>
                <h3 class="post-subtitle fs-6"><?= nl2br($blogpost->getChapo()); ?></h3>
            </a>
            <p class="post-meta fs-6">
                <?php
                $user = $userManager->get($blogpost->getUserId());
                $date = date("d/m/y \à H:i", strtotime($blogpost->getCreatedAt()));
                $modify = ($blogpost->getModifiedAt() != '') ? ' - modifié le ' . date("d/m/y \à H:i", strtotime($blogpost->getModifiedAt())) : '';
                ?>
                Posté par
                <b><?= $user->getName(); ?></b>
                le <?= $date; ?> <?= $modify; ?>
            </p>
        </div>
    <?php
    }
    ?>
</div>