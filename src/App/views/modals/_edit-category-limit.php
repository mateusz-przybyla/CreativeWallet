<div class="modal fade" id="edit-<?php echo e($_SESSION['item']); ?>-<?php echo e($category['id']); ?>" tabindex="-1" aria-labelledby="limitLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/settings/edit/<?php echo e($_SESSION['item']); ?>/<?php echo e($category['id']); ?>" method="POST">
      <?php include $this->resolve("partials/_csrf.php"); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="limitLabel">Edit category and limit</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="newCategoryName-<?php echo e($_SESSION['item']); ?>-<?php echo e($category['id']); ?>" class="col-form-label">Category name:</label>
            <input type="text" name="newName" value="<?php echo e($category['name'] ?? ''); ?>" class="form-control" id="newCategoryName-<?php echo e($_SESSION['item']); ?>-<?php echo e($category['id']); ?>">
          </div>
          <div class="form-check mt-4 mb-2">
            <input class="form-check-input" type="checkbox" value="" id="activateLimit-<?php echo e($_SESSION['item']); ?>-<?php echo e($category['id']); ?>">
            <label class="form-check-label" for="activateLimit-<?php echo e($_SESSION['item']); ?>-<?php echo e($category['id']); ?>">
              Activate limit
            </label>
          </div>
          <div class="mb-3">
            <label for="limit-<?php echo e($_SESSION['item']); ?>-<?php echo e($category['id']); ?>" class="col-form-label">Set monthly limit:</label>
            <input type="number" name="limit" value="<?php echo e($category['category_limit'] ?? ''); ?>" step="0.01" class="form-control" id="limit-<?php echo e($_SESSION['item']); ?>-<?php echo e($category['id']); ?>">
          </div>
        </div>
        <div class=" modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function() {
    $("#limit-<?php echo e($_SESSION['item']); ?>-<?php echo e($category['id']); ?>").attr("disabled", true);

    $("#activateLimit-<?php echo e($_SESSION['item']); ?>-<?php echo e($category['id']); ?>").change(function() {
      $("#limit-<?php echo e($_SESSION['item']); ?>-<?php echo e($category['id']); ?>").attr("disabled", !(this.checked));

      if (!(this.checked)) {
        $("#limit-<?php echo e($_SESSION['item']); ?>-<?php echo e($category['id']); ?>").val('');
      }
    });
  });
</script>