<?php include $this->resolve("partials/_header-user.php") ?>

<main class="pb-75">
  <section class="container my-5">
    <div class="bg-light-red shadow p-4 px-md-5 rounded-3">
      <div class="text-center">
        <h2 class="mb-3">Balance sheet</h2>
        <hr class="" />
      </div>
      <div class="d-flex justify-content-center mb-3">
        <div class="dropdown">
          <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 250px">
            Choose time period
          </button>
          <form method="GET">
            <ul class="dropdown-menu">
              <li>
                <button class="dropdown-item <?php
                                              if (isset($_SESSION['btn1'])) {
                                                echo e($_SESSION['btn1']);
                                                unset($_SESSION['btn1']);
                                              } ?>" id="currentMonth" name="period" value="currentMonth">Current month </button>
              </li>
              <li>
                <button class="dropdown-item <?php
                                              if (isset($_SESSION['btn2'])) {
                                                echo e($_SESSION['btn2']);
                                                unset($_SESSION['btn2']);
                                              } ?>" id="previousMonth" name="period" value="previousMonth">Previous month</button>
              </li>
              <li>
                <button class="dropdown-item <?php
                                              if (isset($_SESSION['btn3'])) {
                                                echo e($_SESSION['btn3']);
                                                unset($_SESSION['btn3']);
                                              } ?>" id="currentYear" name="period" value="currentYear">Current year</button>
              </li>
              <li>
                <button type="button" class="dropdown-item <?php
                                                            if (isset($_SESSION['btn4'])) {
                                                              echo e($_SESSION['btn4']);
                                                              unset($_SESSION['btn4']);
                                                            } ?>" data-bs-toggle="modal" data-bs-target="#balanceModal" id="customPeriod">Custom period</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="balanceModal" tabindex="-1" aria-labelledby="balanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form method="GET" class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fs-5" id="balanceModalLabel">
                Choose a date range:
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="d-flex">
                <div class="col-6">
                  <p>From:</p>
                  <input type="date" name="customStartDate" class="form-control me-1" id="balanceFromDate" />
                </div>
                <div class="col-6">
                  <p>To:</p>
                  <input type="date" name="customEndDate" class="form-control ms-1" id="balanceToDate" />
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button id="saveBtn" class="btn btn-primary" data-bs-dismiss="modal">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="text-center">
        <div class="d-md-flex justify-content-center">
          <p class="fs-5 mb-3 pe-2">Balance sheet for the period:</p>
          <p class="fs-5 lead" id="changePeriod"></p>
        </div>
        <?php if (isset($_SESSION['dateRange'])) : ?>
          <p class="fs-5 lead mb-0" id="showDateRange"> <?php echo e($_SESSION['dateRange']); ?> </p>
          <?php unset($_SESSION['dateRange']); ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <section class="container my-5">
    <div class="shadow p-4 px-md-5 bg-light-red rounded-3">
      <div class="text-center">
        <h3 class="mb-3 d-flex justify-content-center align-items-center">
          <img class="me-2" src="/assets/svg/bookmark-check.svg" alt="bookmark-check" height="30" />
          Your score
        </h3>
        <hr class="" />
      </div>
      <div class="text-center">
        <?php echo e($balance) >= 0 ?
          '<div class="alert alert-success pt-3 pb-0" role="alert">
              <p class="fs-5 text-success">
                Congratulations! You manage your finances very well :)
              </p>
           </div>'
          :
          '<div class="alert alert-danger pt-3 pb-0" role="alert">
              <p class="fs-5 text-danger">
              Be carefull! You are getting into debt :(
            </p>
           </div>'
        ?>
        <p class="lead fs-2 mb-0"><?php echo "Balance: " . e($balance) . " zł" ?>
        </p>
      </div>
    </div>
  </section>
  <section class="container my-5">
    <div class="shadow p-4 px-md-5 bg-light-red rounded-3">
      <div class="row">
        <div class="col-lg-6">
          <table class="table table-striped table-bordered table-hover">
            <caption class="h3">
              <img class="mb-2" src="/assets/svg/plus-circle-dotted.svg" alt="plus-circle-dotted" height="30" />
              <p class="h3 mb-2">Incomes by category</p>
            </caption>
            <thead>
              <tr class="bg-grey-blue">
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php $incomeIndex = 1;
              foreach ($incomes as $income) : ?>
                <tr>
                  <th scope='row'><?php echo e($incomeIndex); ?></th>
                  <td><?php echo e($income['name']) ?></td>
                  <td><?php echo e($income['total']) ?></td>
                </tr>
                <?php $incomeIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <td colspan="2" class="text-center">Total incomes</td>
                <th> <?php echo e($incomeTotal) ?></th>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-6">
          <table class="table table-striped table-bordered table-hover" id="expensesByCategoryTable">
            <caption class="h3">
              <img class="mb-2" src="/assets/svg/dash-circle-dotted.svg" alt="dash-circle-dotted" height="30" />
              <p class="h3 mb-2">Expenses by category</p>
            </caption>
            <thead>
              <tr class="bg-grey-blue">
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php $expenseIndex = 1;
              foreach ($expenses as $expense) : ?>
                <tr>
                  <th scope='row'><?php echo e($expenseIndex); ?></th>
                  <td><?php echo e($expense['name']) ?></td>
                  <td><?php echo e($expense['total']) ?></td>
                </tr>
                <?php $expenseIndex++; ?>
              <?php endforeach; ?>
              <tr>
                <td colspan="2" class="text-center">Total expenses</td>
                <th> <?php echo e($expenseTotal) ?></th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <section class="container my-5">
    <div class="shadow p-4 px-md-5 bg-white rounded-3">
      <div class="text-center mb-4">
        <h1 class="h3">Your expenses from the selected period</h1>
        <hr class="" />
      </div>
      <div class="d-flex justify-content-center">
        <div id="chartContainer"></div>
      </div>
    </div>
  </section>
  <div id="scrollToTop"></div>
</main>
<script>
  const dps = <?php echo json_encode($dataPoints); ?>;
</script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script src="/assets/js/chart.js" type="text/javascript"></script>
<script src="/assets/js/scroll-to-top.js" type="text/javascript"></script>

<?php include $this->resolve("partials/_footer.php") ?>