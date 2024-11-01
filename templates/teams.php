<?php 

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!'); 

?>


<div id='smr' class="wrap">
    <div class="row">
        <div class="col-xl mt-1 mb-1">
            <h1> SMR - <?php _e( 'Teams', 'slider-matches-results' ); ?> </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xl mt-1 mb-1">
            <div class="smr-teams-option">
                <button id="smr-button-create-team" class="btn btn-primary" type="button" data-toggle="modal" data-target="#smr-create-team"><?php _e( 'Add Team', 'slider-matches-results' ); ?></button>
                <button id='smr-button-delete-multiple' class="btn btn-danger" type="button" disabled><?php _e( 'Delete Teams', 'slider-matches-results' ); ?></button>
                <button id="smr-button-update-teams" class="btn btn-success" type="button" data-toggle="modal" data-target="#smr-update-teams"><?php _e( 'Update Teams', 'slider-matches-results' ); ?></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl mt-2 mb-2">
            <table id="smr-teams-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th><?php _e( 'Name', 'slider-matches-results' ); ?></th>
                        <th><?php _e( 'Position', 'slider-matches-results' ); ?></th>
                        <th><?php _e( 'Points', 'slider-matches-results' ); ?></th>
                        <th><?php _e( 'Logo', 'slider-matches-results' ); ?></th>
                        <th></th>
                        <th></th>
                        <th><input id="smr-select-all-teams" type="checkbox" value=""></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $teams as $team ) { ?>
                    <tr id="smr-row-<?php echo $team->get_id(); ?>" class="smr-row">
                        <td class="smr-cell-id"><?php echo $team->get_id(); ?></td>
                        <td class="smr-cell-name"><?php echo stripslashes( $team->get_name() ); ?></td>
                        <td class="smr-cell-position"><?php if( $team->get_position() > 0 ){ echo $team->get_position(); } ?></td>
                        <td class="smr-cell-points"><?php if( $team->get_points() > 0 ){ echo $team->get_points(); } ?></td>
                        <?php if( $display_logo ){ ?>
                        <td class="smr-cell-logo text-center"><img src="<?php echo $team->get_logo(); ?>" width="100px"></td>
                        <?php }else{ ?>
                        <td class="smr-cell-logo"><?php echo $team->get_logo(); ?></td>
                        <?php } ?>
                        <td class="smr-cell-button-update"> 
                            <button class="btn btn-success smr-button-update" type="button" data-toggle="modal" data-target="#smr-update-team" data-data='{"smrTeamId":"<?php echo $team->get_id(); ?>","smrTeamName":"<?php echo str_replace( '\'', '&#39;', stripslashes( $team->get_name() ) ); ?>","smrTeamPosition":"<?php echo $team->get_position(); ?>","smrTeamPoints":"<?php echo $team->get_points(); ?>","smrTeamLogo":"<?php echo $team->get_logo(); ?>"}'><?php _e( 'Update', 'slider-matches-results' ); ?></button>
                        </td>
                        <td class="smr-cell-button-delete"> 
                            <button class="btn btn-danger smr-button-delete" type="button" data-data='{"smrTeamId":"<?php echo $team->get_id(); ?>"}' ><?php _e( 'Delete', 'slider-matches-results' ); ?></button> 
                        </td>
                        <td class="smr-cell-select"> 
                            <input class="smr-select-team" type="checkbox" value="<?php echo $team->get_id(); ?>">
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="smr-update-teams" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php _e( 'Update Teams', 'slider-matches-results' ); ?></h4>
                <button class="close" type="button" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php _e( 'Close', 'slider-matches-results' ); ?></span></button>
            </div>
            <form id="smr-form-update-teams" role="form">
                <div class="modal-body">
                    <div id="smr-update-teams-<?php echo $team->get_id(); ?>" class="input-group mb-3">
                        <label class="form-control text-center cursor-grab"> <?php _e( 'Name', 'slider-matches-results' ); ?> </label>
                        <label class="form-control text-center cursor-grab"> <?php _e( 'Position', 'slider-matches-results' ); ?> </label>
                        <label class="form-control text-center cursor-grab"> <?php _e( 'Points', 'slider-matches-results' ); ?> </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" name="smr-update-teams" formmethod="post" ><?php _e( 'Update', 'slider-matches-results' ); ?></button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><?php _e( 'Close', 'slider-matches-results' ); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="smr-update-team" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php _e( 'Update Team', 'slider-matches-results' ); ?></h4>
                <button class="close" type="button" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php _e( 'Close', 'slider-matches-results' ); ?></span></button>
            </div>
            <form id="smr-form-update-team" role="form">
                <div class="modal-body">
                    <div class="alert alert-info ">                  
                        <p> <?php _e( 'You must fill in the "Name" field to validate the updating of your team', 'slider-matches-results' ); ?>.</p>
                    </div>
                    <input id="smr-update-team-id-input" type="hidden" name="smr-update-team-id-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-update-team-name-label" class="input-group-text"><span class="dashicons dashicons-nametag"></span></span>
                        </div>
                        <input id="smr-update-team-name-input" class="form-control" type="text"  name="smr-update-team-name-input" placeholder="<?php _e( 'Name', 'slider-matches-results' ); ?>" aria-label="Name" aria-describedby="smr-update-team-name-label">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-update-team-position-label" class="input-group-text"><span class="dashicons dashicons-awards"></span></span>
                        </div>
                        <input id="smr-update-team-position-input" class="form-control" type="number" name="smr-update-team-position-input" placeholder="<?php _e( 'Position', 'slider-matches-results' ); ?>" aria-label="Position" aria-describedby="smr-update-team-position-label">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-update-team-points-label" class="input-group-text"><span class="dashicons dashicons-awards"></span></span>
                        </div>
                        <input id="smr-update-team-points-input" class="form-control" type="number" name="smr-update-team-points-input" placeholder="<?php _e( 'Points', 'slider-matches-results' ); ?>" aria-label="Points" aria-describedby="smr-update-team-points-label">
                    </div>
                    <div class="input-group smr-update-team-logo-uploader">
                        <div class="input-group-prepend">
                            <span id="smr-update-team-logo-label" class="input-group-text"><span class="dashicons dashicons-format-image"></span></span>
                        </div>
                        <input id="smr-update-team-logo-input" class="form-control" type="text"  name="smr-update-team-logo-input" placeholder="<?php _e( 'Url', 'slider-matches-results' ); ?>" aria-label="Url" aria-describedby="smr-update-team-logo-label">
                    </div>
                    <div id="smr-update-team-logo">
                        <div style="text-align:center"><br>
                        <img src="#" style="max-width:150px;"/></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" name="smr-update-team" formmethod="post" ><?php _e( 'Update', 'slider-matches-results' ); ?></button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><?php _e( 'Close', 'slider-matches-results' ); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="smr-create-team" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php _e( 'Add Team', 'slider-matches-results' ); ?></h4>
                <button class="close" type="button" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php _e( 'Close', 'slider-matches-results' ); ?></span></button>
            </div>
            <form id="smr-form-create-team" role="form">
                <div class="modal-body">
                    <div class="alert alert-info ">                  
                        <p> <?php _e( 'You must fill in the "Name" field to validate the addition of your team.', 'slider-matches-results' ); ?> </p>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-create-team-name-label" class="input-group-text"><span class="dashicons dashicons-nametag"></span></span>
                        </div>
                        <input id="smr-create-team-name-input" class="form-control" type="text" name="smr-create-team-name-input" placeholder="<?php _e( 'Name', 'slider-matches-results' ); ?>" aria-label="Name" aria-describedby="smr-create-team-name-label">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-create-team-position-label" class="input-group-text"><span class="dashicons dashicons-awards"></span></span>
                        </div>
                        <input id="smr-create-team-position-input" class="form-control" type="number" name="smr-create-team-position-input" placeholder="<?php _e( 'Position', 'slider-matches-results' ); ?>" aria-label="Position" aria-describedby="smr-create-team-position-label">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-create-team-points-label" class="input-group-text"><span class="dashicons dashicons-awards"></span></span>
                        </div>
                        <input id="smr-create-team-points-input" class="form-control" type="number" name="smr-create-team-points-input" placeholder="<?php _e( 'Points', 'slider-matches-results' ); ?>" aria-label="Points" aria-describedby="smr-create-team-points-label">
                    </div>
                    <div class="input-group smr-create-team-logo-uploader">
                        <div class="input-group-prepend">
                            <span id="smr-create-team-logo-label" class="input-group-text"><span class="dashicons dashicons-format-image"></span></span>
                        </div>
                        <input id="smr-create-team-logo-input" class="form-control" type="text"  name="smr-create-team-logo-input" placeholder="<?php _e( 'Url', 'slider-matches-results' ); ?>" aria-label="Url" aria-describedby="smr-create-team-logo-label">
                    </div>
                    <div class="smr-create-team-logo"></div>
                </div>
                <div class="modal-footer">
                    <button id="smr-add-team" class="btn btn-success" type="submit" name="smr-add-team" formmethod="post" ><?php _e( 'Create', 'slider-matches-results' ); ?></button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><?php _e( 'Close', 'slider-matches-results' ); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>



