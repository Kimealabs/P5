<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/posts.png')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h2>Tous les posts</h2>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            <?php
              foreach($posts as $post) {
                $user = $userManager->get($post->getUserId());
            ?>
                <!-- Post preview-->
                <div class="post-preview">
                    <a href="post/id/<?=$post->getId();?>">
                        <h2 class="post-title"><?=$post->getTitle();?></h2>
                        <h3 class="post-subtitle"><?=$post->getChapo();?></h3>
                    </a>
                    <p class="post-meta fs-6">
                        <?php
                        $user = $userManager->get($post->getUserId());
                        $date = date("d/m/y \à H:i", strtotime($post->getCreatedAt()));
                        $modify = !is_null($post->getModifiedAt()) ? ' - modifié le '.date("d/m/y \à H:i", strtotime($post->getModifiedAt())) : '';
                        ?>
                        Posté par
                        <b><?=$user->getName();?></b>
                        le <?=$date;?> <?=$modify;?>
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />

            <?php
              }
            ?>
        </div>
    </div>
</div>
