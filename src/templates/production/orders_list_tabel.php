<div>
    <table>
        <thead>
        <tr>
            <th>Дата создания</th>
            <th>Контрагент</th>
            <th>Счет бонсенс</th>
            <th>Менеджер</th>
            <th>Дизайнер</th>
            <th>Приоритет</th>
            <th>Дата создания проекта</th>
            <th>Дедлайн проекта</th>
            <th>Стадия проекта</th>
            <?php foreach ($data['PROG_DATA']['DEPARTMENTS_LIST'] as $departmentValKey => $departmentVal): ?>
                <th><?= $departmentVal . " " . 'дедлайн'; ?></th>
                <th><?= $departmentVal . " " . 'стадия'; ?></th>
                <?php foreach ($data['PROG_DATA']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
                    <th><?= $departmentVal . " " . $statusVal['name']; ?></th>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['orders'] as $order): ?>
            <tr>
                <td><?= $order['create_datetime']; ?></td>
                <td><?= $order['client_name']; ?></td>
                <td><?= $order['order_name_out']; ?></td>
                <td><?= $order['uc_last_name'] . " " . $order['uc_first_name']; ?></td>
                <td><?= $order['ud_last_name'] . " " . $order['ud_first_name']; ?></td>
                <td><?= $data['PROG_DATA']['PRIORITY_ORDERS'][$order['order_priority']]['name'] ?? '???'; ?></td>
                <td><?= $order['create_datetime']; ?></td>
                <td><?= $order['general_deadline']; ?></td>
                <?php if ($order['general_status'] !== false): ?>
                    <td><?= $data['PROG_DATA']['STATUS_LIST_PRODUCTION'][$order['general_status']]['name'] ?? '???'; ?></td>
                <?php else: ?>
                    <td>-</td>
                <?php endif; ?>
                <?php foreach ($data['PROG_DATA']['DEPARTMENTS_LIST'] as $departmentValKey => $departmentVal): ?>
                    <td><?= $order[$departmentValKey . '_deadline_date']; ?></td>
                    <td><?= $data['PROG_DATA']['STATUS_LIST_PRODUCTION'][$order[$departmentValKey . '_current_status']]['name'] ?? '-'; ?></td>
                    <?php foreach ($data['PROG_DATA']['STATUS_LIST_PRODUCTION'] as $statusKey => $statusVal): ?>
                        <td><?= $order[$departmentValKey . '_datetime_status_' . $statusKey]; ?></td>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>