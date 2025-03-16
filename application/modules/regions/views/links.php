
<div class="card shadow-sm">
            <div class="card-header text-black">
                <h5 class="mb-0">Assign Menu Links to an Outbreak</h5>
            </div>
            <div class="card-body" style="background: #f8f9fa;">
        <div class="form-group">
            <label for="outbreakSelect">Select Outbreak</label>
            <select class="form-control" id="outbreakSelect" name="outbreak_id" required>
                <option value="" disabled selected>Select an outbreak</option>
                <!-- Example options, dynamically populate this using PHP -->
                <?php foreach ($outbreaks as $outbreak): ?>
                    <option value="<?= $outbreak->id; ?>" data-start-date="<?= $outbreak->start_date; ?>"
                        data-end-date="<?= $outbreak->end_date; ?>">
                        <?= $outbreak->outbreak_name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Start Date: <span id="startDate"></span></label>
        </div>
        <div class="form-group">
            <label>End Date: <span id="endDate"></span></label>
        </div>

        <form id="assignMenuLinksForm">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Menu Name</th>
                        <th>Tab</th>
                        <th>Dashboard URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="menuItemsTable">
                    <!-- Initial row for menu items -->
                    <tr>
                        <td><input type="text" class="form-control" name="menu[0][name]" required></td>
                        <td><input type="text" class="form-control" name="menu[0][tab]" required></td>
                        <td><input type="text" class="form-control" name="menu[0][url]" required></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-secondary mb-3" id="addRow">Add Menu Item</button>
            <button type="submit" class="btn btn-primary mb-3">Save Menu Links</button>
        </form>
    </div>
    </div>
