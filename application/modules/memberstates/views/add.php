
        <div class="card shadow-sm">
            <div class="card-header text-black">
                <h5 class="mb-0">Add New Outbreak</h5>
            </div>
            <div class="card-body" style="background: #f8f9fa;">
                <form id="addOutbreakForm">
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="affectedRegions">Affected Regions</label>
                                <input type="text" class="form-control" id="affectedRegions" name="affected_regions">
                            </div>
                            <div class="form-group">
                                <label for="coordinatorName">Coordinator Name</label>
                                <input type="text" class="form-control" id="coordinatorName" name="coordinator_name">
                            </div>
                            <div class="form-group">
                                <label for="contactEmail">Contact Email</label>
                                <input type="email" class="form-control" id="contactEmail" name="contact_email">
                            </div>
                            <div class="form-group">
                                <label for="contactPhone">Contact Phone</label>
                                <input type="text" class="form-control" id="contactPhone" name="contact_phone">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Outbreak</button>
                </form>
            </div>
        </div>
 