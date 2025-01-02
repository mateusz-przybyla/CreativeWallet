<?php include $this->resolve("partials/_header-user.php") ?>

<main class="pb-60">
  <div class="container my-5">
    <div class="bg-light-red shadow p-4 pb-md-5 px-md-5 rounded-3">

      <?php if (e($flashNotifications)) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <p class="text-center pb-0 mb-0">
            <?php echo e($flashNotifications); ?>
          </p>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <div class="text-center">
        <h1 class="h2">Add your Expense</h1>
        <hr />
      </div>
      <div class="row d-flex flex-column align-items-center">
        <div class="col-md-9 col-lg-7 col-xxl-5">
          <div class="card my-2" id="limitInfoCard" hidden>
            <h6 class="card-header bg-grey-blue">Monthly limit for this category:</h6>
            <div class="card-body py-2">
              <p class="card-text" id="limitInfo"></p>
            </div>
          </div>
          <div class="card mb-2" id="cashSpentCard" hidden>
            <h6 class="card-header bg-grey-blue">Cash spent:</h6>
            <div class="card-body py-2">
              <p class="card-text" id="cashSpent"></p>
            </div>
          </div>
          <div class="card" id="cashLeftCard" hidden>
            <h6 class="card-header bg-grey-blue">Limit balance after operation:</h6>
            <div class="card-body py-2">
              <p class="card-text" id="cashLeft"></p>
            </div>
          </div>
        </div>
        <form class="col-md-9 col-lg-7 col-xxl-5" method="POST" id="formAddExpense">
          <?php
          include $this->resolve("partials/_csrf.php");
          ?>
          <div class="mt-4 mb-1" id="expenseCategoryArea">
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/tags-fill.svg" alt="tags-fill" width="25" /></span>
              <select class="form-select" name="category" id="category">
                <option value="">Choose category</option>
                <?php foreach ($expenseCategories as $expenseCategory) : ?>
                  <option id="<?php echo e($expenseCategory['id']); ?>" <?php if (array_key_exists('category', $oldFormData)) {
                                                                          echo e($oldFormData['category'] === $expenseCategory['name'] ? 'selected' : '');
                                                                        } ?>><?php echo e($expenseCategory['name']); ?></option>;
                <?php endforeach; ?>
              </select>
              </select>
            </div>
          </div>
          <?php if (array_key_exists('category', $errors)) : ?>
            <div class="text-danger text-start small">
              <?php echo e($errors['category'][0]); ?>
            </div>
          <?php endif; ?>

          <div class="mb-1 mt-2" id="expenseDateArea">
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/calendar-date.svg" alt="calendar-date" width="25" /></span>
              <input type="date" name="date" value="<?php echo e($oldFormData['date'] ?? ''); ?>" class="form-control" id="date" />
            </div>
          </div>
          <?php if (array_key_exists('date', $errors)) : ?>
            <div class="text-danger text-start small">
              <?php echo e($errors['date'][0]); ?>
            </div>
          <?php endif; ?>

          <div class="mb-1 mt-2" id="expenseAmountArea">
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/123.svg" alt="amount" width="25" /></span>
              <input type="number" name="amount" value="<?php echo e($oldFormData['amount'] ?? ''); ?>" step="0.01" class="form-control" id="amount" placeholder="Amount" />
              <span class="input-group-text bg-grey-blue">.00</span>
            </div>
          </div>
          <?php if (array_key_exists('amount', $errors)) : ?>
            <div class="text-danger text-start small">
              <?php echo e($errors['amount'][0]); ?>
            </div>
          <?php endif; ?>

          <div class="mb-1 mt-2" id="expensePaymentMethodArea">
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/credit-card.svg" alt="credit-card" width="25" /></span>
              <select class="form-select" name="paymentMethod" id="paymentMethod">
                <option value="">Choose payment method</option>
                <?php foreach ($paymentMethods as $paymentMethod) : ?>
                  <option <?php if (array_key_exists('category', $oldFormData)) {
                            echo e($oldFormData['paymentMethod'] === $paymentMethod['name'] ? 'selected' : '');
                          } ?>><?php echo e($paymentMethod['name']); ?></option>;
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <?php if (array_key_exists('paymentMethod', $errors)) : ?>
            <div class="text-danger text-start small">
              <?php echo e($errors['paymentMethod'][0]); ?>
            </div>
          <?php endif; ?>

          <div class="mb-1 mt-2">
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/chat-dots-fill.svg" alt="chat-dots-fill" width="25" /></span>
              <textarea class="form-control" name="comment" id="expenseComment" rows="2" placeholder="Enter your comment here (optional)"></textarea>
            </div>
          </div>
          <?php if (array_key_exists('comment', $errors)) : ?>
            <div class="text-danger text-start small">
              <?php echo e($errors['comment'][0]); ?>
            </div>
          <?php endif; ?>

          <div class="d-flex justify-content-center mt-3">
            <button class="col-sm-3 btn btn-md btn-dark mw-3 w-100" type="submit">
              Add expense
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
<script src="/assets/js/set-current-date.js" type="text/javascript"></script>
<script src="/assets/js/use-limit.js" type="text/javascript"></script>
<script src="/assets/js/expense-form.js" type="text/javascript"></script>

<?php include $this->resolve("partials/_footer.php") ?>