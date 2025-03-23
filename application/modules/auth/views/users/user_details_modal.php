<!-- User Update Modal -->
<div class="modal fade" id="user<?= $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="updateUserLabel<?= $user->id ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="updateUserLabel<?= $user->id ?>">Update: <?= $user->name ?></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php echo form_open_multipart(base_url('auth/updateUser'), ['class' => 'update_user']); ?>
      <div class="modal-body">
        <div class="status text-center text-info mb-3"></div>

        <input type="hidden" name="id" value="<?= $user->id ?>">

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="<?= $user->name ?>" required>
          </div>

          <div class="form-group col-md-6">
            <label>Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" value="<?= $user->email ?>" required>
          </div>

          <div class="form-group col-md-6">
            <label>User Group <span class="text-danger">*</span></label>
            <select name="role" class="form-control select2" required style="width:100%;">
              <option value="" disabled>Select User Group</option>
              <?php foreach ($usergroups as $group): ?>
                <option value="<?= $group->id ?>" <?= $user->role == $group->id ? 'selected' : '' ?>>
                  <?= $group->group_name ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group col-md-6">
            <label>Organisation</label>
            <input type="text" name="organization_name" class="form-control" value="<?= $user->organization_name ?>" placeholder="Organisation">
          </div>

          <div class="form-group col-md-6">
            <label>Member State <span class="text-danger">*</span></label>
            <select name="memberstate_id" class="form-control select2" required style="width:100%;">
              <option value="" disabled>Select Member State</option>
              <?php
              $states = $this->db->get('member_states')->result();
              foreach ($states as $state): ?>
                <option value="<?= $state->id ?>" <?= $user->memberstate_id == $state->id ? 'selected' : '' ?>>
                  <?= $state->member_state ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group col-md-6">
            <label>Level of Prioritisation <span class="text-danger">*</span></label>
            <select name="priotisation_level" class="form-control select2" required style="width:100%;">
              <option value="" disabled>Select Level</option>
              <?php
              $levels = $this->db->get('priotisation_category')->result();
              foreach ($levels as $level): ?>
                <option value="<?= $level->id ?>" <?= $user->priotisation_level == $level->id ? 'selected' : '' ?>>
                  <?= $level->name ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>

      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-info btn-sm">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
