<?php include $this->resolve("partials/_header.php") ?>

<main class="pb-75">
  <div class="container my-5">
    <div class="bg-main-home shadow p-4 px-md-5 text-center rounded-3">
      <form class="w-lg-50 mx-auto" method="POST">
        <?php
        include $this->resolve("partials/_csrf.php");
        ?>
        <img class="mb-2" src="/assets/svg/person-plus-fill.svg" alt="person-plus-fill" height="70" />
        <h1 class="h3 mb-4">Sign up</h1>
        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-1 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/person-check.svg" alt="person-chec" height="25" />
          </figure>
          <div class="form-floating mb-1 w-100">
            <input type="text" name="username" value="<?php
                                                      echo e($oldFormData['username'] ?? '');
                                                      ?>" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                      if (isset($errors['username'])) {
                                                                                                        echo "is-invalid";
                                                                                                      }
                                                                                                      ?>" id="register-username" placeholder />
            <label for="register-username">Username</label>
          </div>
        </div>
        <?php if (array_key_exists('username', $errors)) : ?>
          <div class="text-danger text-start small">
            <?php echo e($errors['username'][0]); ?>
          </div>
        <?php endif; ?>
        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-1 mt-2 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/envelope.svg" alt="person-fill" height="25" />
          </figure>
          <div class="form-floating mb-1 mt-2 w-100">
            <input type="email" name="email" value="<?php
                                                    echo e($oldFormData['email'] ?? '');
                                                    ?>" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                    if (isset($errors['email'])) {
                                                                                                      echo "is-invalid";
                                                                                                    }
                                                                                                    ?>" id="register-email" placeholder />
            <label for="register-email">Email</label>
          </div>
        </div>
        <?php if (array_key_exists('email', $errors)) : ?>
          <div class="text-danger text-start small">
            <?php echo e($errors['email'][0]); ?>
          </div>
        <?php endif; ?>
        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-1 mt-2 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/lock.svg" alt="lock-fill" height="25" />
          </figure>
          <div class="form-floating mb-1 mt-2 w-100">
            <input type="password" name="password" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                if (isset($errors['passwordConfirmed'])) {
                                                                                                  echo "is-invalid";
                                                                                                }
                                                                                                ?>" id="register-password1" placeholder />
            <label for="register-password1">Password</label>
          </div>
        </div>
        <?php if (array_key_exists('password', $errors)) : ?>
          <div class="text-danger text-start small">
            <?php echo e($errors['password'][0]); ?>
          </div>
        <?php endif; ?>
        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-1 mt-2 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/lock-fill.svg" alt="lock" height="25" />
          </figure>
          <div class="form-floating mb-1 mt-2 w-100">
            <input type="password" name="passwordConfirmed" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                        if (isset($errors['passwordConfirmed'])) {
                                                                                                          echo "is-invalid";
                                                                                                        }
                                                                                                        ?>" id="register-password2" placeholder />
            <label for="register-password2">Repeat password</label>
          </div>
        </div>
        <?php if (array_key_exists('passwordConfirmed', $errors)) : ?>
          <div class="text-danger text-start small">
            <?php echo e($errors['passwordConfirmed'][0]); ?>
          </div>
        <?php endif; ?>
        <button class="w-100 btn btn-lg btn-dark mt-3" type="submit">
          Sign up
        </button>
        <p class="pt-3 my-0">
          Already have an account?
          <a href="/login" class="text-decoration-none fw-500">Sign in</a>
        </p>
      </form>
    </div>
  </div>
</main>

<?php include $this->resolve("partials/_footer.php") ?>