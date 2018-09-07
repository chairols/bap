
</div>
</section>
<script src="/assets/oreoadmin-140/html-light/assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="/assets/oreoadmin-140/html-light/assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->
<script src="/assets/oreoadmin-140/html-light/assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor --> 
<script src="/assets/oreoadmin-140/html-light/assets/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
<script src="/assets/oreoadmin-140/html-light/assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="/assets/oreoadmin-140/html-light/assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob, Count To, Sparkline Js -->
<script src="/assets/oreoadmin-140/html-light/assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->

<script src="/assets/oreoadmin-140/html-light/assets/bundles/mainscripts.bundle.js"></script>
<script src="/assets/oreoadmin-140/html-light/assets/js/pages/index.js"></script>
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