<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/st.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="page-heading">
                    <h1>Inscrivez-vous</h1>
                    <span class="subheading">Vous pourrez commenter mes posts.</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->

<div class="container px-4 px-lg-5 mb-5 mt-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
          <?php
          if (isset($response)) echo '<div class="mb-4">'.$response.'</div>';
          ?>

          <form autocomplete="off" action="" method="post">
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
              <input type="text" autocomplete="off" name="email" value="<?=$email;?>" class="form-control" placeholder="Adresse email">
            </div>
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
              <input type="text" autocomplete="off" name="name" value="<?=$name;?>" class="form-control" placeholder="Nom ou surnom">
            </div>
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
              <input type="password" autocomplete="new-password" name="password" class="form-control" value="">
              <input type="hidden" name="token" value="<?=$token;?>" />
            </div>
            <p class="mt-0 fs-6">Le mot de passe doit comporter entre 6 et 10 caractères.</p>

            <div class="col-12 text-center">
              <button class="btn btn-primary" type="submit">Valider</button>
            </div>
          </form>
        </div>
    </div>
</div>
