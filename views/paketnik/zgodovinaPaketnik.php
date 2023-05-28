<p>ZGODOVINA PAKETNIKA</p>
<div>
    <table class="table">
        <thead>
        <tr>
            <th>ID uporabnika</th>
            <th>Datum</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $log): ?>
            <tr>
                <td><?php echo $log['userid']; ?></td>
                <td><?php echo $log['date']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
