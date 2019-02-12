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
                                <p><b>Ícono</b></p>
                                <input class="form-control" maxlength="50" type="text" id="icono" placeholder="home" autofocus>
                            </div>
                        </div>
                        <div class="row clearfix m-t-15">
                            <div class="col-lg-12">
                                <p><b>Título</b></p>
                                <input class="form-control" maxlength="50" type="text" id="titulo" placeholder="Agregar Título">
                            </div>
                        </div>
                        <div class="row clearfix m-t-15">
                            <div class="col-lg-12">
                                <p><b>Menú</b></p>
                                <input class="form-control" maxlength="50" type="text" id="menu" placeholder="Menúes-Nuevo Menú">
                            </div>
                        </div>
                        <div class="row clearfix m-t-15">
                            <div class="col-lg-12">
                                <p><b>Link</b></p>
                                <input class="form-control" maxlength="50" type="text" id="href" placeholder="/controlador/metodo/">
                            </div>
                        </div>
                        <div class="row clearfix m-t-15">
                            <div class="col-lg-12">
                                <p><b>Orden</b></p>
                                <input class="form-control" maxlength="11" type="number" id="orden" placeholder="5">
                            </div>
                        </div>
                        <div class="row clearfix m-t-15">
                            <div class="col-lg-12">
                                <p><b>Padre</b></p>
                                <select class="form-control" id="padre" data-live-search="true">
                                    <option value="0" selected>--- No tiene ---</option>
                                    <?php foreach ($padres as $padre) { ?>
                                        <option value="<?= $padre['idmenu'] ?>"><?= $padre['titulo'] ?></option>
                                        <?php foreach ($padre['hijos'] as $hijo) { ?>
                                            <option value="<?= $hijo['idmenu'] ?>">↳ <?= $padre['titulo'] ?> → <?= $hijo['titulo'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row clearfix m-t-25">
                            <div class="col-lg-12">
                                <label class="fancy-checkbox">
                                    <input type="checkbox" id="visible">
                                    <span><b>Visible</b></span>
                                </label>
                            </div>
                        </div>
                        <div class="row clearfix m-t-15">
                            <div class="col-lg-12">
                                
                                <div class="form-group">
                                    <button type="button" id="agregar" class="btn btn-primary">Agregar</button>
                                    <button type="button" id="loading" class="btn btn-primary" style="display: none;">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



