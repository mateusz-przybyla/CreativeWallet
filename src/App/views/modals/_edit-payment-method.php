<div class="modal fade" id="editPaymentMethodModal-<?php echo e($category['id']); ?>" tabindex="-1" aria-labelledby="editPaymentMethodLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/settings/edit/payment-method/<?php echo e($category['id']); ?>" method="POST">
      <?php include $this->resolve("partials/_csrf.php"); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editPaymentMethodLabel">Edit payment method</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="">
            <label for="editPaymentMethod-<?php echo e($category['id']); ?>" class="col-form-label">Payment method name:</label>
            <input type="text" name="editPaymentMethod" value="<?php echo e($category['name'] ?? ''); ?>" class="form-control" id="editPaymentMethod-<?php echo e($category['id']); ?>">
          </div>
          <div class="text-danger text-start small" id="editPaymentMethodError-<?php echo e($category['id']); ?>"></div>
        </div>
        <div class="modal-footer mt-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>