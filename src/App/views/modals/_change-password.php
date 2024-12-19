<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/settings/change/password" method="POST">
      <?php include $this->resolve("partials/_csrf.php"); ?>
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="changePasswordLabel">Change password</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="">
            <label for="oldPassword" class="col-form-label">Old password:</label>
            <input type="password" name="oldPassword" class="form-control" id="oldPassword">
          </div>
          <div class="text-danger text-start small" id="oldPasswordError"></div>
          <div class="mt-2">
            <label for="newPassword" class="col-form-label">Create new password:</label>
            <input type="password" name="newPassword" class="form-control" id="newPassword">
          </div>
          <div class="text-danger text-start small" id="newPasswordError"></div>
          <div class="mt-2">
            <label for="newPasswordConfirmed" class="col-form-label">Confirm new password:</label>
            <input type="password" name="newPasswordConfirmed" class="form-control" id="newPasswordConfirmed">
          </div>
          <div class="text-danger text-start small" id="newPasswordConfirmedError"></div>
        </div>
        <div class="modal-footer mt-1">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>