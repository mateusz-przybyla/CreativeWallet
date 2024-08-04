<?php include $this->resolve("partials/_header-user.php") ?>

<script>
  var errorList = <?php echo json_encode($errors); ?>

  $(document).ready(function() {
    if (errorList['oldPassword']) {
      $("#oldPasswordModal").text(errorList['oldPassword']);
      $("#change-password").modal("show");
    }
    if (errorList['newPassword']) {
      $("#newPasswordModal").text(errorList['newPassword']);
      $("#change-password").modal("show");
    }
    if (errorList['newPasswordConfirmed']) {
      $("#newPasswordConfirmedModal").text(errorList['newPasswordConfirmed']);
      $("#change-password").modal("show");
    }
  });
</script>

<main class="pb-75">
  <section class="container my-5">
    <div class="shadow py-4 px-2 px-md-5 bg-light-red rounded-3">
      <div class="text-center">
        <h1 class="h3 mb-3 d-flex justify-content-center align-items-center">
          <img class="me-2" src="/assets/svg/gear.svg" alt="gear" height="30" />
          Transaction settings
        </h1>
        <hr class="mb-4" />
      </div>

      <?php if ((e($incomeCategoriesAmount) <= 1) || (e($expenseCategoriesAmount) <= 1) || (e($paymentMethodsAmount) <= 1)) : ?>
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
          <img class="align-items-center justify-content-center" src="/assets/svg/exclamation-triangle.svg" alt="pen" height="17" />
          <div class="mx-2">
            There must be at least one category in each case.
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <?php if (array_key_exists('newName', $errors)) : ?>
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
          <img class="align-items-center justify-content-center" src="/assets/svg/exclamation-triangle.svg" alt="exclamation-triangle" height="17" />
          <div class="mx-2">
            <?php echo e($errors['newName'][0]); ?>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <?php if (array_key_exists('newCategory', $errors)) : ?>
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
          <img class="align-items-center justify-content-center" src="/assets/svg/exclamation-triangle.svg" alt="exclamation-triangle" height="17" />
          <div class="mx-2">
            <?php echo e($errors['newCategory'][0]); ?>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <div class="row">
        <div class="col-lg-4">
          <table class="table table-striped table-bordered table-hover">
            <caption class="text-start">Income category settings: </caption>
            <thead>
              <tr class="bg-grey-blue">
                <th scope="col">#</th>
                <th scope="col">Income categories</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              <?php $incomeIndex = 1;
              $_SESSION['item'] = "income-category";
              foreach ($incomeCategories as $category) : ?>
                <tr>
                  <th scope='row'><?php echo e($incomeIndex); ?></th>
                  <td><?php echo e($category['name']); ?></td>
                  <td class="d-flex gap-1">
                    <?php if (e($incomeCategoriesAmount) <= 1) : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                    <?php else : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                      <button type="button" class="btn btn-danger custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#delete-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/trash3.svg" alt="trash3" height="15" />
                      </button>
                    <?php endif; ?>

                    <!-- Modal delete-->
                    <?php include $this->resolve("modals/_delete-category.php"); ?>
                    <!-- end Modal delete-->

                    <!-- Modal edit-->
                    <?php include $this->resolve("modals/_edit-category.php"); ?>
                    <!-- end Modal edit-->
                  </td>
                </tr>
                <?php $incomeIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <th>...</th>
                <td colspan="2" class="text-start">
                  <?php $_SESSION['unique'] = 111; ?>
                  <button type="button" class="btn btn-success custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#add-cat-<?php echo e($_SESSION['unique']); ?>">
                    <img class="align-items-center justify-content-center" src="/assets/svg/plus-lg.svg" alt="plus" height="15" />
                  </button>

                  <!-- Modal add-->
                  <?php include $this->resolve("modals/_add-category.php"); ?>
                  <!-- end Modal add-->
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-4">
          <table class="table table-striped table-bordered table-hover">
            <caption class="text-start">Expense category settings: </caption>
            <thead>
              <tr class="bg-grey-blue">
                <th scope="col">#</th>
                <th scope="col">Expense categories</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              <?php $expenseIndex = 1;
              $_SESSION['item'] = "expense-category";
              foreach ($expenseCategories as $category) : ?>
                <tr>
                  <th scope='row'><?php echo e($expenseIndex); ?></th>
                  <td><?php echo e($category['name']) ?></td>
                  <td class="d-flex gap-1">
                    <?php if (e($expenseCategoriesAmount) <= 1) : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                    <?php else : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                      <button type="button" class="btn btn-danger custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#delete-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/trash3.svg" alt="trash3" height="15" />
                      </button>
                    <?php endif; ?>

                    <!-- Modal delete-->
                    <?php include $this->resolve("modals/_delete-category.php"); ?>
                    <!-- end Modal delete-->

                    <!-- Modal edit-->
                    <?php include $this->resolve("modals/_edit-category.php"); ?>
                    <!-- end Modal edit-->
                  </td>
                </tr>
                <?php $expenseIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <th>...</th>
                <td colspan="2" class="text-start">
                  <?php $_SESSION['unique'] = 112; ?>
                  <button type="button" class="btn btn-success custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#add-cat-<?php echo e($_SESSION['unique']); ?>">
                    <img class="align-items-center justify-content-center" src="/assets/svg/plus-lg.svg" alt="plus" height="15" />
                  </button>

                  <!-- Modal add-->
                  <?php include $this->resolve("modals/_add-category.php"); ?>
                  <!-- end Modal add-->
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-4">
          <table class="table table-striped table-bordered table-hover">
            <caption class="text-start">Payment method settings: </caption>
            <thead>
              <tr class="bg-grey-blue">
                <th scope="col">#</th>
                <th scope="col">Payment methods</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              <?php $methodIndex = 1;
              $_SESSION['item'] = "payment-method";
              foreach ($paymentMethods as $category) : ?>
                <tr>
                  <th scope='row'><?php echo e($methodIndex); ?></th>
                  <td><?php echo e($category['name']) ?></td>
                  <td class="d-flex gap-1">
                    <?php if (e($paymentMethodsAmount) <= 1) : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                    <?php else : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                      <button type="button" class="btn btn-danger custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#delete-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/trash3.svg" alt="trash3" height="15" />
                      </button>
                    <?php endif; ?>

                    <!-- Modal delete-->
                    <?php include $this->resolve("modals/_delete-category.php"); ?>
                    <!-- end Modal delete-->

                    <!-- Modal edit-->
                    <?php include $this->resolve("modals/_edit-category.php"); ?>
                    <!-- end Modal edit-->
                  </td>
                </tr>
                <?php $methodIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <th>...</th>
                <td colspan="2" class="text-start">
                  <?php $_SESSION['unique'] = 113; ?>
                  <button type="button" class="btn btn-success custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#add-cat-<?php echo e($_SESSION['unique']); ?>">
                    <img class="align-items-center justify-content-center" src="/assets/svg/plus-lg.svg" alt="plus" height="15" />
                  </button>

                  <!-- Modal add-->
                  <?php include $this->resolve("modals/_add-category.php"); ?>
                  <!-- end Modal add-->
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <section class="container my-5">
    <div class="shadow py-4 px-2 px-md-5 bg-light-red rounded-3">
      <div class="text-center">
        <h1 class="h3 mb-3 d-flex justify-content-center align-items-center">
          <img class="me-2" src="/assets/svg/gear-fill.svg" alt="gear" height="30" />
          User account settings
        </h1>
        <hr class="" />
      </div>
      <div class="d-flex justify-content-center">
        <div class="col-10 col-sm-8 col-lg-5">
          <div class="d-flex flex-column justify-content-center align-items-start mt-4 mb-2">
            <h4>1. Reset account password</h4>
            <p>Protect your account with a strong and unique password. We recommend changing your password regularly.</p>
          </div>
          <div class="d-flex flex-column justify-content-center align-items-center my-2">
            <button type="button" class="btn btn-primary custom-btn w-100" data-bs-toggle="modal" data-bs-target="#change-password">
              Change password
            </button>

            <!-- Modal change password-->
            <?php include $this->resolve("modals/_change-password.php"); ?>
            <!-- end Modal change password-->
          </div>

          <script>
            $("#change-password").on('hide.bs.modal', function() {
              $("#oldPasswordModal").text("");
              $("#newPasswordModal").text("");
              $("#newPasswordConfirmedModal").text("");
            });
          </script>

          <div class="d-flex flex-column justify-content-center align-items-start mt-4 mb-2">
            <h4>2. Delete account</h4>
            <p>Once you delete your account, there is no going back. Please be certain.</p>
          </div>
          <div class="d-flex flex-column justify-content-center align-items-center my-2">
            <button type="button" class="btn btn-danger custom-btn w-100" data-bs-toggle="modal" data-bs-target="#delete-account">
              Delete your account
            </button>

            <!-- Modal delete account-->
            <?php include $this->resolve("modals/_delete-account.php"); ?>
            <!-- end Modal delete account-->
          </div>
        </div>
      </div>
    </div>
  </section>
  <div id="scrollToTop"></div>
</main>

<?php include $this->resolve("partials/_footer.php") ?>