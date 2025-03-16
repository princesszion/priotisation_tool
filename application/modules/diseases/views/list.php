
<div class="card shadow-sm">
            <div class="card-header text-black">
                <h5 class="mb-0">Manage Outbreaks</h5>
            </div>
            <div class="card-body" style="background: #f8f9fa;">
	<table class="table table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>ID</th>

				<th>Outbreak Name</th>
				<th>Type</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Severity</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($outbreaks as $outbreak): ?>
				<tr id="outbreak-<?= $outbreak->id; ?>">
					<td><?= $outbreak->id; ?></td>
					<td><?= $outbreak->outbreak_name; ?></td>
					<td><?= $outbreak->outbreak_type; ?></td>
					<td><?= $outbreak->start_date; ?></td>
					<td><?= $outbreak->end_date ?? 'Ongoing'; ?></td>
					<td><?= ucfirst($outbreak->severity_level); ?></td>
					<td class="status"><?= ucfirst($outbreak->status); ?></td>
					<td>
						<button class="btn btn-primary btn-sm edit-btn" data-id="<?= $outbreak->id; ?>">Edit</button>
						<button class="btn btn-warning btn-sm deactivate-btn"
							data-id="<?= $outbreak->id; ?>">Deactivate</button>
						<button class="btn btn-danger btn-sm delete-btn" data-id="<?= $outbreak->id; ?>">Delete</button>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>

	</table>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="updateForm">
				<div class="modal-header">
					<h5 class="modal-title" id="updateModalLabel">Update Outbreak</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="outbreakId" name="id">
					<div class="form-group">
						<label for="outbreakName">Outbreak Name</label>
						<input type="text" class="form-control" id="outbreakName" name="outbreak_name" required>
					</div>
					<div class="form-group">
						<label for="outbreakType">Outbreak Type</label>
						<input type="text" class="form-control" id="outbreakType" name="outbreak_type">
					</div>
					<div class="form-group">
						<label for="startDate">Start Date</label>
						<input type="date" class="form-control" id="startDate" name="start_date" required>
					</div>
					<div class="form-group">
						<label for="endDate">End Date</label>
						<input type="date" class="form-control" id="endDate" name="end_date">
					</div>
					<div class="form-group">
						<label for="severityLevel">Severity Level</label>
						<select class="form-control" id="severityLevel" name="severity_level" required>
							<option value="low">Low</option>
							<option value="moderate">Moderate</option>
							<option value="high">High</option>
							<option value="critical">Critical</option>
						</select>
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						<select class="form-control" id="status" name="status" required>
							<option value="active">Active</option>
							<option value="inactive">Inactive</option>
							<option value="contained">Contained</option>
							<option value="resolved">Resolved</option>
							<option value="monitored">Monitored</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save Changes</button>
				</div>
			</form>
		</div>
	</div>
	</div>
	</div>
