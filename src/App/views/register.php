<?php include $this->resolve("partials/_header.php") ?>

<main class="pb-75">
  <div class="container my-5">
    <div class="bg-main-home shadow p-5 text-center rounded-3">
      <form class="w-lg-50 mx-auto" method="post">
        <img class="mb-2" src="/assets/svg/person-plus-fill.svg" alt="person-plus-fill" height="70" />
        <h1 class="h3 mb-4">Sign up</h1>
        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-1 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/person-check.svg" alt="person-chec" height="25" />
          </figure>
          <div class="form-floating mb-1 w-100">
            <input type="text" name="username" value="<?php
                                                      if (isset($_SESSION['m_username'])) {
                                                        echo $_SESSION['m_username'];
                                                        unset($_SESSION['m_username']);
                                                      } ?>" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                        if (isset($_SESSION['e_username'])) {
                                                                                                          echo "is-invalid";
                                                                                                        }
                                                                                                        ?>" id="register-username" placeholder="Username" required="" />
            <label for="register-username">Username</label>
          </div>
        </div>
        <?php
        if (isset($_SESSION['e_username'])) {
          echo '<div class="text-danger text-start small">' . $_SESSION['e_username'] . '</div>';
          unset($_SESSION['e_username']);
        }
        ?>
        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-1 mt-2 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/envelope.svg" alt="person-fill" height="25" />
          </figure>
          <div class="form-floating mb-1 mt-2 w-100">
            <input type="email" name="email" value="<?php
                                                    if (isset($_SESSION['m_email'])) {
                                                      echo $_SESSION['m_email'];
                                                      unset($_SESSION['m_email']);
                                                    } ?>" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                      if (isset($_SESSION['e_email'])) {
                                                                                                        echo "is-invalid";
                                                                                                      }
                                                                                                      ?>" id="register-email" placeholder="name@example.com" required="" />
            <label for="register-email">Email</label>
          </div>
        </div>
        <?php
        if (isset($_SESSION['e_email'])) {
          echo '<div class="text-danger text-start small">' . $_SESSION['e_email'] . '</div>';
          unset($_SESSION['e_email']);
        }
        ?>
        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-1 mt-2 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/lock.svg" alt="lock-fill" height="25" />
          </figure>
          <div class="form-floating mb-1 mt-2 w-100">
            <input type="password" name="password" value="<?php
                                                          if (isset($_SESSION['m_password1'])) {
                                                            echo $_SESSION['m_password1'];
                                                            unset($_SESSION['m_password1']);
                                                          } ?>" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                            if (isset($_SESSION['e_password1'])) {
                                                                                                              echo "is-invalid";
                                                                                                            }
                                                                                                            ?>" id="register-password1" placeholder="Password" required="" />
            <label for="register-password1">Password</label>
          </div>
        </div>
        <?php
        if (isset($_SESSION['e_password1'])) {
          echo '<div class="text-danger text-start small">' . $_SESSION['e_password1'] . '</div>';
          unset($_SESSION['e_password1']);
        }
        ?>
        <div class="d-flex">
          <figure class="d-flex align-items-center rounded-left-3 px-2 mb-1 mt-2 rounded-start-2 bg-grey-blue border">
            <img src="/assets/svg/lock-fill.svg" alt="lock" height="25" />
          </figure>
          <div class="form-floating mb-1 mt-2 w-100">
            <input type="password" name="confirmed_password" value="<?php
                                                                    if (isset($_SESSION['m_password2'])) {
                                                                      echo $_SESSION['m_password2'];
                                                                      unset($_SESSION['m_password2']);
                                                                    } ?>" class="form-control rounded-0 rounded-end-2 <?php
                                                                                                                      if (isset($_SESSION['e_password2'])) {
                                                                                                                        echo "is-invalid";
                                                                                                                      }
                                                                                                                      ?>" id="register-password2" placeholder="Repeat password" required="" />
            <label for="register-password2">Repeat password</label>
          </div>
        </div>
        <?php
        if (isset($_SESSION['e_password2'])) {
          echo '<div class="text-danger text-start small">' . $_SESSION['e_password2'] . '</div>';
          unset($_SESSION['e_password2']);
        }
        ?>
        <button class="w-100 btn btn-lg btn-success mt-3" type="submit">
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