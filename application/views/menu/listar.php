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
                                <th>Ícono</th>
                                <th>Título</th>
                                <th>Link</th>
                                <th>Visible</th>
                                <th>Padre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menues as $m) { ?>
                                <tr>
                                    <td><strong><i class="<?= $m['icono'] ?>"></i></strong></td>
                                    <td><?= $m['titulo'] ?></td>
                                    <td><?= $m['href'] ?></td>
                                    <td>
                                        <?php if ($m['visible'] == 1) { ?>
                                            <span class="badge bg-green">SI</span>
                                        <?php } else { ?>
                                            <span class="badge bg-red">NO</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($m['padre'] != null) { ?>
                                            <span class="badge bg-green"><?= $m['padre']['titulo'] ?></span>
                                        <?php } else { ?>
                                            <span class="badge bg-red">No tiene</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="/menu/modificar/<?= $m['idmenu'] ?>/" data-pacement="top" data-toggle="tooltip" data-original-title="Modificar" class="tooltips">
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

