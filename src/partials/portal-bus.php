<?php $pdf = get_option('portal_bus_stop_pdf'); ?>
<div class="panel panel-flat">
    <div class="panel-heading">
        Bus Stop Info
        <span class="panel-subtitle">Locate your bus stop by downloading the PDF below.</span>
    </div>
    <div class="panel-body">
        <a href="<?php echo $pdf; ?>" target="_blank" class="btn btn-block btn-xl btn-default <?php echo !$pdf ? 'disabled': ''; ?>">
            <i class="icon mdi mdi-collection-pdf"></i>
            Download Bus Stop Info
        </a>
    </div>
</div>