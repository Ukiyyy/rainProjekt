<p>ZGODOVINA PAKETNIKA</p>
<div>
    <table class="table">
        <thead>
        <tr>
            <th>Uporabnik</th>
            <th>Ime Paketnika</th>
            <th>Datum</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $log): ?>
            <tr>
                <td><?php echo $log['username']; ?></td>
                <td><?php echo $log['name']; ?></td>
                <td><?php echo $log['date']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
