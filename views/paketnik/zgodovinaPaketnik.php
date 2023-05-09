<p>ZGODOVINA PAKETNIKA</p>
<div>
    <table class="table">
        <thead>
        <tr>
            <th>ID uporabnika</th>
            <th>Ime uporabnika</th>
            <th>Datum in čas</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $log): ?>
            <tr>
                <td><?php echo $log['userid']; ?></td>
                <td><?php echo $log['ime']; ?></td>
                <td><?php echo $log['datetime']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
