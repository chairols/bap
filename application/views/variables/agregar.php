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
                        <div class="row clealfix">
                            <div class="col-lg-12">
                                <p><b>Key</b></p>
                                <input class="form-control" maxlength="255" type="text" id="key" placeholder="key" autofocus="">
                            </div>
                        </div>
                        <div class="row clearfix m-t-15">
                            <div class="col-lg-12">
                                <p><b>Valor</b></p>
                                <input class="form-control" maxlength="255" type="text" id="valor" placeholder="Valor">
                            </div>
                        </div>
                        <div class="row clearfix m-t-20">
                            <div class="col-lg-12">
                                <p><b>Comentarios</b></p>
                                <textarea class="form-control" id="comentarios"></textarea>
                            </div>
                        </div>
                        <div class="row clearfix m-t-20">
                            <div class="col-lg-12">
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

