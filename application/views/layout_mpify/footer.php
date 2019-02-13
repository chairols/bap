<!-- Javascript -->
<script src="/assets/mp/html/light/assets/bundles/libscripts.bundle.js"></script>    
<script src="/assets/mp/html/light/assets/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/mp/html/assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>
<script src="/assets/mp/html/assets/vendor/jstree/jstree.min.js"></script>
<script src="/assets/mp/html/assets/vendor/toastr/toastr.js"></script>

<script src="/assets/mp/html/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="/assets/mp/html/assets/vendor/summernote/dist/summernote.js"></script>
<script src="/assets/mp/html/assets/vendor/nestable/jquery.nestable.js"></script>


<script src="/assets/mp/html/light/assets/bundles/mainscripts.bundle.js"></script>
<script src="/assets/mp/html/light/assets/bundles/morrisscripts.bundle.js"></script>
<script src="/assets/mp/html/light/assets/js/pages/treeview/jstree.js"></script>
<script src="/assets/mp/html/light/assets/js/pages/treeview/bootstrap-treeview.js"></script>
<script src="/assets/mp/html/light/assets/js/pages/forms/advanced-form-elements.js"></script>


<?php
if (isset($javascript) && count($javascript) > 0) { ?>
<!-- Carga de Scripts de la vista -->
<?php    foreach ($javascript as $j) { ?>
<script type="text/javascript" src="<?=$j?>"></script>
<?php
    }
}
?>
</body>
</html>
