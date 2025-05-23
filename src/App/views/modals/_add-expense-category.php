<div class="modal fade" id="addExpenseCategoryModal" tabindex="-1" aria-labelledby="addExpenseCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/settings/add/expense-category" method="POST" id="formAddExpenseCategory">
      <?php include $this->resolve("partials/_csrf.php"); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addExpenseCategoryLabel">Add expense category</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-1" id="addExpenseCategoryArea">
            <label for="addExpenseCategory" class="col-form-label">Category name:</label>
            <input type="text" name="newExpenseCategory" value="<?php
                                                                echo e($oldFormData['newExpenseCategory'] ?? '');
                                                                ?>" class="form-control" id="addExpenseCategory">
          </div>
          <div class="text-danger text-start small" id="addExpenseCategoryError"></div>

        </div>
        <div class="modal-footer mt-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>