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
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <form method="GET" class="input-group" action="/menu/listar/">
                                    <input class="form-control" name="titulo" placeholder="Buscar ..." type="text" value="<?=$this->input->get('titulo')?>" autofocus="">
                                    <span class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </form>
                            </div>
                        </div>
                        <div class="row clearfix m-t-20">
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
                                                        <span class="badge badge-success">SI</span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger">NO</span>
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
                            <div class="col-lg-12 m-t-20">
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

