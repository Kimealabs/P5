<?php
if (isset($response)) echo $response;
?>
<div class="container">
    <p class="display-6 text-primary">MODIFIER</p>
    <form action="" method="post">
        <div class="form-group mt-4">
            <label for="title">Titre du Blogpost</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $blogpost->getTitle(); ?>" />
        </div>
        <div class="form-group mt-4">
            <label for="chapo">Chapô</label>
            <textarea class="form-control" id="chapo" name="chapo" rows="4"><?= $blogpost->getChapo(); ?></textarea>
        </div>
        <div class="form-group mt-4">
            <label for="content">Texte</label>
            <textarea class="form-control" id="content" name="content" rows="10"><?= $blogpost->getContent(); ?></textarea>
        </div>
        <div class="d-flex mt-4" style="column-gap:10px">
            <input type="hidden" name="id" value="<?= $blogpost->getId(); ?>" />
            <input type="hidden" name="author" value="<?= $blogpost->getUserId(); ?>" />
            <input type="hidden" name="token" value="<?= $token; ?>" />

            <button class="btn btn-dark" type="submit" name="action" value="update">MODIFIER</button>
            <button class="btn btn-danger" type="submit" name="action" value="delete">SUPPRIMER</button>
        </div>
    </form>
</div>