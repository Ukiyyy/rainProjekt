<p>SPREMENI IME</p>
<div>
    <form action="?controller=paketnik&action=spremeni" method="POST">
        <div class="form-group">
            <label for="username">ID paketnika:</label>
            <input type="text" class="form-control" name="paketnikId" placeholder="paketnikov id" />
            <input type="text" class="form-control" name="novoIme" placeholder="novo ime" />
            <input class="btn btn-primary" type="submit" name="spremeniIme" value="Spremeni"/>
        </div>
    </form>
</div>