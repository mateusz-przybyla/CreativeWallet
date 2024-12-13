<?php include $this->resolve("partials/_header-user.php") ?>

<main class="pb-60">
  <div class="container my-5">
    <div class="bg-light-red shadow p-5 rounded-3">
      <?php if (isset($newTrans)) : ?>
        <div class="text-success text-center mb-3"> <?php echo e($newTrans); ?> </div>
      <?php endif; ?>
      <div class="text-center">
        <h1 class="h3 mb-4">Please enter data for new Expense:</h1>
      </div>
      <div class="row d-flex justify-content-center">
        <form class="col-md-8 col-lg-7 col-xl-6" method="POST">
          <?php
          include $this->resolve("partials/_csrf.php");
          ?>
          <div class="mb-2">
            <label for="expenseAmount" class="form-label">Amount</label>
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/123.svg" alt="amount" width="25" /></span>
              <input type="number" name="amount" value="<?php echo e($oldFormData['amount'] ?? ''); ?>" step="0.01" class="form-control" id="expenseAmount" />
            </div>
            <?php if (array_key_exists('amount', $errors)) : ?>
              <div class="text-danger text-start small">
                <?php echo e($errors['amount'][0]); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-2">
            <label for="date" class="form-label">Date</label>
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/calendar-date.svg" alt="calendar-date" width="25" /></span>
              <input type="date" name="date" value="<?php echo e($oldFormData['date'] ?? ''); ?>" class="form-control" id="date" />
            </div>
            <?php if (array_key_exists('date', $errors)) : ?>
              <div class="text-danger text-start small">
                <?php echo e($errors['date'][0]); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-2">
            <label for="expensePayment" class="form-label">Payment methods</label>
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/credit-card.svg" alt="credit-card" width="25" /></span>
              <select class="form-select" name="paymentMethod" id="paymentMethod">
                <option value="">--- Choose payment method ---</option>
                <?php foreach ($paymentMethods as $paymentMethod) : ?>
                  <option <?php if (array_key_exists('category', $oldFormData)) {
                            echo e($oldFormData['paymentMethod'] === $paymentMethod['name'] ? 'selected' : '');
                          } ?>><?php echo e($paymentMethod['name']); ?></option>;
                <?php endforeach; ?>
              </select>
            </div>
            <?php if (array_key_exists('paymentMethod', $errors)) : ?>
              <div class="text-danger text-start small">
                <?php echo e($errors['paymentMethod'][0]); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-2">
            <label for="expenseCategory" class="form-label">Category</label>
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/tags-fill.svg" alt="tags-fill" width="25" /></span>
              <select class="form-select" name="category" id="expenseCategory">
                <option value="">--- Choose category ---</option>
                <?php foreach ($expenseCategories as $expenseCategory) : ?>
                  <option <?php if (array_key_exists('category', $oldFormData)) {
                            echo e($oldFormData['category'] === $expenseCategory['name'] ? 'selected' : '');
                          } ?>><?php echo e($expenseCategory['name']); ?></option>;
                <?php endforeach; ?>
              </select>
              </select>
            </div>
            <?php if (array_key_exists('category', $errors)) : ?>
              <div class="text-danger text-start small">
                <?php echo e($errors['category'][0]); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="expenseComment" class="form-label">Comment</label>
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/chat-dots-fill.svg" alt="chat-dots-fill" width="25" /></span>
              <textarea class="form-control" name="comment" id="expenseComment" rows="2" placeholder="Enter your comment here (optional)"></textarea>
            </div>
            <?php if (array_key_exists('comment', $errors)) : ?>
              <div class="text-danger text-start small">
                <?php echo e($errors['comment'][0]); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="container">
            <div class="row d-flex justify-content-between gy-2">
              <a href="/welcome" class="col-sm-3 btn btn-lg btn-danger">
                Cancel
              </a>
              <button class="col-sm-3 btn btn-lg btn-success" type="submit">
                Add
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<?php include $this->resolve("partials/_footer.php") ?>