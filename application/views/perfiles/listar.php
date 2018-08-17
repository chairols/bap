<div class="col-xs-12">
    <div class="card">
        <div class="header">
            <strong><?= $title ?></strong>
        </div>
        <div class="body">
            <div class="row clearfix">
                <div class="col-sm-12">
                    <form method="GET" class="input-group">
                        <input class="form-control" name="perfil" placeholder="Buscar ..." type="text">
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
                                <th>Perfil</th>
                                <th>Acción</th>
                            </tr>
                            <?php foreach ($perfiles as $perfil) { ?>
                                <tr>
                                    <td><?= $perfil['perfil'] ?></td>
                                    <td>
                                        <a href="/perfiles/modificar/<?= $perfil['idperfil'] ?>/" data-pacement="top" data-toggle="tooltip" data-original-title="Modificar" class="tooltips">
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
