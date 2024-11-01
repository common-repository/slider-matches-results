
<?php 

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!'); 

?>

<div id='smr' class="wrap">
    <div class="row">
        <div class="col-xl mt-1 mb-1">
            <h1> SMR - <?php _e( 'Sliders', 'slider-matches-results' ); ?> </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xl mt-1 mb-1">
            <div class="smr-sliders-option">
                <a id="smr-button-create-slider" class="btn btn-primary" href='<?php echo admin_url( 'admin.php?page=smr_plugin_create_slider' ); ?>'> <?php _e( 'Create slider', 'slider-matches-results' ); ?> </a>
                <button id='smr-button-delete-multiple' class="btn btn-danger" type="button" disabled><?php _e( 'Delete slider', 'slider-matches-results' ); ?></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl mt-2 mb-2">
            <table id="smr-sliders-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th><?php _e( 'Slider name', 'slider-matches-results' ); ?></th>
                        <th><?php _e( 'Shortcode', 'slider-matches-results' ); ?></th>
                        <th></th>
                        <th></th>
                        <th><input id="smr-select-all-sliders" type="checkbox" value=""></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $sliders as $slider ){ ?>
                    <tr id="smr-row-<?php echo $slider->get_id(); ?>">
                        <td class="smr-cell-id"><?php echo $slider->get_id(); ?></td>
                        <td class="smr-cell-id"><?php echo $slider->get_name(); ?></td>
                        <td class="smr-cell-score"><?php echo $slider->get_shortcode(); ?></td>
                        <td class="smr-cell-button-update"> 
                            <a class="btn btn-success smr-button-update" href="<?php echo admin_url( 'admin.php?page=smr_plugin_update_slider&id='.$slider->get_id() ); ?>"><?php _e( 'Update', 'slider-matches-results' ); ?></a>
                        </td>
                        <td class="smr-cell-button-delete"> 
                            <button class="btn btn-danger smr-button-delete" type="button" data-data='{"smrSliderId":"<?php echo $slider->get_id(); ?>"}' ><?php _e( 'Delete', 'slider-matches-results' ); ?></button> 
                        </td>
                        <td class="smr-cell-select"> 
                            <input class="smr-select-slider" type="checkbox" value="<?php echo $slider->get_id(); ?>">
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>