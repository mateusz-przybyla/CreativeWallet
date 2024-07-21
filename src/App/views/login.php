<?php include $this->resolve("partials/_header.php") ?>

<main class="pb-75">
  <div class="container my-5">
    <div class="bg-main-home shadow p-5 text-center rounded-3">
      <form class="w-lg-50 mx-auto" method="post">
        <img class="mb-3" src="/assets/svg/box-arrow-in-right.svg" alt="box-arrow-in-right" height="70" />
        <h1 class="h3 mb-4">Please sign in</h1>
        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-2 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/envelope.svg" alt="envelope" height="25" />
          </figure>
          <div class="form-floating mb-2 w-100">
            <input type="email" name="email" value="<?php
                                                    echo e($oldFormData['email'] ?? '');
                                                    ?>" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                    if (isset($errors['email'])) {
                                                                                                      echo "is-invalid";
                                                                                                    }
                                                                                                    ?>" placeholder />
            <label for="login-email">Email</label>
          </div>
        </div>
        <?php if (array_key_exists('email', $errors)) : ?>
          <div class="text-danger text-start small">
            <?php echo e($errors['email'][0]); ?>
          </div>
        <?php endif; ?>
        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-0 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/lock-fill.svg" alt="lock-fill" height="25" />
          </figure>
          <div class="form-floating w-100">
            <input type="password" name="password" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                if (isset($errors['password'])) {
                                                                                                  echo "is-invalid";
                                                                                                }
                                                                                                ?>" placeholder />
            <label for="login-password">Password</label>
          </div>
        </div>
        <?php if (array_key_exists('password', $errors)) : ?>
          <div class="text-danger text-start small">
            <?php echo e($errors['password'][0]); ?>
          </div>
        <?php endif; ?>
        <div class="checkbox my-3">
          <label>
            <input type="checkbox" id="remember-me" /> Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-success" type="submit" id="login-submit">
          Sign in
        </button>
        <p class="pt-3 my-0">
          Already have an account?
          <a href="/register" class="text-decoration-none fw-500">Sign up</a>
        </p>
      </form>
    </div>
  </div>
</main>

<?php include $this->resolve("partials/_footer.php") ?>