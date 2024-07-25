<?php include $this->resolve("partials/_header-user.php") ?>

<main class="pb-75">
  <section class="container my-5">
    <div class="bg-light-red shadow py-4 px-2 px-md-5 rounded-3">
      <div class="text-center">
        <h2 class="mb-3">Balance sheet</h2>
        <hr class="" />
      </div>
      <div class="d-flex justify-content-center mb-3">
        <div class="dropdown">
          <button class="btn btn-secondary bg-grey-blue dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Choose time period
          </button>
          <form method="POST">
            <ul class="dropdown-menu">
              <li>
                <button class="dropdown-item <?php
                                              if (isset($_SESSION['m_active1'])) {
                                                echo $_SESSION['m_active1'];
                                                unset($_SESSION['m_active1']);
                                              } ?>" id="currentMonth" name="period" value="currentMonth">Current month </button>
              </li>
              <li>
                <button class="dropdown-item <?php
                                              if (isset($_SESSION['m_active2'])) {
                                                echo $_SESSION['m_active2'];
                                                unset($_SESSION['m_active2']);
                                              } ?>" id="previousMonth" name="period" value="previousMonth">Previous month</button>
              </li>
              <li>
                <button class="dropdown-item <?php
                                              if (isset($_SESSION['m_active3'])) {
                                                echo $_SESSION['m_active3'];
                                                unset($_SESSION['m_active3']);
                                              } ?>" id="currentYear" name="period" value="currentYear">Current year</button>
              </li>
              <li>
                <button type="button" class="dropdown-item <?php
                                                            if (isset($_SESSION['m_active4'])) {
                                                              echo $_SESSION['m_active4'];
                                                              unset($_SESSION['m_active4']);
                                                            } ?>" data-bs-toggle="modal" data-bs-target="#balanceModal" id="customPeriod">Custom period</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="balanceModal" tabindex="-1" aria-labelledby="balanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form method="post" class="modal-content">
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
        <?php
        if (isset($_SESSION['m_period'])) {
          echo '<p class="fs-5 lead" id="showDateRange">' . $_SESSION['m_period'] . '</p>';
          unset($_SESSION['m_period']);
        }
        ?>
      </div>
    </div>
  </section>
  <section class="container my-5">
    <div class="shadow py-4 px-2 px-md-5 bg-light-red rounded-3">
      <div class="text-center">
        <h3 class="mb-3 d-flex justify-content-center align-items-center">
          <img class="me-2" src="/assets/svg/bookmark-check.svg" alt="bookmark-check" height="30" />
          Your score
        </h3>
        <hr class="" />
      </div>
      <div class="text-center">
        <?php echo e($balance) >= 0 ? '<p class="fs-5 text-success">
              Congratulations! You manage your finances very well :)
            </p>' : '<p class="fs-5 text-danger">
              Be carefull! You are getting into debt :(
            </p>'
        ?>
        <p class="lead fs-2"><?php echo "Balance: " . e($balance) . " zł" ?>
        </p>
      </div>
    </div>
  </section>
  <section class="container my-5">
    <div class="shadow py-4 px-2 px-md-5 bg-light-red rounded-3">
      <div class="row">
        <div class="col-lg-6">
          <table class="table table-striped table-bordered table-hover">
            <caption class="h3">
              <img class="mb-3" src="/assets/svg/plus-circle-dotted.svg" alt="plus-circle-dotted" height="50" />
              <p class="h3 mb-3">Incomes by category</p>
            </caption>
            <thead>
              <tr class="bg-grey-blue">
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $incomeIndex = 1;
              foreach ($incomes as $income) {
                echo "<tr><th scope='row'>{$incomeIndex}</th><td>{$income['name']}</td><td>{$income['total']}</td></tr>";
                $incomeIndex++;
              }
              ?>
              <tr>
                <td colspan="2" class="text-center">Total incomes</td>
                <?php echo "<th>{$incomeTotal}</th>" ?>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-6">
          <table class="table table-striped table-bordered table-hover" id="expensesByCategoryTable">
            <caption class="h3">
              <img class="mb-3" src="/assets/svg/dash-circle-dotted.svg" alt="dash-circle-dotted" height="50" />
              <p class="h3 mb-3">Expenses by category</p>
            </caption>
            <thead>
              <tr class="bg-grey-blue">
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $expenseIndex = 1;
              foreach ($expenses as $expense) {
                echo "<tr><th scope='row'>{$expenseIndex}</th><td>{$expense['name']}</td><td>{$expense['total']}</td></tr>";
                $expenseIndex++;
              }
              ?>
              <tr>
                <td colspan="2" class="text-center">Total expenses</td>
                <?php echo "<th>{$expenseTotal}</th>"; ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <section class="container my-5">
    <div class="shadow py-4 px-2 px-md-5 bg-white rounded-3">
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

<?php include $this->resolve("partials/_footer.php") ?>