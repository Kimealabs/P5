        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/st.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="page-heading">
                            <h1>Contactez-moi</h1>
                            <span class="subheading">Des questions? J'ai des réponses.</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                      <?php
                        if (isset($response)) echo $response;

                      ?>
                      <p>Vous voulez restez au courant? Remplissisez le formulaire ci-dessous pour m'envoyer un message, je reviendrais vers vous le plus vite possible!</p>
                      <div class="my-5">
                          <form id="contactForm" action="contact/send" method="post">
                              <div class="form-floating">
                                  <input class="form-control" id="name" name="name" type="text" placeholder="Votre nom" />
                                  <label for="name">Nom</label>
                              </div>
                              <div class="form-floating">
                                  <input class="form-control" id="email" name="email" type="email" placeholder="Votre adresse email" />
                                  <label for="email">Adresse Email</label>
                              </div>
                              <div class="form-floating">
                                  <textarea class="form-control" id="message" name="message" placeholder="Votre message" style="height: 12rem" ></textarea>
                                  <label for="message">Message</label>
                                  <input type="hidden" name="token" value="<?=$token;?>" />

                              </div>
                              <button class="btn btn-primary text-uppercase mt-5" id="submitButton" type="submit">Envoyer</button>
                          </form>
                      </div>


                    </div>
                </div>
            </div>
        </main>
