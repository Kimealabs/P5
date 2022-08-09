<header class="masthead" style="background-image: url('assets/img/posts.png')" style="height:250px">
  <div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="post-heading">
          <h1><?= $post->getTitle(); ?></h1>
          <h2 class="subheading"><?= nl2br($post->getChapo()); ?></h2>
          <p class="post-meta fs-6">
            <?php
            $user = $userManager->get($post->getUserId());
            $date = date("d/m/y \à H:i", strtotime($post->getCreatedAt()));
            $modify = ($post->getModifiedAt() != '') ? ' - modifié le ' . date("d/m/y \à H:i", strtotime($post->getModifiedAt())) : '';
            ?>
            Posté par
            <b><?= $user->getName(); ?></b>
            le <?= $date; ?> <?= $modify; ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Post Content-->
<div class="mb-4">
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7 mb-5">
        <?= nl2br($post->getContent()); ?>
      </div>
      <?php
      if (!$this->session->get('login')) {
      ?>
        <hr />
        <div class="col-md-10 col-lg-8 col-xl-7">
          Vous devez être connecté pour ajouter un commentaire !
        </div>
      <?php
      } else { ?>
        <hr />
        <div class="col-md-10 col-lg-8 col-xl-7">
          <form action="post/addComment" method="POST">
            <div class="form-floating">
              <textarea class="form-control" name="content" placeholder="Leave a comment here" id="floatingTextarea" rows="5" style="height:100%"></textarea>
              <label for="floatingTextarea">Ajouter votre commentaire</label>
            </div>

            <div class="mt-5 col-12 text-center mb-5">
              <button class="btn btn-primary" type="submit">Envoyer</button>
            </div>
            <p>Votre commentaire ne sera publié qu'après examen de l'administrateur.</p>
          </form>
        </div>

      <?php
      }

      if ($comments) {
        print_r('<hr /><div class="col-md-10 col-lg-8 col-xl-7 mb-5">');
        print_r('<p>Commentaires</p>');
        foreach ($comments as $comment) {
          $user = $userManager->get($comment->getUserId());
          $content = nl2br($comment->getContent());
          $date = date("d/m/y \à H:i", strtotime($comment->getCreatedAt()));
          echo <<<HTML
                              <div class="rounded border-1 bg-light p-2 mb-4">
                                <p class="text-secondary mb-0 fs-6">Publié le {$date} par <b>{$user->getName()}</b></p>
                                <p class="mt-0">{$content}</p>
                              </div>
HTML;
        }
        print_r('</div>');
      }
      ?>
    </div>
  </div>
</div>