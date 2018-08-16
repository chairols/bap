<div class="col-xs-12">
    <div class="card">
        <div class="header">
            <strong><?= $title ?></strong>
        </div>
        <div class="body">
            <div class="row clearfix">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-xs-3">Ícono</label>
                        <input class="form-control" maxlength="50" type="text" id="icono" placeholder="home" autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Título</label>
                        <input class="form-control" maxlength="50" type="text" id="titulo" placeholder="Agregar Menú">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Menú</label>
                        <input class="form-control" maxlength="50" type="text" id="menu" placeholder="Menúes-Nuevo Menú">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Link</label>
                        <input class="form-control" maxlength="50" type="text" id="href" placeholder="/controlador/metodo/">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Orden</label>
                        <input class="form-control" maxlength="11" type="number" id="orden" placeholder="5">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Padre</label>
                        <select class="form-control show-tick" id="padre">
                            <option value="0" selected>--- No tiene ---</option>
                            <?php foreach ($padres as $padre) { ?>
                                <option value="<?= $padre['idmenu'] ?>"><?= $padre['titulo'] ?></option>
                                <?php foreach ($padre['hijos'] as $hijo) { ?>
                                    <option value="<?= $hijo['idmenu'] ?>">↳ <?= $padre['titulo'] ?> → <?= $hijo['titulo'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <input id="visible" type="checkbox">
                            <label for="visible">Visible</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" id="agregar" class="btn bg-green btn-round waves-effect m-t-20">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>