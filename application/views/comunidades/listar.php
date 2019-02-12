<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><?= $title ?></h2>
                </div>            
                <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                    <ul class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                        <li class="breadcrumb-item">UI Elements</li>
                        <li class="breadcrumb-item active">Treeview</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clealfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <form method="GET" class="input-group">
                                    <input class="form-control" name="comunidad" placeholder="Buscar ..." type="text" value="<?= $this->input->get('comunidad') ?>">
                                    <span class="input-group-addon">
                                        <i class="zmdi zmdi-search"></i>
                                    </span>
                                </form>
                            </div>
                        </div>
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
                                            <th>País</th>
                                            <th>Acción</th>
                                        </tr>
                                        <?php foreach ($comunidades as $comunidad) { ?>
                                            <tr>
                                                <td><?= $comunidad['comunidad'] ?></td>
                                                <td><?= $comunidad['codigo'] ?></td>
                                                <td><?= $comunidad['pais']['pais'] ?></td>
                                                <td>
                                                    <a href="/comunidades/modificar/<?= $comunidad['idcomunidad'] ?>/" data-pacement="top" data-toggle="tooltip" data-original-title="Modificar" class="tooltips">
                                                        <button class="btn btn-info btn-sm">
                                                            <i class="fa fa-edit"></i>
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
        </div>
    </div>
</div>
