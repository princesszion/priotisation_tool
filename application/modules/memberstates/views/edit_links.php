

<div class="card shadow-sm">
            <div class="card-header text-black">
                <h5 class="mb-0">Manage Outbreak Menu Links</h5>
            </div>
            <div class="card-body" style="background: #f8f9fa;">
        <!-- Outbreak Selection -->
        <div class="form-group">
            <label for="outbreakSelect">Copy Menu to: (Select Outbreak)</label>
            <select class="form-control" id="outbreakSelect" name="outbreak_id">
                <option value="" disabled selected>Select an outbreak</option>
                <?php foreach ($outbreaks as $outbreak): ?>
                    <option value="<?= $outbreak->id; ?>">
                        <?= $outbreak->outbreak_name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Table to edit menu items -->
        <form id="editMenuLinksForm">
            <table class="table table-bordered" id="menuItemsTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Tab</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Menu items will be dynamically populated here -->
                </tbody>
            </table>
            <button type="button" class="btn btn-secondary mb-3" id="addRow">Add Menu Item</button>
            <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
        </form>

        <!-- Copy menu items from another outbreak -->
        <div class="mt-5">
            <h3>Copy Menu from (Select Outbreak)</h3>
            <div class="form-group">
                <label for="copyOutbreakSelect">Select Outbreak to Copy From</label>
                <select class="form-control" id="copyOutbreakSelect" name="copy_outbreak_id">
                    <option value="" disabled selected>Select an outbreak</option>
                    <?php foreach ($outbreaks as $outbreak): ?>
                        <option value="<?= $outbreak->id; ?>">
                            <?= $outbreak->outbreak_name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="button" class="btn btn-info" id="copyMenuItems">Copy Menu Items</button>
        </div>
    </div>
 </div>
