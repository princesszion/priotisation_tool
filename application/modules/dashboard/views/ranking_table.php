<?php
$params = ['prev' => 'Prevention', 'detect' => 'Detection', 'morbid' => 'Morbidity', 'case' => 'Case Management', 'mort' => 'Mortality'];

foreach ($diseases as $disease): 
    $is_finalized = isset($existing_data[$disease['id']]['draft_status']) && $existing_data[$disease['id']]['draft_status'] == 0;
?>
    <tr>
        <td><?= $disease['name'] ?></td>

        <?php foreach ($params as $key => $label): ?>
            <td>
                <select class="form-control param-select"
                        data-disease="<?= $disease['id'] ?>"
                        data-param="<?= $key ?>"
                        required
                        <?= $is_finalized ? 'disabled' : '' ?>>
                    <option value="">Select</option>
                    <?php foreach ($parameters as $param):
                        if ($param['category'] === $key):
                            $selected = "";
                            if (isset($existing_data[$disease['id']][$key]) && $existing_data[$disease['id']][$key] == $param['beta']) {
                                $selected = "selected";
                            }
                    ?>
                        <option value="<?= $param['beta'] ?>" <?= $selected ?>>
                            <?= $param['creteria'] ?>
                        </option>
                    <?php
                        endif;
                    endforeach; ?>
                </select>
            </td>
        <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
