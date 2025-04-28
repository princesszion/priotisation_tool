<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: center;
        }
        thead {
            background-color: #f8f9fa;
            font-weight: bold;
        }
    </style>

    <div class="card shadow-sm">
        <div class="card-headertext-white text-center mt-2">
            <h4>Parameters</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Parameters</th>
                            <?php foreach ($pivot_data['headers'] as $header): ?>
                                <th class="text-center"><?= $header ?></th>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th class="text-center">Levels of Criteria</th>
                            <?php foreach ($pivot_data['headers'] as $header): ?>
                                <th class="text-center"><?= isset($pivot_data['levels'][$header]) ? $pivot_data['levels'][$header] : '-' ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">Beta</td>
                            <?php foreach ($pivot_data['headers'] as $header): ?>
                                <td><?= isset($pivot_data['pivot']['beta'][$header]) ? $pivot_data['pivot']['beta'][$header] : '-' ?></td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
