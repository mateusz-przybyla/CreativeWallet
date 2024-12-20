<?php include $this->resolve("partials/_header.php") ?>

<main class="pb-75">
  <div class="container my-5">
    <div class="bg-main-home shadow p-4 p-md-5 text-center rounded-3">
      <img src="/assets/svg/check2-square.svg" alt="graph-up-arrow" height="70" class="mb-3" />
      <h1 class="text-body-emphasis py-3 display-5">
        Success!
      </h1>
      <hr />
      <p class="col-lg-8 mx-auto fs-3 py-2">
        <strong>Congratulations, your account has been successfully created.</strong>
      </p>
      <a class="btn btn-success btn-lg px-5" href="/login">Sign in</a>
    </div>
  </div>
</main>

<?php include $this->resolve("partials/_footer.php") ?>