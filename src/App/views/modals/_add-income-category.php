<div class="modal fade" id="addIncomeCategoryModal" tabindex="-1" aria-labelledby="addIncomeCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/settings/add/income-category" method="POST" id="formAddIncomeCategory">
      <?php include $this->resolve("partials/_csrf.php"); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addIncomeCategoryLabel">Add income category</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-1">
            <label for="addIncomeCategory" class="col-form-label">Category name:</label>
            <input type="text" name="newIncomeCategory" value="<?php
                                                                echo e($oldFormData['newIncomeCategory'] ?? '');
                                                                ?>" class="form-control" id="addIncomeCategory">
          </div>
          <div class="text-danger text-start small" id="addIncomeCategoryError"></div>

        </div>
        <div class="modal-footer mt-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>