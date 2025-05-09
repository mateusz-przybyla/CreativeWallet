<div class="modal fade" id="deleteExpenseCategoryModal-<?php echo e($category['id']); ?>" tabindex="-1" aria-labelledby="deleteExpenseCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/settings/delete/expense-category/<?php echo e($category['id']); ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteExpenseCategoryLabel">Delete expense category</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this expense category and related transactions?</p>
          <input type="hidden" name="_METHOD" value="DELETE" />

          <?php include $this->resolve("partials/_csrf.php"); ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>