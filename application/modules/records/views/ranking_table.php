<?php
$params = [
  'prev' => 'Prevention',
  'detect' => 'Detection',
  'morbid' => 'Morbidity',
  'case' => 'Case Management',
  'mort' => 'Mortality'
];

if (empty($diseases)) {
    echo '
    <tr class="table-placeholder">
        <td colspan="6" class="text-center text-muted" style="height:150px;">
            No ranking data available for the selected country.
        </td>
    </tr>';
    return;
}

foreach ($diseases as $disease):
    $disease_id = $disease['id'];
    $is_finalized = isset($existing_data[$disease_id]['draft_status']) && $existing_data[$disease_id]['draft_status'] == 0;
?>
    <tr>
        <td><?= htmlspecialchars($disease['name']) ?></td>
        <?php foreach ($params as $key => $label): ?>
            <td>
                <select class="form-control param-select"
                        data-disease="<?= $disease_id ?>"
                        data-param="<?= $key ?>"
                        <?= $is_finalized ? 'disabled' : '' ?>>
                    <option value="">Select</option>
                    <?php foreach ($parameters as $param): ?>
                        <?php if ($param['category'] === $key): ?>
                            <option value="<?= $param['beta'] ?>"
                                <?= (isset($existing_data[$disease_id][$key]) && $existing_data[$disease_id][$key] == $param['beta']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($param['creteria']) ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </td>
        <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
