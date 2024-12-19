<div class="modal fade" id="editExpenseCategoryModal-<?php echo e($category['id']); ?>" tabindex="-1" aria-labelledby="editExpenseCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/settings/edit/expense-category/<?php echo e($category['id']); ?>" method="POST">
      <?php include $this->resolve("partials/_csrf.php"); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editExpenseCategoryLabel">Edit expense category and limit</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="">
            <label for="editExpenseCategory-<?php echo e($category['id']); ?>" class="col-form-label">Category name:</label>
            <input type="text" name="editExpenseCategory" value="<?php echo e($category['name'] ?? ''); ?>" class="form-control" id="editExpenseCategory-<?php echo e($category['id']); ?>" required>
          </div>
          <div class="text-danger text-start small" id="editExpenseCategoryError-<?php echo e($category['id']); ?>"></div>
          <div class="form-check mt-4 mb-2">
            <input class="form-check-input" type="checkbox" id="activateLimit-<?php echo e($category['id']); ?>" name="activateLimit" <?php echo e($category['category_limit'] ? "checked" : ""); ?>>
            <label class="form-check-label" for="activateLimit-<?php echo e($category['id']); ?>">
              Activate limit
            </label>
          </div>
          <div class="">
            <label for="expenseLimit-<?php echo e($category['id']); ?>" class="col-form-label">Set monthly limit:</label>
            <input type="number" name="expenseLimit" value="<?php echo e($category['category_limit'] ?? ''); ?>" step="0.01" class="form-control" id="expenseLimit-<?php echo e($category['id']); ?>" required>
          </div>
        </div>
        <div class=" modal-footer mt-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function() {
    if (!"<?php echo e($category['category_limit']); ?>") {
      $("#expenseLimit-<?php echo e($category['id']); ?>").attr("disabled", true);
    }

    $("#activateLimit-<?php echo e($category['id']); ?>").change(function() {
      $("#expenseLimit-<?php echo e($category['id']); ?>").attr("disabled", !(this.checked));

      if (!(this.checked)) {
        $("#expenseLimit-<?php echo e($category['id']); ?>").val('');
      }
    });
  });
</script>