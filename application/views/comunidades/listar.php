<div class="col-xs-12">
    <div class="card">
        <div class="header">
            <strong><?= $title ?></strong>
        </div>
        <div class="body">
            <div class="row clearfix">
                <div class="col-sm-12">
                    <form method="GET" class="input-group">
                        <input class="form-control" name="comunidad" placeholder="Buscar ..." type="text" value="<?=$this->input->get('comunidad')?>">
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
                                <th>Comunidad</th>
                                <th>Código</th>
                                <th>Acción</th>
                            </tr>
                            <?php foreach ($comunidades as $comunidad) { ?>
                                <tr>
                                    <td><?= $comunidad['comunidad'] ?></td>
                                    <td><?= $comunidad['codigo']?></td>
                                    <td>
                                        <a href="/comunidades/modificar/<?= $comunidad['idcomunidad'] ?>/" data-pacement="top" data-toggle="tooltip" data-original-title="Modificar" class="tooltips">
                                            <button class="btn btn-info btn-sm">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </thead>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>