<div class="container-fluid py-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Manage Diseases</h5>
      <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#diseaseModal" id="create-new">+ New Disease</button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="diseases-table">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Disease</th>
              <th>Description</th>
              <th>Thematic Area</th>
              <th class="text-center" style="width: 160px;">Actions</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="diseaseModal" tabindex="-1" role="dialog" aria-labelledby="diseaseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form id="form-disease" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="diseaseModalLabel">Disease Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Disease Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>
          <div class="form-group col-md-6">
            <label>Thematic Area <span class="text-danger">*</span></label>
            <select name="thematic_area_id" id="thematic_area_id" class="form-control" required>
              <option value="">-- Select Thematic Area --</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>
<script>
    $(document).ready(function () {
  let table;

  function notifyUser(msg, type = 'success') {
    $.notify(msg, { className: type, globalPosition: 'top right' });
  }

  function loadThematicAreas() {
    $.getJSON('<?= base_url('lists/get_thematic_areas') ?>', function (data) {
      let options = '<option value="">-- Select Thematic Area --</option>';
      data.forEach(area => {
        options += `<option value="${area.id}">${area.name}</option>`;
      });
      $('#thematic_area_id').html(options);
    });
  }

  function loadDiseases() {
    if ($.fn.DataTable.isDataTable('#diseases-table')) {
      table.destroy();
    }

    $.getJSON('<?= base_url('lists/fetch_all') ?>', function (data) {
      let rows = '';
      data.forEach((disease, index) => {
        rows += `
          <tr>
            <td>${index + 1}</td>
            <td>${disease.name}</td>
            <td>${disease.description ?? ''}</td>
            <td>${disease.thematic_area ?? ''}</td>
            <td class="text-center">
              <button class="btn btn-sm btn-outline-info edit" data-id="${disease.id}">Edit</button>
              <button class="btn btn-sm btn-outline-danger delete" data-id="${disease.id}">Delete</button>
            </td>
          </tr>
        `;
      });
      $('#diseases-table tbody').html(rows);

      table = $('#diseases-table').DataTable({
        pageLength: 10,
        lengthChange: true,
        searching: true,
        ordering: true,
        autoWidth: false
      });
    });
  }

  $('#create-new').on('click', function () {
    $('#form-disease')[0].reset();
    $('#id').val('');
  });

  $('#form-disease').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      url: '<?= base_url('lists/save') ?>',
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function () {
        $('#diseaseModal').modal('hide');
        notifyUser('Disease saved successfully!');
        loadDiseases();
      },
      error: function () {
        notifyUser('Error saving disease.', 'error');
      }
    });
  });

  $(document).on('click', '.edit', function () {
    const id = $(this).data('id');
    $.getJSON('<?= base_url('lists/get/') ?>' + id, function (d) {
      $('#id').val(d.id);
      $('#name').val(d.name);
      $('#description').val(d.description);
      $('#thematic_area_id').val(d.thematic_area_id);
      $('#diseaseModal').modal('show');
    });
  });

  $(document).on('click', '.delete', function () {
    const id = $(this).data('id');
    if (confirm('Are you sure you want to delete this disease?')) {
      $.get('<?= base_url('lists/delete/') ?>' + id, function () {
        notifyUser('Disease deleted.', 'warn');
        loadDiseases();
      });
    }
  });

  // Initial Load
  loadThematicAreas();
  loadDiseases();
});

</script>