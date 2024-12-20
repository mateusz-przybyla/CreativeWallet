<?php include $this->resolve("partials/_header.php") ?>

<main class="pb-75">
  <div class="container my-5">
    <div class="bg-main-home shadow p-4 px-md-5 text-center rounded-3">
      <form class="w-lg-50 mx-auto" method="POST" id="formSignIn">
        <?php
        include $this->resolve("partials/_csrf.php");
        ?>
        <img class=" mb-3" src="/assets/svg/box-arrow-in-right.svg" alt="box-arrow-in-right" height="70" />
        <h1 class="h3 mb-4">Please sign in</h1>

        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-1 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/envelope.svg" alt="envelope" height="25" />
          </figure>
          <div class="form-floating mb-1 w-100">
            <input type=" email" name="email" value="<?php
                                                      echo e($oldFormData['email'] ?? '');
                                                      ?>" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                      if (isset($errors['email']) || in_array(['Invalid credentials.'], $errors)) {
                                                                                                        echo "is-invalid";
                                                                                                      }
                                                                                                      ?>" id="loginEmail" placeholder />
            <label for="loginEmail">Email</label>
          </div>
        </div>
        <?php if (array_key_exists('email', $errors)) : ?>
          <div class="text-danger text-start small">
            <?php echo e($errors['email'][0]); ?>
          </div>
        <?php endif; ?>
        <div class="text-danger text-start small" id="emailError"></div>

        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-1 mt-2 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/lock-fill.svg" alt="lock-fill" height="25" />
          </figure>
          <div class="form-floating w-100 mb-1 mt-2">
            <input type="password" name="password" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                if (isset($errors['password'])) {
                                                                                                  echo "is-invalid";
                                                                                                }
                                                                                                ?>" id="loginPassword" placeholder />
            <label for="loginPassword">Password</label>
          </div>
        </div>
        <?php if (array_key_exists('password', $errors)) : ?>
          <div class="text-danger text-start small">
            <?php echo e($errors['password'][0]); ?>
          </div>
        <?php endif; ?>
        <div class="text-danger text-start small" id="passwordError"></div>

        <div class="checkbox my-3">
          <label>
            <input type="checkbox" id="rememberMe" /> Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-dark" type="submit" id="loginSubmit">
          Sign in
        </button>
        <p class="pt-3 my-0">
          New to CreativeWallet?
          <a href="/register" class="text-decoration-none fw-500">Sign up</a>
        </p>
      </form>
    </div>
  </div>
</main>
<script src="/assets/js/login-form.js" type="text/javascript"></script>
<script src="/assets/js/remember-me.js" type="text/javascript"></script>

<?php include $this->resolve("partials/_footer.php") ?>