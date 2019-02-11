<!-- Javascript -->
<script src="/assets/mplifyadmin/html/light/assets/bundles/libscripts.bundle.js"></script>    
<script src="/assets/mplifyadmin/html/light/assets/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/mplifyadmin/html/assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>
<script src="/assets/mplifyadmin/html/assets/vendor/jstree/jstree.min.js"></script>
<script src="/assets/mplifyadmin/html/assets/vendor/toastr/toastr.js"></script>

<script src="/assets/mplifyadmin/html/assets/vendor/select2/select2.min.js"></script> <!-- Select2 Js -->

<script src="/assets/mplifyadmin/html/light/assets/bundles/mainscripts.bundle.js"></script>
<script src="/assets/mplifyadmin/html/light/assets/bundles/morrisscripts.bundle.js"></script>
<script src="/assets/mplifyadmin/html/light/assets/js/pages/treeview/jstree.js"></script>
<script src="/assets/mplifyadmin/html/light/assets/js/pages/treeview/bootstrap-treeview.js"></script>
<script src="/assets/mplifyadmin/html/light/assets/js/pages/forms/advanced-form-elements.js"></script>
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
