<?php $usergroups = $this->db->get('user_groups')->result(); 


?>
<?php $member_states = $this->db->query('SELECT * FROM member_states ORDER BY member_state ASC')->result(); ?>
<?php $levels = $this->db->get('priotisation_category')->result(); ?>

<div class="row">
  <div class="col-lg-12">
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Add New User</h5>
      </div>
      <?php //dd($this->session->userdata('user')); ?>
      <div class="card-body">
        <?= form_open_multipart(base_url('auth/adduser'), ['id' => 'userform', 'class' => 'user_form']) ?>
        <div class="form-row mb-3">
          <div class="col-md-6 col-lg-4">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
          </div>
          <div class="col-md-6 col-lg-4">
            <label>User Group</label>
            <select name="role" class="form-control select2" required>
              <option value="" disabled selected>Select User Group</option>
              <?php foreach ($usergroups as $group): ?>
                <option value="<?= $group->id ?>"><?= $group->group_name ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6 col-lg-4">
            <label>Email (Default Password: mycountry$$)</label>
            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
            <input type="hidden" name="password" value="<?= htmlspecialchars(setting()->default_password, ENT_QUOTES, 'UTF-8') ?>" readonly>
          </div>
          <div class="col-md-6 col-lg-4">
            <label>Member State</label>
            <select name="memberstate_id" class="form-control select2" required>
              <option value="" disabled selected>Select Member State</option>
              <?php foreach ($member_states as $state): ?>
                <option value="<?= $state->id ?>"><?= $state->member_state ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6 col-lg-4">
            <label>Level of Prioritisation</label>
            <select name="priotisation_level" class="form-control select2" required>
              <option value="" disabled selected>Select Level</option>
              <?php foreach ($levels as $level): ?>
                <option value="<?= $level->id ?>"><?= $level->name ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6 col-lg-4">
            <label>Organisation</label>
            <input type="text" name="organization_name" class="form-control" placeholder="Organization Name">
          </div>
        </div>
        <div class="form-group text-right">
          <button type="submit" class="btn btn-primary btn-sm">Save</button>
          <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
        </div>
        <div class="status text-center text-info"></div>
        <?= form_close() ?>
      </div>
    </div>
  </div>

  <div class="col-lg-12">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">User List</h5>
        <form class="form-inline" method="post" action="<?= base_url('auth/users') ?>">
          <div class="input-group input-group-sm">
            <input type="text" name="search_key" class="form-control" placeholder="Search username or name">
            <div class="input-group-append">
              <button class="btn btn-light" type="submit">Search</button>
            </div>
          </div>
        </form>
      </div>
      <div class="card-body">
        <?= $links ?>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Member State</th>
                <th>Level</th>
                <th>Organization</th>
                <th>User Group</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($users as $user): ?>
                <tr>
                  <td><?= $no++ ?>.</td>
                  <td><?= $user->name ?></td>
                  <td><?= $user->email ?></td>
                  <td><?= get_value($user->memberstate_id, 'member_states')->member_state ?? '-' ?></td>
                  <td><?= get_value($user->priotisation_level, 'priotisation_category')->name ?? '-' ?></td>
                  <td><?= $user->organization_name ?></td>
                  <td><?= get_user_group($user->role)->group_name; ?></td>
                  <td>
                    <a class="btn btn-sm btn-info editBtn"
                      data-id="<?= $user->id ?>"
                      data-name="<?= htmlspecialchars($user->name, ENT_QUOTES) ?>"
                      data-email="<?= htmlspecialchars($user->email, ENT_QUOTES) ?>"
                      data-role="<?= $user->role ?>"
                      data-org="<?= htmlspecialchars($user->organization_name, ENT_QUOTES) ?>"
                      data-memberstate="<?= $user->memberstate_id ?>"
                      data-level="<?= $user->priotisation_level ?>"
                      data-toggle="modal" data-target="#editUserModal">
                      Edit
                    </a>
                    <?php if ($user->status == 1): ?>
                      <a href="#" data-toggle="modal" data-target="#block<?= $user->id ?>" class="btn btn-sm btn-warning editBtn">Block</a>
                    <?php else: ?>
                      <a href="#" data-toggle="modal" data-target="#unblock<?= $user->id ?>" class="btn btn-sm btn-danger editBtn">Activate</a>
                    <?php endif; ?>
                    <a href="#" data-toggle="modal" data-target="#reset<?= $user->id ?>" class="btn btn-sm btn-danger editBtn">Reset</a>
                  </td>
                </tr>
                <?php include('confirm_reset.php'); ?>
                <?php include('confirm_block.php'); ?>
                <?php if ($user->status == 0) include('modals/confirm_unblock.php'); ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= $links ?>
      </div>
    </div>
  </div>
</div>

<!-- Shared Edit Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <?= form_open_multipart(base_url('auth/updateUser'), ['class' => 'update_user']) ?>
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="status text-center text-info mb-3"></div>
        <input type="hidden" name="id" id="edit_id">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Name</label>
            <input type="text" name="name" id="edit_name" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" name="email" id="edit_email" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
            <label>User Group</label>
            <select name="role" id="edit_role" class="form-control select2" required>
              <option value="">-- Select --</option>
              <?php foreach ($usergroups as $group): ?>
                <option value="<?= $group->id ?>"><?= $group->group_name ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label>Organization</label>
            <input type="text" name="organization_name" id="edit_org" class="form-control">
          </div>
          <div class="form-group col-md-6">
            <label>Member State</label>
            <select name="memberstate_id" id="edit_state" class="form-control select2" required>
              <?php foreach ($member_states as $state): ?>
                <option value="<?= $state->id ?>"><?= $state->member_state ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label>Prioritisation Level</label>
            <select name="priotisation_level" id="edit_level" class="form-control select2" required>
              <?php foreach ($levels as $level): ?>
                <option value="<?= $level->id ?>"><?= $level->name ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-info btn-sm">Update</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
  if ($.fn.select2) {
    $('.select2').select2();
  }

  // Handle dynamic modal data binding
  $(document).on('click', '.editBtn', function () {
    $('#edit_id').val($(this).data('id'));
    $('#edit_name').val($(this).data('name'));
    $('#edit_email').val($(this).data('email'));
    $('#edit_org').val($(this).data('org'));
    $('#edit_role').val($(this).data('role')).trigger('change');
    $('#edit_state').val($(this).data('memberstate')).trigger('change');
    $('#edit_level').val($(this).data('level')).trigger('change');
  });
});
</script>