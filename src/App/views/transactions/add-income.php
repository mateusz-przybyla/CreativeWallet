<?php include $this->resolve("partials/_header-user.php") ?>

<main class="pb-60">
  <div class="container my-5">
    <div class="bg-light-red shadow p-5 rounded-3">
      <?php if (isset($newTrans)) : ?>
        <div class="text-success text-center mb-3"> <?php echo e($newTrans) ?> </div>
      <?php endif; ?>
      <div class="text-center">
        <h1 class="h3 mb-4">Please enter data for new Income:</h1>
      </div>
      <div class="row d-flex justify-content-center">
        <form class="col-md-8 col-lg-7 col-xl-6" method="POST">
          <?php
          include $this->resolve("partials/_csrf.php");
          ?>
          <div class="mb-2">
            <label for="incomeAmount" class="form-label">Amount</label>
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/123.svg" alt="amount" width="25" /></span>
              <input type="number" name="amount" value="<?php echo e($oldFormData['amount'] ?? ''); ?>" step="0.01" class="form-control" id="incomeAmount" />
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
            <label for="incomeCategory" class="form-label">Category</label>
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/tags-fill.svg" alt="tags-fill" width="25" /></span>
              <select class="form-select" name="category" id="incomeCategory">
                <option value="">Choose...</option>
                <?php foreach ($incomeCategories as $incomeCategory) : ?>
                  <option <?php if (array_key_exists('category', $oldFormData)) {
                            echo e($oldFormData['category'] === $incomeCategory['name'] ? 'selected' : '');
                          } ?>><?php echo e($incomeCategory['name']); ?></option>;
                <?php endforeach; ?>
              </select>
            </div>
            <?php if (array_key_exists('category', $errors)) : ?>
              <div class="text-danger text-start small">
                <?php echo e($errors['category'][0]); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="incomeComment" class="form-label">Comment (Optional)</label>
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/chat-dots-fill.svg" alt="chat-dots-fill" width="25" /></span>
              <textarea class="form-control" name="comment" id="incomeComment" rows="2"></textarea>
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