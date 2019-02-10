<div class="col-xs-12">
    <div class="card">
        <div class="header">
            <strong><?= $title ?></strong>
        </div>
        <div class="body">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <p><b>País</b></p>
                    <input class="form-control" maxlength="100" type="text" id="pais" autofocus="">
                </div>
            </div>
            <div class="row clearfix m-t-15">
                <div class="col-lg-12">
                    <button type="button" id="agregar" class="btn btn-primary btn-round waves-effect">Agregar</button>
                    <button type="button" id="loading" class="btn btn-primary btn-sm btn-round waves-effect" style="display: none;">
                        <i class="material-icons zmdi-hc-spin">refresh</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>