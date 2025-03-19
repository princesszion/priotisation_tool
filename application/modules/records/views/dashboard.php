<style>
    table {
        width: 100%;
    }
    th, td {
        text-align: center;
        vertical-align: middle !important;
        padding: 2px !important;
        font-size: 12px;
    }
    .thead-dark th {
        background-color: #152238;
        color: white;
    }
    tbody tr:nth-child(odd) {
        background-color: #f2f8ff;
    }
    select.form-control {
        padding: 1px 3px;
        height: auto;
        font-size: 11px;
    }
    .form-control {
        height: auto;
        padding: 1px 3px;
        font-size: 11px;
    }
</style>

<div class="container-fluid">
    <h5 class="mb-3">Disease Ranking Priotisation Form (Annual)</h5>

    <!-- Filters -->
    <div class="row mb-2">
        <div class="col-md-2">
            <label>Year</label>
            <select class="form-control" id="period">
                <?php for ($year = date('Y'); $year >= date('Y') - 10; $year--): ?>
                    <option><?= $year ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label>Country</label>
            <select id="member_state" class="form-control">
                <?php foreach ($countries as $country): ?>
                    <option value="<?= $country['id'] ?>"><?= $country['member_state'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label>Thematic Area</label>
            <select id="thematic_area" class="form-control">
                <option value="">All Thematic Areas</option>
                <?php foreach ($thematic_areas as $area): ?>
                    <option value="<?= $area['id'] ?>"><?= $area['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Table -->
    <table class="table table-bordered table-sm table-striped">
        <thead class="thead-dark">
            <tr>
                <th style="width:10%; float:left;">Health Condition</th>
                <th>Prevention</th>
                <th>Detection</th>
                <th>Morbidity</th>
                <th>Case Management</th>
                <th>Mortality</th>
            </tr>
        </thead>
        <tbody id="ranking-body">
            <!-- Dynamic content loaded here -->
        </tbody>
    </table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
<script>
function loadRankingForm() {
    let country_id = $('#member_state').val();
    let period = $('#period').val();
    let thematic_area_id = $('#thematic_area').val();

    $.post('<?= base_url() ?>records/load_ranking_form', {
        member_state_id: country_id,
        period: period,
        thematic_area_id: thematic_area_id
    }, function(html) {
        $('#ranking-body').html(html); // Update the table content
    });
}

$(document).ready(function() {
    // Initial load of the form
    loadRankingForm();

    // Reload the form when any filter changes
    $('#member_state, #period, #thematic_area').change(loadRankingForm);

    // Handle changes to parameter selects
    $(document).on('change', '.param-select', function() {
        let data = {
            member_state_id: $('#member_state').val(),
            period: $('#period').val(),
            thematic_area_id: $('#thematic_area').val(),
            disease_id: $(this).data('disease'),
            param: $(this).data('param'),
            creteria: $(this).val()
        };

        $.post('<?= base_url() ?>records/save_ranking_data', data, function(response) {
            $.notify("Data successfully saved!", { position: "top right", className: "success" });
        }).fail(function() {
            $.notify("Error saving data!", { position: "top right", className: "error" });
        });
    });
});
</script>