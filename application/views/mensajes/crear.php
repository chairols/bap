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
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Para">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Asunto">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="CC">
                            </div>
                        </form>
                        <hr>
                        <div class="summernote">
                            Hello there,
                            <br/>
                            <p>The toolbar can be customized and it also supports various callbacks such as <code>oninit</code>, <code>onfocus</code>, <code>onpaste</code> and many more.</p>
                            <p>Please try <b>paste some texts</b> here</p>
                        </div>
                        <div class="m-t-30">
                            <button type="button" class="btn btn-success">Send Message</button>
                            <button type="button" class="btn btn-secondary">Draft</button>
                            <a href="app-inbox.html" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
