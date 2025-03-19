<?php
$params = ['prev' => 'Prevention', 'detect' => 'Detection', 'morbid' => 'Morbidity', 'case' => 'Case Management', 'mort' => 'Mortality'];

foreach ($diseases as $disease): ?>
    <tr>
        <td><?= $disease['name'] ?></td>

        <?php foreach ($params as $key => $label): ?>
            <td>
                <select class="form-control param-select" data-disease="<?= $disease['id'] ?>" data-param="<?= $key ?>">
                    <option value="">Select</option>
                    <?php foreach ($parameters as $param):
                        if (stripos($param['header'], $key) !== FALSE): ?>
                            <option value="<?= $param['beta'] ?>"><?= $param['creteria'] ?></option>
                        <?php endif;
                    endforeach; ?>
                </select>
            </td>
        <?php endforeach; ?>
    </tr>
<?php endforeach; ?>