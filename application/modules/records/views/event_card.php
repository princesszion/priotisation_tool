<?php if (!empty($outbreak_events)): ?>
  <!-- Outbreak Events Cards -->
  <div class="row" id="outbreak-events">
    <?php foreach ($outbreak_events as $event): ?>
      <div class="col-lg-6 col-md-6 mb-4">
        <div class="card shadow-sm">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">
              <i class="fas fa-exclamation-triangle text-warning"></i>
              <?= htmlspecialchars($event->outbreak_name) ?>
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">
              <i class="far fa-calendar-alt"></i>
              <?= date('F j, Y', strtotime($event->start_date)) ?>
            </h6>
            <p class="card-text mb-2">
              <i class="fas fa-map-marker-alt text-danger"></i>
              <?= htmlspecialchars($event->affected_regions) ?>
            </p>
            <p class="card-text mb-3">
              <i class="fas fa-clock text-success"></i>
              Status: <?= htmlspecialchars($event->status) ?>
            </p>
            <p class="card-text mb-3">
              <i class="fas fa-user text-success"></i>
              Contact Person: <?= htmlspecialchars($event->coordinator_name) ?>
            </p>

            <a href="<?= site_url('records/dashboard/' . $event->id) ?>" class="btn btn-outline-success btn-sm mt-auto">
              <i class="fas fa-info-circle"></i> View Dashboard
            </a>
            <p class="card-text mb-3 justify-content-center">
              <i class="fas fa-th text-info"></i>
              Description: <?php echo htmlspecialchars_decode($event->description); ?>

            </p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <div class="col-12">
    <p class="text-center">No results found.</p>
  </div>
<?php endif; ?>