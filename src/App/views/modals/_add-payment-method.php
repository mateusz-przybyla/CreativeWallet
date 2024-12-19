<div class="modal fade" id="addPaymentMethodModal" tabindex="-1" aria-labelledby="addPaymentMethodLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/settings/add/payment-method" method="POST">
      <?php include $this->resolve("partials/_csrf.php"); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addPaymentMethodLabel">Add payment method</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="">
            <label for="addPaymentMethod" class="col-form-label">Category name:</label>
            <input type="text" name="newPaymentMethod" value="<?php
                                                              echo e($oldFormData['newPaymentMethod'] ?? '');
                                                              ?>" class="form-control" id="addPaymentMethod" required>
          </div>
          <div class="text-danger text-start small" id="addPaymentMethodError"></div>
        </div>
        <div class="modal-footer mt-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>