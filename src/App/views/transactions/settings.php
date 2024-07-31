<?php include $this->resolve("partials/_header-user.php") ?>

<main class="pb-75">
  <section class="container my-5">
    <div class="shadow py-4 px-2 px-md-5 bg-light-red rounded-3">
      <div class="text-center">
        <h1 class="h3 mb-3 d-flex justify-content-center align-items-center">
          <img class="me-2" src="/assets/svg/gear.svg" alt="gear" height="30" />
          Transaction settings
        </h1>
        <hr class="" />
      </div>
      <div class="row">
        <div class="col-lg-4">
          <table class="table table-striped table-bordered table-hover">
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
                  <td><?php echo e($category['name']) ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit">edit</button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete">delete</button>
                  </td>
                </tr>
                <?php $incomeIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <td colspan="2" class="text-center">Total incomes</td>
                <th> <?php echo "" ?></th>
              </tr>
            </tbody>
          </table>
          <!-- Modal edit-->
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
          <!-- Modal delete-->
          <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="deleteLabel">Modal title</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr class="bg-grey-blue">
                <th scope="col">#</th>
                <th scope="col">Expense categories</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              <?php $incomeIndex = 1;
              foreach ($expenseCategories as $category) : ?>
                <tr>
                  <th scope='row'><?php echo e($incomeIndex); ?></th>
                  <td><?php echo e($category['name']) ?></td>
                  <td>edit, delete</td>
                </tr>
                <?php $incomeIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <td colspan="2" class="text-center">Total incomes</td>
                <th> <?php echo "" ?></th>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-4">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr class="bg-grey-blue">
                <th scope="col">#</th>
                <th scope="col">Payment methods</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              <?php $incomeIndex = 1;
              foreach ($paymentMethods as $method) : ?>
                <tr>
                  <th scope='row'><?php echo e($incomeIndex); ?></th>
                  <td><?php echo e($method['name']) ?></td>
                  <td>edit, delete</td>
                </tr>
                <?php $incomeIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <td colspan="2" class="text-center">Total incomes</td>
                <th> <?php echo "" ?></th>
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