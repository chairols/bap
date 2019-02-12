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
                            <div class="col-lg-12">
                                <form method="GET" class="input-group">
                                    <input class="form-control" name="pais" placeholder="Buscar ..." type="text" value="<?= $this->input->get('pais') ?>" autofocus="">
                                    <span class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </form>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <ul class="pagination pagination-primary">
                                    <?= $links ?>
                                </ul>
                            </div>
                            <div class="col-lg-12 table-responsive">
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
                                                <td><strong><?= $pais['idpais'] ?></strong></td>
                                                <td><strong><?= $pais['pais'] ?></strong></td>
                                                <td>
                                                    <?php if ($pais['estado'] == 'A') { ?>
                                                        <span class="badge badge-success">ACTIVO</span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger">INACTIVO</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="#" data-pacement="top" data-toggle="tooltip" data-original-title="Modificar" class="tooltips">
                                                        <button class="btn btn-info btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12">
                                <strong>Total <?= $total_rows ?> registros.</strong>
                            </div>
                            <div class="col-lg-12">
                                <ul class="pagination pagination-primary">
                                    <?= $links ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
