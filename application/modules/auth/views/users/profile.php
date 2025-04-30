<div class="d-flex justify-content-center">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="card box-widget widget-user">
            <div class="card-body text-center">
                <div class="item-user pro-user">
                    <?php $session = ($this->session->userdata()); ?>
                    <h4 class="pro-user-username tx-15 pt-2 mt-4 mb-1"><?php echo $session['name']; ?></h4>
                    <h6 class="pro-user-desc tx-13 mb-3 font-weight-normal text-muted"><?php echo $session['group_name']; ?></h6>
                </div>
            </div>
        </div>

        <?php echo form_open('auth/changePass', ['method' => 'post', 'id' => 'changePass']) ?>

        <div class="card">
            <div class="card-header pb-0 border-bottom">
                <div class="card-title pb-1">Change Password</div>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">Old Password</label>
                    <input type="hidden" name="id" class="form-control" value="<?= $session['id'] ?>" required>
                    <input type="password" name="old_password" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="#" class="btn btn-danger">Cancel</a>
            </div>
        </div>

        <?php echo form_close() ?>
    </div>
</div>
