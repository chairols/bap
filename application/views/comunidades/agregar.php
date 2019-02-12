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
                                <p><b>Código</b></p>
                                <input class="form-control" maxlength="6" type="text" value="<?= $random ?>" id="codigo" disabled="">
                            </div>
                        </div>
                        <div class="row clearfix m-t-15">
                            <div class="col-lg-12">
                                <p><b>Comunidad</b></p>
                                <input class="form-control" maxlength="100" type="text" id="comunidad" placeholder="Nombre" autofocus="">
                            </div>
                        </div>
                        <div class="row clearfix m-t-15">
                            <div class="col-lg-12">
                                <p><b>País</b></p>
                                <select class="form-control show-tick ms select2" id="pais" data-live-search="true">
                                    <?php foreach ($paises as $pais) { ?>
                                        <option value="<?= $pais['idpais'] ?>"><?= $pais['pais'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row clearfix m-t-20">
                            <div class="col-lg-12">
                                <p><b>Dirección</b></p>
                                <input class="form-control" maxlength="100" type="text" id="direccion" placeholder="Dirección">
                            </div>
                        </div>
                        <div class="row clearfix m-t-20">
                            <div class="col-lg-12">
                                <button type="button" id="agregar" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

