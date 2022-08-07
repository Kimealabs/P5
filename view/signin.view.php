<?php
if (isset($flash['type'])) {
  echo '<div class="flash alert alert-' . $flash['type'] . '" role="alert">' . $flash['message'] . '</div>';
}
?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/st.jpg')">
  <div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="page-heading">
          <h1>Connexion</h1>
          <span class="subheading">Vous avez un compte? Oui, alors aucun problème.</span>
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
      if (isset($response)) echo $response;
      ?>
      <form autocomplete="off" action="signin/connect" method="POST">
        <div class="input-group input-group-lg mb-3">
          <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-at"></i></span>
          <input type="text" autocomplete="off" class="form-control" name="email" placeholder="Adresse email" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group input-group-lg mb-3">
          <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
          <input type="password" autocomplete="new-password" class="form-control" name="password" placeholder="Mot de passe" aria-label="Username" aria-describedby="basic-addon1">
          <input type="hidden" name="token" value="<?= $token; ?>" />
        </div>
        <div class="col-12 text-center">
          <button class="btn btn-primary" type="submit">Connexion</button>
        </div>
      </form>
    </div>
  </div>
</div>