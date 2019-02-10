<div class="col-xs-12">
    <div class="card">
        <div class="header">
            <strong><?=$title?></strong>
        </div>
        <div class="body">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <p><b>Código</b></p>
                    <input class="form-control" maxlength="6" type="text" value="<?=$random?>" id="codigo" disabled="">
                </div>
            </div>
            <div class="row clearfix m-t-15">
                <div class="col-lg-12">
                    <p><b>Comunidad</b></p>
                    <input class="form-control" maxlength="100" type="text" id="comunidad" placeholder="Nombre" autofocus="">
                </div>
            </div>
            <div class="row clearfix m-t-15">
                <div class="col-lg-12">
                    <p><b>País</b></p>
                    <select class="form-control show-tick" id="pais" data-live-search="true">
                        <?php foreach($paises as $pais) { ?>
                            <option value="<?=$pais['idpais']?>"><?=$pais['pais']?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row clearfix m-t-15">
                <div class="col-sm-12">
                    <div class="form-group">
                        <p><b>Dirección</b></p>
                        <input class="form-control" maxlength="100" type="text" id="direccion" placeholder="Dirección">
                    </div>
                    <div class="form-group">
                        <button type="button" id="agregar" class="btn bg-green btn-round waves-effect m-t-20">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>