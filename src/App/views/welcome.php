<?php include $this->resolve("partials/_header-user.php") ?>

<main class="pb-75">
  <div class="container my-5">
    <div class="bg-light-red shadow p-4 p-md-5 rounded-3 text-center">
      <img src="/assets/svg/person-circle.svg" alt="person-circle" height="70" class="mb-3" />
      <h1 class="text-body-emphasis py-3 display-5">
        Welcome <?php echo e($_SESSION['username']) . "!" ?>
      </h1>
      <hr />
      <p class="col-lg-8 mx-auto fs-3 py-2">
        <strong>What do you want to change about your finances today?</strong>
      </p>
      <p class="col-lg-4 mx-auto fs-5">
        <i>A budget is telling your money where to go instead of wondering where it went.</i>
      </p>
      <p class="col-lg-4 mx-auto fs-5 mb-0">
        <i>John C. Maxwell</i>
      </p>
    </div>
  </div>
</main>

<?php include $this->resolve("partials/_footer.php") ?>