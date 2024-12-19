<?php include $this->resolve("partials/_header-user.php") ?>

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

      <div class="row">
        <div class="col-lg-6 col-xl-4">
          <table class="table table-striped table-bordered table-hover">
            <caption class="text-start">Expense category settings: </caption>
            <thead>
              <tr class="bg-grey-blue">
                <th scope="col">#</th>
                <th scope="col">Expense categories</th>
                <th scope="col">Limit</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              <?php $expenseIndex = 1;
              foreach ($expenseCategories as $category) : ?>
                <tr>
                  <th scope='row'><?php echo e($expenseIndex); ?></th>
                  <td class="text-break"><?php echo e($category['name']) ?></td>
                  <td class="text-break"><?php echo e($category['category_limit']) ?></td>
                  <td class="d-flex flex-wrap gap-1">
                    <?php if (e($expenseCategoriesAmount) <= 1) : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#editExpenseCategoryModal-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                    <?php else : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#editExpenseCategoryModal-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                      <button type="button" class="btn btn-danger custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#deleteExpenseCategoryModal-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/trash3.svg" alt="trash3" height="15" />
                      </button>
                    <?php endif; ?>

                    <!-- Modal delete -->
                    <?php include $this->resolve("modals/_delete-expense-category.php"); ?>
                    <!-- end Modal delete-->

                    <!-- Modal edit -->
                    <?php include $this->resolve("modals/_edit-expense-category.php"); ?>
                    <!-- end Modal edit -->
                  </td>
                </tr>
                <?php $expenseIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <th>...</th>
                <td colspan="3" class="text-start">
                  <button type="button" class="btn btn-success custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#addExpenseCategoryModal">
                    <img class="align-items-center justify-content-center" src="/assets/svg/plus-lg.svg" alt="plus" height="15" />
                  </button>

                  <!-- Modal add expense category -->
                  <?php include $this->resolve("modals/_add-expense-category.php"); ?>
                  <!-- end Modal add expense category -->
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-6 col-xl-4">
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
              foreach ($incomeCategories as $category) : ?>
                <tr>
                  <th scope='row'><?php echo e($incomeIndex); ?></th>
                  <td class="text-break"><?php echo e($category['name']); ?></td>
                  <td class=" d-flex flex-wrap gap-1">
                    <?php if (e($incomeCategoriesAmount) <= 1) : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#editIncomeCategoryModal-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                    <?php else : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#editIncomeCategoryModal-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                      <button type="button" class="btn btn-danger custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#deleteIncomeCategoryModal-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/trash3.svg" alt="trash3" height="15" />
                      </button>
                    <?php endif; ?>

                    <!-- Modal delete income category -->
                    <?php include $this->resolve("modals/_delete-income-category.php"); ?>
                    <!-- end Modal delete income category -->

                    <!-- Modal edit income category -->
                    <?php include $this->resolve("modals/_edit-income-category.php"); ?>
                    <!-- end Modal edit income category -->
                  </td>
                </tr>
                <?php $incomeIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <th>...</th>
                <td colspan="2" class="text-start">
                  <button type="button" class="btn btn-success custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#addIncomeCategoryModal">
                    <img class="align-items-center justify-content-center" src="/assets/svg/plus-lg.svg" alt="plus" height="15" />
                  </button>

                  <!-- Modal add income category -->
                  <?php include $this->resolve("modals/_add-income-category.php"); ?>
                  <!-- end Modal add income category -->
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-6 col-xl-4">
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
              foreach ($paymentMethods as $category) : ?>
                <tr>
                  <th scope='row'><?php echo e($methodIndex); ?></th>
                  <td class="text-break"><?php echo e($category['name']) ?></td>
                  <td class="d-flex flex-wrap gap-1">
                    <?php if (e($paymentMethodsAmount) <= 1) : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#editPaymentMethodModal-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                    <?php else : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#editPaymentMethodModal-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                      <button type="button" class="btn btn-danger custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#deletePaymentMethodModal-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/trash3.svg" alt="trash3" height="15" />
                      </button>
                    <?php endif; ?>

                    <!-- Modal delete payment method -->
                    <?php include $this->resolve("modals/_delete-payment-method.php"); ?>
                    <!-- end Modal delete payment method -->

                    <!-- Modal edit payment method -->
                    <?php include $this->resolve("modals/_edit-payment-method.php"); ?>
                    <!-- end Modal edit payment method -->
                  </td>
                </tr>
                <?php $methodIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <th>...</th>
                <td colspan="2" class="text-start">
                  <button type="button" class="btn btn-success custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#addPaymentMethodModal">
                    <img class="align-items-center justify-content-center" src="/assets/svg/plus-lg.svg" alt="plus" height="15" />
                  </button>

                  <!-- Modal add payment method -->
                  <?php include $this->resolve("modals/_add-payment-method.php"); ?>
                  <!-- end Modal add payment method -->
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
            <button type="button" class="btn btn-primary custom-btn w-100" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
              Change password
            </button>

            <!-- Modal change password -->
            <?php include $this->resolve("modals/_change-password.php"); ?>
            <!-- end Modal change password -->
          </div>

          <div class="d-flex flex-column justify-content-center align-items-start mt-4 mb-2">
            <h4>2. Delete account</h4>
            <p>Once you delete your account, there is no going back. Please be certain.</p>
          </div>
          <div class="d-flex flex-column justify-content-center align-items-center my-2">
            <button type="button" class="btn btn-danger custom-btn w-100" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
              Delete your account
            </button>

            <!-- Modal delete account -->
            <?php include $this->resolve("modals/_delete-account.php"); ?>
            <!-- end Modal delete account -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <div id="scrollToTop"></div>
</main>
<script>
  var errorList = <?php echo json_encode($errors); ?>

  $(document).ready(function() {
    if (errorList["oldPassword"]) {
      $("#oldPasswordError").text(errorList["oldPassword"]);
      $("#changePasswordModal").modal("show");
    }
    if (errorList["newPassword"]) {
      $("#newPasswordError").text(errorList["newPassword"]);
      $("#changePasswordModal").modal("show");
    }
    if (errorList["newPasswordConfirmed"]) {
      $("#newPasswordConfirmedError").text(errorList["newPasswordConfirmed"]);
      $("#changePasswordModal").modal("show");
    }

    if (errorList["newExpenseCategory"]) {
      $("#addExpenseCategoryError").text(errorList["newExpenseCategory"]);
      $("#addExpenseCategoryModal").modal("show");
    }
    if (errorList["newIncomeCategory"]) {
      $("#addIncomeCategoryError").text(errorList["newIncomeCategory"]);
      $("#addIncomeCategoryModal").modal("show");
    }
    if (errorList["newPaymentMethod"]) {
      $("#addPaymentMethodError").text(errorList["newPaymentMethod"]);
      $("#addPaymentMethodModal").modal("show");
    }

    if (errorList["editExpenseCategory"]) {
      $("#editExpenseCategoryError-" + errorList['editExpenseCategoryId']).text(
        errorList["editExpenseCategory"]
      );
      $("#editExpenseCategoryModal-" + errorList['editExpenseCategoryId']).modal(
        "show"
      );
    }
    if (errorList["editIncomeCategory"]) {
      $("#editIncomeCategoryError-" + errorList['editIncomeCategoryId']).text(
        errorList["editIncomeCategory"]
      );
      $("#editIncomeCategoryModal-" + errorList['editIncomeCategoryId']).modal(
        "show"
      );
    }
    if (errorList["editPaymentMethod"]) {
      $("#editPaymentMethodError-" + errorList['editPaymentMethodId']).text(
        errorList["editPaymentMethod"]
      );
      $("#editPaymentMethodModal-" + errorList['editPaymentMethodId']).modal(
        "show"
      );
    }
  });

  $("#changePasswordModal").on("hide.bs.modal", function() {
    $("#oldPasswordError").text("");
    $("#newPasswordError").text("");
    $("#newPasswordConfirmedError").text("");
  });

  $("#addExpenseCategoryModal").on("hide.bs.modal", function() {
    $("#addExpenseCategoryError").text("");
  });
  $("#addIncomeCategoryModal").on("hide.bs.modal", function() {
    $("#addIncomeCategoryError").text("");
  });
  $("#addPaymentMethodModal").on("hide.bs.modal", function() {
    $("#addPaymentMethodError").text("");
  });


  $("#editExpenseCategoryModal-" + errorList['editExpenseCategoryId']).on("hide.bs.modal", function() {
    $("#editExpenseCategoryError-" + errorList['editExpenseCategoryId']).text("");
  });
  $("#editIncomeCategoryModal-" + errorList['editIncomeCategoryId']).on("hide.bs.modal", function() {
    $("#editIncomeCategoryError-" + errorList['editIncomeCategoryId']).text("");
  });
  $("#editPaymentMethodModal-" + errorList['editPaymentMethodId']).on("hide.bs.modal", function() {
    $("#editPaymentMethodError-" + errorList['editPaymentMethodId']).text("");
  });
</script>
<script src="/assets/js/scroll-to-top.js" type="text/javascript"></script>

<?php include $this->resolve("partials/_footer.php") ?>