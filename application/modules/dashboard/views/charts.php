<div class="container-fluid">
    <div class="row no-gutters">
    <div class="col-md-3 p-2">
  <div class="card">
    <div class="card-body">
      <div id="disease-probability-gauge" style="height: 270px;"></div>

      <!-- Legend / Key -->
      <div class="mt-3 text-center">
        <strong>Probability Key:</strong>
        <div class="d-flex justify-content-around align-items-center mt-2">
          <span style="color: #007749;">&#9632; Low (≤ 69%)</span>
          <span style="color: #FCD116;">&#9632; Medium (70% - 86%)</span>
          <span style="color: #CE1126;">&#9632; High (≥ 87%)</span>
        </div>
      </div>

      <!-- Disease Selector -->
      <select id="disease_selector" class="form-control select2 mt-3">
        <option value="">Select Condition for Probability</option>
        <?php foreach ($diseases as $disease): ?>
          <option value="<?= $disease['id'] ?>"><?= $disease['name'] ?></option>
        <?php endforeach; ?>
      </select>
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