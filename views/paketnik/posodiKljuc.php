<p>POSODI KLJUČ</p>
<div>
    <form action="?controller=paketnik&action=posodi" method="POST">
        <div class="form-group">
            <label for="username">Username uporabnika, kateremu želite posoditi ključ:</label>
            <input type="text" class="form-control" name="uporabnikId" placeholder="uporabnik id" />
            <br>
            <label for="newname">Ime paketnika, ki ga želite posoditi:</label>
            <input type="text" class="form-control" name="paketnikId" placeholder="id paketnika" />
            <br>
            <input class="btn btn-primary" type="submit" name="Dodaj" value="Posodi"/>
        </div>
    </form>
</div>