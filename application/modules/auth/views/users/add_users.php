<?php $usergroups = $this->db->get('user_groups')->result(); ?>

<div class="row">
  <div class="col-lg-12">
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Add New User</h5>
      </div>
      <div class="card-body">
        <?php echo form_open_multipart(base_url('auth/adduser'), ['id' => 'userform', 'class' => 'user_form']); ?>
        <div class="form-row mb-3">
          <div class="col-md-6 col-lg-4">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
          </div>
          <div class="col-md-6 col-lg-4">
            <label>User Group</label>
            <select name="role" class="form-control select2" required>
              <option value="" disabled selected>Select User Group</option>
              <?php foreach ($usergroups as $usergroup): ?>
                <option value="<?= $usergroup->id ?>"><?= $usergroup->group_name ?></option>
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
              <?php foreach ($this->db->query('SELECT * FROM member_states ORDER BY member_state ASC')->result() as $row): ?>
                <option value="<?= $row->id ?>"><?= $row->member_state ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6 col-lg-4">
            <label>Level of Prioritisation</label>
            <select name="priotisation_level" class="form-control select2" required>
              <option value="" disabled selected>Select Level</option>
              <?php foreach ($this->db->get('priotisation_category')->result() as $row): ?>
                <option value="<?= $row->id ?>"><?= $row->name ?></option>
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
        </form>
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
                  <td><?= $user->group_name ?></td>
                  <td>
                    <a href="#" data-toggle="modal" data-target="#user<?= $user->id ?>">Edit</a>
                    <?php if ($user->status == 1): ?>
                      <a href="#" data-toggle="modal" data-target="#block<?= $user->id ?>">Block</a>
                    <?php else: ?>
                      <a href="#" data-toggle="modal" data-target="#unblock<?= $user->id ?>">Activate</a>
                    <?php endif; ?>
                    <a href="#" data-toggle="modal" data-target="#reset<?= $user->id ?>">Reset</a>
                  </td>
                </tr>
                <?php
                  include('user_details_modal.php');
                  include('confirm_reset.php');
                  include('confirm_block.php');
                  if ($user->status == 0) include('confirm_unblock.php');
                ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= $links ?>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function () {
  // Ensure select2 is available
  if ($.fn.select2) {
    $('.select2').select2();
  }

  // Ensure jQuery is loaded
  if (typeof $ === 'undefined') {
    console.error("jQuery not loaded");
    return;
  }

  // CSRF setup if CodeIgniter uses it (you can disable this block if not needed)

  // Submit handler for add user form
  $('#userform').on('submit', function (e) {
    e.preventDefault();
    showLoader();

    const formData = $(this).serializeArray();
    formData.push({ name: csrfName, value: csrfHash });

    $.post('<?= base_url('auth/addUser') ?>', formData, function (result) {
      showMessage(result);
      $('#userform')[0].reset();
      $('.select2').val(null).trigger('change'); // Reset select2s
    }).fail(function (xhr) {
      console.error("Error:", xhr.responseText);
      showMessage('Error occurred while submitting form.');
    });
  });

  // Submit handler for update/reset/block/unblock forms
  $('.update_user, .reset, .block, .unblock').on('submit', function (e) {
    e.preventDefault();
    showLoader();

    const url = $(this).attr('action');
    const formData = new FormData(this);
    formData.append(csrfName, csrfHash);

    $.ajax({
      url: url,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (result) {
        showMessage(result);
      },
      error: function (xhr) {
        console.error("Error:", xhr.responseText);
        showMessage('Failed to submit the form.');
      }
    });
  });
});
</script>

