<?php include $this->resolve("partials/_header-user.php") ?>

<main class="pb-60">
  <div class="container my-5">
    <div class="bg-light-red shadow pt-3 ps-4 pe-4 pb-4 ps-md-5 pe-md-5 pb-md-5 rounded-3">
      <?php if (isset($newTrans)) : ?>
        <div class="text-success text-center my-3"> <?php echo e($newTrans); ?> </div>
      <?php endif; ?>
      <div class="text-center">
        <h1 class="h2">Add your Expense</h1>
        <hr />
      </div>
      <div class="row d-flex flex-column align-items-center">
        <div class="col-md-9 col-lg-7 col-xxl-5">
          <div class="card my-2">
            <h6 class="card-header bg-grey-blue">Monthly limit for this category:</h6>
            <div class="card-body py-2">
              <p class="card-text" id="limitInfo"></p>
            </div>
          </div>
          <div class="card mb-2">
            <h6 class="card-header bg-grey-blue">Cash spent:</h6>
            <div class="card-body py-2">
              <p class="card-text" id="cashSpent"></p>
            </div>
          </div>
          <div class="card">
            <h6 class="card-header bg-grey-blue">Limit balance after operation:</h6>
            <div class="card-body py-2">
              <p class="card-text" id="cashLeft"></p>
            </div>
          </div>
        </div>
        <form class="col-md-9 col-lg-7 col-xxl-5" method="POST">
          <?php
          include $this->resolve("partials/_csrf.php");
          ?>
          <div class="mt-4 mb-2">
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
            <?php if (array_key_exists('category', $errors)) : ?>
              <div class="text-danger text-start small">
                <?php echo e($errors['category'][0]); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-2">
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
            <div class="input-group">
              <span class="input-group-text bg-grey-blue rounded-end-0"><img src="/assets/svg/123.svg" alt="amount" width="25" /></span>
              <input type="number" name="amount" value="<?php echo e($oldFormData['amount'] ?? ''); ?>" step="0.01" class="form-control" id="amount" placeholder="Amount" />
              <span class="input-group-text bg-grey-blue">.00</span>
            </div>
            <?php if (array_key_exists('amount', $errors)) : ?>
              <div class="text-danger text-start small">
                <?php echo e($errors['amount'][0]); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-2">
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
            <?php if (array_key_exists('paymentMethod', $errors)) : ?>
              <div class="text-danger text-start small">
                <?php echo e($errors['paymentMethod'][0]); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
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
          <div class="d-flex justify-content-center">
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
<script>
  const expenseLimitField = document.getElementById("limitInfo");
  const moneySpentField = document.getElementById("cashSpent");
  const moneyLeftField = document.getElementById("cashLeft");

  const amountField = document.getElementById("amount");
  const dateField = document.getElementById("date");
  const categoryField = document.getElementById("category");

  amountField.addEventListener("input", (event) => {
    var val = event.target.value;
    showMoneyLeft(val);
  });

  [categoryField, dateField].forEach((element) => {
    element.addEventListener("change", async () => {
      await showCategoryLimit();
      await showMoneySpent();
    });
  });

  window.addEventListener("load", () => {
    showCategoryLimit();
    showMoneySpent();
    showMoneyLeft();
  });

  const showCategoryLimit = async () => {
    var categoryId = categoryField.options[categoryField.selectedIndex].id;
    var category = categoryField.options[categoryField.selectedIndex].text.trim();

    if (category === "Choose category") {
      expenseLimitField.textContent = "Category required";
    } else {
      var limitAmount = await getCategoryLimit(categoryId);

      if (limitAmount === null) {
        expenseLimitField.textContent = "No limit set";
      } else {
        expenseLimitField.textContent = `${limitAmount} PLN`;
      }
    }
  }

  const getCategoryLimit = async (categoryId) => {
    try {
      const res = await fetch(`/api/limit/${categoryId}`);
      return await res.json();
    } catch (error) {
      console.log('ERROR: ', error);
    }
  }

  const showMoneySpent = async () => {
    var categoryId = categoryField.options[categoryField.selectedIndex].id;
    var category = categoryField.options[categoryField.selectedIndex].text.trim();
    var date = dateField.value;

    if ((category === "Choose category") || (date === "")) {
      moneySpentField.textContent = "Category and date required";
    } else {
      var amountSpent = await getMoneySpent(categoryId, date);

      console.log(amountSpent);

      if (amountSpent === null) {
        moneySpentField.textContent = "You did not spent any money for this category this month";
      } else
        moneySpentField.textContent = `${amountSpent} PLN`;
    }
  }

  const getMoneySpent = async (categoryId, date) => {
    try {
      const res = await fetch(`/api/amount/${categoryId}/${date}`);
      return await res.json();
    } catch (error) {
      console.log('ERROR: ', error);
    }

  }

  const showMoneyLeft = (amountValue) => {
    var category = categoryField.options[categoryField.selectedIndex].text.trim();
    var date = dateField.value;

    moneyLeftField.style.color = "rgb(33, 37, 41)";

    if ((category === "Choose category") || (date === "") || (amountValue === "")) {
      moneyLeftField.textContent = "Category, date and amount required";
    } else {
      var limitInfo = expenseLimitField.textContent.replace(/[^0-9\.]/g, "");
      var moneySpent = moneySpentField.textContent.replace(/[^0-9\.]/g, "");

      if ((limitInfo === "")) {
        moneyLeftField.textContent = "No limit set";
      } else {
        var cashLeft = Number(limitInfo) - Number(moneySpent) - amountValue;
        if (cashLeft >= 0) {
          moneyLeftField.style.color = "green";
        } else {
          moneyLeftField.style.color = "red";
        }
        moneyLeftField.textContent = `${cashLeft.toFixed(2)} PLN`;
      }
    }
  }
</script>

<?php include $this->resolve("partials/_footer.php") ?>