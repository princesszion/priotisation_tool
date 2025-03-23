<div class="container-fluid">
    <div class="row no-gutters">
    <div class="col-md-3 p-2">
        <div class="card">
            <div class="card-header">
            <select id="disease_selector" class="form-control select2">
                <option value="">Select Disease or Condition</option>
                <?php foreach ($diseases as $disease): ?>
                <option value="<?= $disease['id'] ?>"><?= $disease['name'] ?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <div class="card-body">
            <div id="disease-probability-gauge" style="height: 400px;"></div>
            </div>
        </div>
        </div>
      <!-- Chart 1 -->
      <div class="col-md-3 p-2">
        <div class="card">
          <div class="card-body">
            <div id="priority-disease-chart" style="height: 400px;"></div>
          </div>
        </div>
      </div>

      <!-- Chart 2 -->
      <div class="col-md-3 p-2">
        <div class="card">
         
          <div class="card-body">
          <div id="priority-probability-chart" style="height: 400px; width: 100%;"></div>

          </div>
        </div>
      </div>

      <!-- Chart 3 -->
      <div class="col-md-3 p-2">
        <div class="card">
          <div class="card-body">
            <div id="continental-disease-chart" style="height: 400px;"></div>
          </div>
        </div>
      </div>

    </div>
  </div>