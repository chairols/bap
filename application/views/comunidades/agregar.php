<div class="col-xs-12">
    <div class="card">
        <div class="header">
            <strong><?=$title?></strong>
        </div>
        <div class="body">
            <div class="row clearfix">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-xs-3">Código</label>
                        <input class="form-control" maxlength="6" type="text" value="<?=$random?>" id="codigo" disabled="">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Nombre</label>
                        <input class="form-control" maxlength="100" type="text" id="nombre" placeholder="Nombre" autofocus="">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Dirección</label>
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