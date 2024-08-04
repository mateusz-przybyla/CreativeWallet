<div class="modal fade" id="edit-cat-<?php echo e($category['id']); ?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/settings/edit/<?php echo e($_SESSION['item']); ?>/<?php echo e($category['id']); ?>" method="POST">
      <?php include $this->resolve("partials/_csrf.php"); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editLabel">Edit category name</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="newCategoryName-<?php echo e($category['id']); ?>" class="col-form-label">New name:</label>
            <input type="text" name="newName" class="form-control" id="newCategoryName-<?php echo e($category['id']); ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>