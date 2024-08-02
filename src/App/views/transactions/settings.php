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
        <div class="alert alert-warning d-flex align-items-center" role="alert">
          <img class="align-items-center justify-content-center" src="/assets/svg/exclamation-triangle.svg" alt="pen" height="17" />
          <div class="mx-2">
            There must be at least one category in each case.
          </div>
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
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                    <?php else : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                      <button type="button" class="btn btn-danger custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#delete-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/trash3.svg" alt="trash3" height="15" />
                      </button>
                    <?php endif; ?>

                    <!-- Modal delete-->
                    <?php include $this->resolve("modals/_delete-category.php"); ?>
                    <!-- end Modal delete-->
                  </td>
                </tr>
                <?php $incomeIndex++; ?>

                <!-- Modal edit
                <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editLabel">Editing category name</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="POST">
                          <div class="mb-3">
                            <label for="newIncomeCategoryName" class="col-form-label">New name:</label>
                            <input type="text" class="form-control" id="newIncomeCategoryName">
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
                end Modal edit-->

              <?php endforeach; ?>
              <tr>
                <th>...</th>
                <td colspan="2" class="text-start">
                  <button type="button" class="btn btn-success custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit">
                    <img class="align-items-center justify-content-center" src="/assets/svg/plus-lg.svg" alt="plus" height="15" />
                  </button>
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
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                    <?php else : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                      <button type="button" class="btn btn-danger custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#delete-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/trash3.svg" alt="trash3" height="15" />
                      </button>
                    <?php endif; ?>

                    <!-- Modal delete-->
                    <?php include $this->resolve("modals/_delete-category.php"); ?>
                    <!-- end Modal delete-->
                  </td>
                </tr>
                <?php $expenseIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <th>...</th>
                <td colspan="2" class="text-start">
                  <button type="button" class="btn btn-success custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit">
                    <img class="align-items-center justify-content-center" src="/assets/svg/plus-lg.svg" alt="plus" height="15" />
                  </button>
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
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                    <?php else : ?>
                      <button type="button" class="btn btn-primary custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit">
                        <img class="align-items-center justify-content-center" src="/assets/svg/pen.svg" alt="pen" height="15" />
                      </button>
                      <button type="button" class="btn btn-danger custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#delete-cat-<?php echo e($category['id']); ?>">
                        <img class="align-items-center justify-content-center" src="/assets/svg/trash3.svg" alt="trash3" height="15" />
                      </button>
                    <?php endif; ?>

                    <!-- Modal delete-->
                    <?php include $this->resolve("modals/_delete-category.php"); ?>
                    <!-- end Modal delete-->
                  </td>
                </tr>
                <?php $methodIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <th>...</th>
                <td colspan="2" class="text-start">
                  <button type="button" class="btn btn-success custom-btn d-flex" data-bs-toggle="modal" data-bs-target="#edit">
                    <img class="align-items-center justify-content-center" src="/assets/svg/plus-lg.svg" alt="plus" height="15" />
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <div id="scrollToTop"></div>
</main>

<?php include $this->resolve("partials/_footer.php") ?>