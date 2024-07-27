<?php isset($_SESSION['user']) ? include $this->resolve("partials/_header-user.php") : include $this->resolve("partials/_header.php") ?>

<main class="pb-75">
  <div class="container my-5">
    <div class="<?php echo isset($_SESSION['user']) ? "bg-light-red" : "bg-main-home" ?> shadow p-5 rounded-3 text-center">
      <img src="/assets/svg/emoji-frown.svg" alt="emoji-frown" height="70" class="mb-3" />
      <h1 class="text-body-emphasis py-2 number-404"> 404 </h1>
      <h2 class="text-body-emphasis py-3 display-5"> Page not found </h2>
      <hr />
      <p class="col-lg-8 mx-auto fs-3 py-2">
        <strong>The page you are looking for was moved, removed, renamed or might never existed.</strong>
      </p>
    </div>
  </div>
</main>

<?php include $this->resolve("partials/_footer.php") ?>