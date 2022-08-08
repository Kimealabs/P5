<div class="container">
    <p class="display-6 text-primary">COMMENTAIRES A VALIDER</p>
    <?php
    if (!$comments) echo "Aucun commentaire à valider.";
    else {
        foreach ($comments as $comment) {
            $user = $userManager->get($comment->getUserId());
            $content = nl2br($comment->getContent());
            $date = date("d/m/y \à H:i", strtotime($comment->getCreatedAt()));
            echo <<<HTML
      <form action="" method="post">
        <div class="w-100 d-flex justify-content-between flex-wrap mb-5 mb-md-3 align-items-top" style="column-gap:10px">
            <div class="rounded border-1 bg-white p-1 mb-2 fs-6" style="flex: 1 0 auto;">
              <p class="m-0">Publié le {$date} par <b>{$user->getName()}</b></p>
              <p class="mt-0">{$content}</p>
            </div>
            <div>
              <input type="hidden" name="id" value="{$comment->getId()}" />
              <input type="hidden" name="token" value="$token" />

              <button type="submit" class="btn btn-success" name="status" value=1>PUBLIER</button>
              <button type="submit" class="btn btn-danger" name="status" value=2>SUPPRIMER</button>
            </div>
        </div>
      </form>
HTML;
        }
    }
    ?>
</div>