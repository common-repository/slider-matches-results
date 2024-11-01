<?php 

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!'); 



?>



<div id='smr' class="wrap">
    <div class="row">
        <div class="col-xl mt-1 mb-1">
            <h1> SMR - <?php _e( 'Matches', 'slider-matches-results' ); ?> </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xl mt-1 mb-1">
            <div class="smr-matches-option">
                <button id="smr-button-create-match" class="btn btn-primary" type="button" data-toggle="modal" data-target="#smr-create-match"><?php _e( 'Add match', 'slider-matches-results' ); ?></button>
                <button id='smr-button-delete-multiple' class="btn btn-danger" type="button" disabled><?php _e( 'Delete matches', 'slider-matches-results' ); ?></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl mt-2 mb-2">
            <table id="smr-matches-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th><?php _e( 'Home team', 'slider-matches-results' ); ?></th>
                        <th><?php _e( 'Outside team', 'slider-matches-results' ); ?></th>
                        <th><?php _e( 'Week', 'slider-matches-results' ); ?></th>
                        <th><?php _e( 'Date', 'slider-matches-results' ); ?></th>
                        <th><?php _e( 'Championship', 'slider-matches-results' ); ?></th>
                        <th><?php _e( 'Score', 'slider-matches-results' ); ?></th>
                        <th></th>
                        <th></th>
                        <th><input id="smr-select-all-matches" type="checkbox" value=""></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $matches as $match ){ ?>
                    <tr id="smr-row-<?php echo $match->get_id(); ?>">
                        <td class="smr-cell-id"><?php echo $match->get_id(); ?></td>
                        <td class="smr-cell-home-team"><?php echo stripslashes( get_team_name( $teams, $match->get_home_team_id() ) ); ?></td>
                        <td class="smr-cell-outside-team"><?php echo stripslashes( get_team_name( $teams, $match->get_outside_team_id() ) ); ?></td>
                        <td class="smr-cell-week"><?php echo $match->get_week(); ?></td>
                        <td class="smr-cell-date"><?php echo get_date_local( $language,$match->get_date() ); ?></td>
                        <td class="smr-cell-championship"><?php echo $match->get_championship(); ?></td>
                        <td class="smr-cell-score"><?php echo $match->get_score(); ?></td>
                        <td class="smr-cell-button-update"> 
                            <button class="btn btn-success smr-button-update" type="button" data-toggle="modal" data-target="#smr-update-match" data-data='{"smrMatchId":"<?php echo $match->get_id(); ?>","smrMatchHomeTeamId":"<?php echo $match->get_home_team_id(); ?>","smrMatchOutsideTeamId":"<?php echo $match->get_outside_team_id(); ?>","smrMatchWeek":"<?php echo $match->get_week(); ?>","smrMatchDate":"<?php echo get_date_local( $language, $match->get_date() ); ?>","smrMatchChampionship":"<?php echo $match->get_championship(); ?>","smrMatchScore":"<?php echo $match->get_score(); ?>"}'><?php _e( 'Update', 'slider-matches-results' ); ?></button>
                        </td>
                        <td class="smr-cell-button-delete"> 
                            <button class="btn btn-danger smr-button-delete" type="button" data-data='{"smrMatchId":"<?php echo $match->get_id(); ?>"}' ><?php _e( 'Delete', 'slider-matches-results' ); ?> </button> 
                        </td>
                        <td class="smr-cell-select"> 
                            <input class="smr-select-match" type="checkbox" value="<?php echo $match->get_id(); ?>">
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="smr-update-match" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php _e( 'Update match', 'slider-matches-results' ); ?></h4>
                <button class="close" type="button" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php _e( 'Close', 'slider-matches-results' ); ?></span></button>
            </div>
            <form id="smr-form-update-match" role="form">
                <div class="modal-body">
                    <div class="alert alert-info ">                  
                        <p> <?php _e( 'You must fill in the "Home team" and the "Outside team" field and these fields should not be equal to validate the modification of your match.', 'slider-matches-results' ); ?> </p>
                    </div>
                    <input id="smr-update-match-id-input" type="hidden" name="smr-update-match-id-input">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-update-home-team-id-label" class="input-group-text"><span class="dashicons dashicons-nametag"></span></span>
                        </div>
                        <select id="smr-update-home-team-id-select" class="form-control" name="smr-update-home-team-id-select" aria-describedby="smr-update-home-team-id-label">
                            <option disabled selected value> -- <?php _e( 'Home team', 'slider-matches-results' ); ?> -- </option>
                            <?php foreach( $teams as $team ) { ?>
                            <option value="<?php echo $team->get_id(); ?>"><?php echo stripslashes( $team->get_name() ); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-update-outside-team-id-label" class="input-group-text"><span class="dashicons dashicons-nametag"></span></span>
                        </div>
                        <select id="smr-update-outside-team-id-select" class="form-control" name="smr-update-outside-team-id-select" aria-describedby="smr-update-outside-team-id-label">
                            <option disabled selected value> -- <?php _e( 'Outside team', 'slider-matches-results' ); ?> -- </option>
                            <?php foreach( $teams as $team ) { ?>
                            <option value="<?php echo $team->get_id() ?>"><?php echo stripslashes( $team->get_name() ); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-update-match-week-label" class="input-group-text"><span class="dashicons dashicons-calendar"></span></span>
                        </div>
                        <input id="smr-update-match-week-input" class="form-control" type="text" name="smr-update-match-week-input" placeholder="<?php _e( 'Week', 'slider-matches-results' ); ?>" aria-label="Week" aria-describedby="smr-update-match-week-label">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-update-match-date-label" class="input-group-text"><span class="dashicons dashicons-calendar-alt"></span></span>
                        </div>
                        <input id="smr-update-match-date-input" class="form-control datetimepicker-input" name="smr-update-match-date-input" type="text" placeholder="<?php _e( 'Date', 'slider-matches-results' ); ?>" aria-label="Date" aria-describedby="smr-update-match-date-label" data-toggle="datetimepicker" data-target="#smr-update-match-date-input">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-update-match-championship-label" class="input-group-text"><span class="dashicons dashicons-awards"></span></span>
                        </div>
                        <input id="smr-update-match-championship-input" class="form-control" type="text" name="smr-update-match-championship-input" placeholder="<?php _e( 'Championship', 'slider-matches-results' ); ?>" aria-label="championship" aria-describedby="smr-update-match-championship-label">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-update-match-score-label" class="input-group-text"><span class="dashicons dashicons-clipboard"></span></span>
                        </div>
                        <input id="smr-update-match-score-input" class="form-control" type="text" name="smr-update-match-score-input" placeholder="<?php _e( 'Score', 'slider-matches-results' ); ?>" aria-label="Score" aria-describedby="smr-update-match-score-label">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" name="smr-add-match" formmethod="post" ><?php _e( 'Update', 'slider-matches-results' ); ?></button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><?php _e( 'Close', 'slider-matches-results' ); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="smr-create-match" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php _e( 'Add match', 'slider-matches-results' ); ?></h4>
                <button class="close" type="button" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php _e( 'Close', 'slider-matches-results' ); ?></span></button>
            </div>
            <form id="smr-form-create-match" role="form">
                <div class="modal-body">
                    <div class="alert alert-info ">                  
                        <p> <?php _e( 'You must fill in the "Home team" and the "Outside team" field and these fields should not be equal to validate the addition of your match.', 'slider-matches-results' ); ?> </p>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-create-home-team-id-label" class="input-group-text"><span class="dashicons dashicons-nametag"></span></span>
                        </div>
                        <select id="smr-create-home-team-id-select" class="form-control" name="smr-create-home-team-id-select" aria-describedby="smr-create-home-team-id-label">
                            <option disabled selected value> -- <?php _e( 'Home team', 'slider-matches-results' ); ?> -- </option>
                            <?php foreach( $teams as $team ) { ?>
                            <option value="<?php echo $team->get_id(); ?>"><?php echo stripslashes( $team->get_name() ); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-create-outside-team-id-label" class="input-group-text"><span class="dashicons dashicons-nametag"></span></span>
                        </div>
                        <select id="smr-create-outside-team-id-select" class="form-control" name="smr-create-outside-team-id-select" aria-describedby="smr-create-outside-team-id-label">
                            <option disabled selected value> -- <?php _e( 'Outside team', 'slider-matches-results' ); ?> -- </option>
                            <?php foreach( $teams as $team ) { ?>
                            <option value="<?php echo $team->get_id() ?>"><?php echo stripslashes( $team->get_name() ); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-create-match-week-label" class="input-group-text"><span class="dashicons dashicons-calendar"></span></span>
                        </div>
                        <input id="smr-create-match-week-input" class="form-control" type="text" name="smr-create-match-week-input" placeholder="<?php _e( 'Week', 'slider-matches-results' ); ?>" aria-label="Week" aria-describedby="smr-create-match-week-label">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-create-match-date-label" class="input-group-text"><span class="dashicons dashicons-calendar-alt"></span></span>
                        </div>
                        <input id="smr-create-match-date-input" class="form-control datetimepicker-input" name="smr-create-match-date-input" type="text" placeholder="<?php _e( 'Date', 'slider-matches-results' ); ?>" aria-label="Date" aria-describedby="smr-create-match-date-label" data-toggle="datetimepicker" data-target="#smr-create-match-date-input">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-create-match-championship-label" class="input-group-text"><span class="dashicons dashicons-awards"></span></span>
                        </div>
                        <input id="smr-create-match-championship-input" class="form-control" type="text" name="smr-create-match-championship-input" placeholder="<?php _e( 'Championship', 'slider-matches-results' ); ?>" aria-label="championship" aria-describedby="smr-create-match-championship-label">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="smr-create-match-score-label" class="input-group-text"><span class="dashicons dashicons-clipboard"></span></span>
                        </div>
                        <input id="smr-create-match-score-input" class="form-control" type="text" name="smr-create-match-score-input" placeholder="<?php _e( 'Score', 'slider-matches-results' ); ?>" aria-label="Score" aria-describedby="smr-create-match-score-label">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="smr-add-match" class="btn btn-success" type="submit" name="smr-add-match" formmethod="post" ><?php _e( 'Create', 'slider-matches-results' ); ?></button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><?php _e( 'Close', 'slider-matches-results' ); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>


