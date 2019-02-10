<div class="col-xs-12">
    <div class="card">
        <div class="header">
            <strong><?= $title ?></strong>
        </div>
        <div class="body">
            <div class="row clearfix">
                <div class="col-sm-12">
                    <form method="GET" class="input-group">
                        <input class="form-control" name="titulo" placeholder="Buscar ..." type="text">
                        <span class="input-group-addon">
                            <i class="zmdi zmdi-search"></i>
                        </span>
                    </form>
                </div>
            </div>
            <br>
            <div class="row clearfix">
                <div class="col-sm-12">
                    <ul class="pagination pagination-primary">
                        <?= $links ?>
                    </ul>
                </div>
                <div class="col-sm-12 table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>ID #</th>
                                <th>Pais</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($paises as $pais) { ?>
                                <tr>
                                    <td><strong><?=$pais['idpais']?></strong></td>
                                    <td><strong><?=$pais['pais']?></strong></td>
                                    <td>
                                        <?php if ($pais['estado'] == 'A') { ?>
                                            <span class="badge bg-green">ACTIVO</span>
                                        <?php } else { ?>
                                            <span class="badge bg-red">INACTIVO</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="#" data-pacement="top" data-toggle="tooltip" data-original-title="Modificar" class="tooltips">
                                            <button class="btn btn-info btn-sm">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12">
                    <strong>Total <?= $total_rows ?> registros.</strong>
                </div>
                <div class="col-sm-12">
                    <ul class="pagination pagination-primary">
                        <?= $links ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

