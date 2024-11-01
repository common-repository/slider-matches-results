<div id='smr' class="wrap">
    <div class="row">
        <div class="col-xl mt-1 mb-1">
            <h1> SMR - <?php _e( 'Settings', 'slider-matches-results' ); ?></h1>
        </div>
    </div>
    <div id="smr-settings" class="row mt-3">
        <div class="col-2">
        <div id="v-pills-tab" class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
            <a id="v-pills-slider-tab" class="nav-link <?php echo get_settings_page_active( $page_active, 'slider' ); ?>" data-toggle="pill" href="#v-pills-slider" role="tab" aria-controls="v-pills-slider" aria-selected="true"><?php _e( 'Slider', 'slider-matches-results' ); ?></a>
            <a id="v-pills-ranking-tab" class="nav-link <?php echo get_settings_page_active( $page_active, 'ranking' ); ?>" data-toggle="pill" href="#v-pills-ranking" role="tab" aria-controls="v-pills-ranking" aria-selected="false"><?php _e( 'Ranking', 'slider-matches-results' ); ?></a>
            <a id="v-pills-teams-tab" class="nav-link <?php echo get_settings_page_active( $page_active, 'teams' ); ?>" data-toggle="pill" href="#v-pills-teams" role="tab" aria-controls="v-pills-teams" aria-selected="false"><?php _e( 'Teams', 'slider-matches-results' ); ?></a>
            <a id="v-pills-matches-tab" class="nav-link <?php echo get_settings_page_active( $page_active, 'matches' ); ?>" data-toggle="pill" href="#v-pills-matches" role="tab" aria-controls="v-pills-matches" aria-selected="false"><?php _e( 'Matches', 'slider-matches-results' ); ?></a>
        </div>
        </div>
        <div class="col-10">
        <div id="v-pills-tabContent" class="tab-content">
            <div id="v-pills-slider" class="tab-pane fade <?php echo get_settings_page_active( $page_active, 'slider' ); ?>" role="tabpanel" aria-labelledby="v-pills-slider-tab">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h2><?php _e( 'Settings', 'slider-matches-results' ); ?> - <?php _e( 'Slider', 'slider-matches-results' ); ?></h2>
                        <p class="lead"><?php _e( 'In this page, You can change the default settings of the sliders.', 'slider-matches-results' ); ?></p>
                    </div>
                </div>
                <div class="alert alert-danger mt-4 smr-alert-update-error d-none" role="alert"><?php _e( 'Fields with a red border are required', 'slider-matches-results' ); ?></div>
                <div class="alert alert-success mt-4 <?php if( !$this->is_state_active( $state_active, "update_success" ) || !is_settings_page_active( $page_active, 'slider' ) ){ echo 'd-none'; }?>" role="alert"><?php _e( 'Your settings has been successfully updated', 'slider-matches-results' ); ?></div>
                
                <div class="col-xl pb-2 mb-2 mt-4 border-bottom border-primary">
                    <h3> <?php _e( 'Header', 'slider-matches-results' ); ?> </h3>
                </div>
                <div class="col-xl mt-4 <?php echo get_settings_subpage_active( $subpage_active, 'header' ); ?>">
                    <form id="smr-form-update-settings-slider-header" >
                        <input type="hidden" name="smr-form-update-settings">
                        <input type="hidden" name="smr-form-update-settings-slider-page" value="slider">
                        <input type="hidden" name="smr-form-update-settings-slider-subpage" value="header">
                        <div class="col-xl">
                            <div class="form-group row">
                                <label for="smr-setting-slider-header-date-text-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Date', 'slider-matches-results' ); - _e( 'Text color', 'slider-matches-results' ); ?></label>
                                <div id="smr-setting-slider-header-date-text-color-group" class="col-8 input-group">
                                    <input id="smr-setting-slider-header-date-text-color" type="text" class="form-control input-lg" name="smr-setting-slider-header-date-text-color" value="<?php echo $settings_slider_header->get_date_text_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-setting-slider-header-date-background-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Date', 'slider-matches-results' ); - _e( 'Background color', 'slider-matches-results' ); ?></label>
                                <div id="smr-setting-slider-header-date-background-color-group" class="col-8 input-group">
                                    <input id="smr-setting-slider-header-date-background-color" type="text" class="form-control input-lg" name="smr-setting-slider-header-date-background-color" value="<?php echo $settings_slider_header->get_date_background_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-setting-slider-header-title-text-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Title', 'slider-matches-results' ); - _e( 'Text color', 'slider-matches-results' ); ?></label>
                                <div id="smr-setting-slider-header-title-text-color-group" class="col-8 input-group">
                                    <input id="smr-setting-slider-header-title-text-color" type="text" class="form-control input-lg" name="smr-setting-slider-header-title-text-color" value="<?php echo $settings_slider_header->get_title_text_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-setting-slider-header-title-background-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Title', 'slider-matches-results' ); - _e( 'Background color', 'slider-matches-results' ); ?></label>
                                <div id="smr-setting-slider-header-title-background-color-group" class="col-8 input-group">
                                    <input id="smr-setting-slider-header-title-background-color" type="text" class="form-control input-lg" name="smr-setting-slider-header-title-background-color" value="<?php echo $settings_slider_header->get_title_background_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 text-right">
                                    <button id="smr-update-settings-slider-header-reset" class="btn btn-danger btn-lg mr-3" type="reset"><?php _e( 'Reset', 'slider-matches-results' ); ?></button>
                                    <button id="smr-update-settings-slider-header-submit" class="btn btn-success btn-lg" type="submit" formmethod="post"><?php _e( 'Save', 'slider-matches-results' ); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-xl pb-2 mb-2 border-bottom border-primary">
                    <h3> <?php _e( 'Content', 'slider-matches-results' ); ?> </h3>
                </div>
                <div class="col-xl mt-4 <?php echo get_settings_subpage_active( $subpage_active, 'content' ); ?>">
                    <form id="smr-form-update-settings-slider-content" >
                        <input type="hidden" name="smr-form-update-settings">
                        <input type="hidden" name="smr-form-update-settings-slider-page" value="slider">
                        <input type="hidden" name="smr-form-update-settings-slider-subpage" value="content">

                        <div class="col-xl">
                            <div class="form-group row">
                                <label for="smr-setting-slider-content-text-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Text color', 'slider-matches-results' ); ?></label>
                                <div id="smr-setting-slider-content-text-color-group" class="col-8 input-group">
                                    <input id="smr-setting-slider-content-text-color" type="text" class="form-control input-lg" name="smr-setting-slider-content-text-color" value="<?php echo $settings_slider_content->get_text_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-setting-slider-content-background-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Background color', 'slider-matches-results' ); ?></label>
                                <div id="smr-setting-slider-content-background-color-group" class="col-8 input-group">
                                    <input id="smr-setting-slider-content-background-color" type="text" class="form-control input-lg" name="smr-setting-slider-content-background-color" value="<?php echo $settings_slider_content->get_background_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-setting-slider-content-max-width-logo" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Max width logo', 'slider-matches-results' ); ?></label>
                                <div id="smr-setting-slider-content-max-width-logo-group" class="col-8 input-group">
                                    <input id="smr-setting-slider-content-max-width-logo" type="text" class="form-control input-lg" name="smr-setting-slider-content-max-width-logo" value="<?php echo $settings_slider_content->get_max_width_logo(); ?>"/>
                                </div>
                            </div>
                            
                            

                        
                            <div class="form-group row">
                                <div class="col-lg-12 text-right">
                                    <button id="smr-update-settings-slider-content-reset" class="btn btn-danger btn-lg mr-3 " type="reset"><?php _e( 'Reset', 'slider-matches-results' ); ?></button>
                                    <button id="smr-update-settings-slider-content-submit" class="btn btn-success btn-lg" type="submit" formmethod="post"><?php _e( 'Save', 'slider-matches-results' ); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-xl pb-2 mb-2 border-bottom border-primary">
                    <h3> <?php _e( 'Footer', 'slider-matches-results' ); ?> </h3>
                </div>
                <div class="col-xl mt-4  <?php echo get_settings_subpage_active( $subpage_active, 'footer' ); ?>">
                    <form id="smr-form-update-settings-slider-footer" >
                        <input type="hidden" name="smr-form-update-settings">
                        <input type="hidden" name="smr-form-update-settings-slider-page" value="slider">
                        <input type="hidden" name="smr-form-update-settings-slider-subpage" value="footer">
                        <div class="col-xl">
                            <div class="form-group row">
                                <label for="smr-setting-slider-footer-display-footer" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Display footer', 'slider-matches-results' ); ?></label>
                                <div class="col-8">
                                    <div class="custom-switch custom-switch-label-onoff">
                                        <input class="custom-switch-input" id="smr-setting-slider-footer-display-footer" name="smr-setting-slider-footer-display-footer" type="checkbox" <?php if( $settings_slider_footer->get_display_footer() ){ echo 'checked'; } ?>>
                                        <label class="custom-switch-btn" for="smr-setting-slider-footer-display-footer"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-setting-slider-footer-text-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Text color', 'slider-matches-results' ); ?></label>
                                <div id="smr-setting-slider-footer-text-color-group" class="col-8 input-group">
                                    <input id="smr-setting-slider-footer-text-color" type="text" class="form-control input-lg" name="smr-setting-slider-footer-text-color" value="<?php echo $settings_slider_footer->get_text_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-setting-slider-footer-background-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Background color', 'slider-matches-results' ); ?></label>
                                <div id="smr-setting-slider-footer-background-color-group" class="col-8 input-group">
                                    <input id="smr-setting-slider-footer-background-color" type="text" class="form-control input-lg" name="smr-setting-slider-footer-background-color" value="<?php echo $settings_slider_footer->get_background_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 text-right">
                                    <button id="smr-update-settings-slider-footer-reset" class="btn btn-danger btn-lg mr-3 " type="reset"><?php _e( 'Reset', 'slider-matches-results' ); ?></button>
                                    <button id="smr-update-settings-slider-footer-submit" class="btn btn-success btn-lg" type="submit" formmethod="post"><?php _e( 'Save', 'slider-matches-results' ); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl pb-2 mb-2 border-bottom border-primary">
                    <h3> <?php _e( 'Slide', 'slider-matches-results' ); ?> </h3>
                </div>
                <div class="col-xl mt-4 <?php echo get_settings_subpage_active( $subpage_active, 'slide' ); ?>">
                    <form id="smr-form-update-settings-slider-slide" >
                        <input type="hidden" name="smr-form-update-settings">
                        <input type="hidden" name="smr-form-update-settings-slider-page" value="slider">
                        <input type="hidden" name="smr-form-update-settings-slider-subpage" value="slide">

                        <input type="hidden" name="smr-setting-slider-slide-slides-to-show" value="<?php echo $settings_slide->get_slides_to_show(); ?>">
                        <input type="hidden" name="smr-setting-slider-slide-slides-to-scroll" value="<?php echo $settings_slide->get_slides_to_scroll(); ?>">
                        <input type="hidden" name="smr-setting-slider-slide-adaptative-height" value="<?php echo $settings_slide->get_adaptative_height() ? 'true' : 'false'; ?>">


                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-infinite" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Infinite', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-setting-slider-slide-infinite" name="smr-setting-slider-slide-infinite" type="checkbox" <?php if( $settings_slide->get_infinite() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-setting-slider-slide-infinite"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-dots" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Dots', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-setting-slider-slide-dots" name="smr-setting-slider-slide-dots" type="checkbox" <?php if( $settings_slide->get_dots() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-setting-slider-slide-dots"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-dots-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Dots', 'slider-matches-results' ); ?> - <?php _e( 'Color', 'slider-matches-results' ); ?></label>
                            <div id="smr-setting-slider-slide-dots-color-group" class="col-8 input-group">
                                <input id="smr-setting-slider-slide-dots-color" type="text" class="form-control input-lg" name="smr-setting-slider-slide-dots-color" value="<?php echo $settings_slide->get_dots_color();?>" <?php if( !$settings_slide->get_dots() ){ echo 'disabled'; }?> />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-autoplay" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Autoplay', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-setting-slider-slide-autoplay" name="smr-setting-slider-slide-autoplay" type="checkbox" <?php if( $settings_slide->get_autoplay() ){ echo 'checked'; } ?> />
                                    <label class="custom-switch-btn" for="smr-setting-slider-slide-autoplay"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-autoplay-speed" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Autoplay', 'slider-matches-results' ); ?> - <?php _e( 'Speed', 'slider-matches-results' ); ?> (ms)</label>
                            <div class="col-8 input-group">
                                <input id="smr-setting-slider-slide-autoplay-speed" type="number" class="form-control input-lg" name="smr-setting-slider-slide-autoplay-speed" value="<?php echo $settings_slide->get_autoplay_speed(); ?>" <?php if( !$settings_slide->get_autoplay() ){ echo 'disabled'; } ?>/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-arrows" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Arrows', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-setting-slider-slide-arrows" name="smr-setting-slider-slide-arrows" type="checkbox" <?php if( $settings_slide->get_arrows() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-setting-slider-slide-arrows"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-arrows-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Arrows', 'slider-matches-results' ); ?> - <?php _e( 'Color', 'slider-matches-results' ); ?></label>
                            <div id="smr-setting-slider-slide-arrows-color-group" class="col-8 input-group">
                                <input id="smr-setting-slider-slide-arrows-color" type="text" class="form-control input-lg" name="smr-setting-slider-slide-arrows-color"  value="<?php echo $settings_slide->get_arrows_color();?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-arrows-in" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Arrows in slider', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-setting-slider-slide-arrows-in" name="smr-setting-slider-slide-arrows-in" type="checkbox" <?php if( $settings_slide->get_arrows_in() ){ echo 'checked'; } ?> <?php if( !$settings_slide->get_arrows() ){ echo 'disabled'; }?> />
                                    <label class="custom-switch-btn" for="smr-setting-slider-slide-arrows-in"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-fade" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Transition', 'slider-matches-results' ); ?> - <?php _e( 'Fade', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-setting-slider-slide-fade" name="smr-setting-slider-slide-fade" type="checkbox" <?php if( $settings_slide->get_fade() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-setting-slider-slide-fade"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-transition-type" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Transition', 'slider-matches-results' ); ?> - <?php _e( 'Type', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <select id="smr-setting-slider-slide-transition-type" class="form-control form-control-chosen-required" data-placeholder="Please select..." name="smr-setting-slider-slide-transition-type">
                                    <?php foreach ( get_settings_transition_type() as $setting_transition_type ) { ?>
                                    <option <?php if( $settings_slide->get_transition_type() == $setting_transition_type ){ echo 'selected'; } ?> value="<?php echo $setting_transition_type; ?>"><?php echo $setting_transition_type; ?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-transition-speed" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Transition', 'slider-matches-results' ); ?> - <?php _e( 'Speed', 'slider-matches-results' ); ?> (ms)</label>
                            <div class="col-8 input-group">
                                <input id="smr-setting-slider-slide-transition-speed" type="number" class="form-control input-lg" name="smr-setting-slider-slide-transition-speed" value="<?php echo $settings_slide->get_transition_speed(); ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-setting-slider-slide-swipe" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Swipe', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-setting-slider-slide-swipe" name="smr-setting-slider-slide-swipe" type="checkbox" <?php if( $settings_slide->get_swipe() ){ echo 'checked'; } ?> />
                                    <label class="custom-switch-btn" for="smr-setting-slider-slide-swipe"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <button id="smr-update-settings-slider-slide-show" class="btn btn-primary btn-lg" type="button"><?php _e( 'Show slide animation', 'slider-matches-results' ); ?></button>
                                
                                <button id="smr-update-settings-slider-slide-submit" class="btn btn-success btn-lg float-right" type="submit" formmethod="post"><?php _e( 'Save', 'slider-matches-results' ); ?></button>
                                <button id="smr-update-settings-slider-slide-reset" class="btn btn-danger btn-lg mr-3 float-right" type="reset"><?php _e( 'Reset', 'slider-matches-results' ); ?></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="col-xl mt-4">
                    <div id="smr-update-settings-slider-slide-example" class="col-4 mx-auto p-0">
                        <div class="smr-update-settings-slider-slide-example-div">1</div>
                        <div class="smr-update-settings-slider-slide-example-div">2</div>
                        <div class="smr-update-settings-slider-slide-example-div">3</div>
                    </div>
                </div>
            </div>
            <div id="v-pills-ranking" class="tab-pane fade <?php echo get_settings_page_active( $page_active, 'ranking' ); ?>" role="tabpanel" aria-labelledby="v-pills-ranking-tab">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h2><?php _e( 'Settings', 'slider-matches-results' ); ?> - <?php _e( 'Ranking', 'slider-matches-results' ); ?></h2>
                        <p class="lead"><?php _e( 'In this page, You can change the default settings of the ranking.', 'slider-matches-results' ); ?></p>
                    </div>
                </div>
                <div class="alert alert-danger mt-4 smr-alert-update-error d-none" role="alert"><?php _e( 'Fields with a red border are required', 'slider-matches-results' ); ?></div>
                <div class="alert alert-success mt-4 <?php if( !$this->is_state_active( $state_active,"update_success" ) || !is_settings_page_active( $page_active, 'ranking' ) ){ echo 'd-none'; }?>" role="alert"><?php _e( 'Your settings has been successfully updated', 'slider-matches-results' ); ?></div>
                <div class="col-xl mt-4">
                    <form id="smr-form-update-settings-ranking" >
                        <input type="hidden" name="smr-form-update-settings">
                        <input id="smr-form-update-settings-ranking-page" type="hidden" name="smr-form-update-settings-ranking-page" value="ranking">
                        <div class="form-group row">
                            <label for="smr-setting-ranking-display-ranking" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Display ranking', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-setting-ranking-display-ranking" name="smr-setting-ranking-display-ranking" type="checkbox" <?php if( $settings_ranking->get_display_ranking() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-setting-ranking-display-ranking"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-background-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Background color', 'slider-matches-results' ); ?></label>
                            <div id="smr-setting-ranking-background-color-group" class="col-8 input-group">
                                <input id="smr-setting-ranking-background-color" type="text" class="form-control input-lg" name="smr-setting-ranking-background-color" value="<?php echo $settings_ranking->get_background_color(); ?>"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-text-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Text color', 'slider-matches-results' ); ?></label>
                            <div id="smr-setting-ranking-text-color-group" class="col-8 input-group">
                                <input id="smr-setting-ranking-text-color" type="text" class="form-control input-lg" name="smr-setting-ranking-text-color" value="<?php echo $settings_ranking->get_text_color(); ?>"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-team" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Your team', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <select id="smr-setting-ranking-team" class="form-control form-control-chosen-required" name="smr-setting-ranking-team" <?php if( !$settings_ranking->get_display_ranking() ){ echo 'disabled'; } ?>>
                                    <option value="0"><?php _e( 'No one', 'slider-matches-results' ); ?></option>
                                    <?php 
                                        $smr_setting_ranking_team_value = 0;
                                        foreach( $teams as $team ){
                                    ?>
                                    <option <?php if( $settings_ranking->get_team_id() == $team->get_id() ){ $smr_setting_ranking_team_value = $team->get_id(); echo 'selected'; } ?> value="<?php echo $team->get_id(); ?>"><?php echo $team->get_name(); ?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-background-color-team" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Your team', 'slider-matches-results' ); ?> - <?php _e( 'Background color', 'slider-matches-results' ); ?></label>
                            <div id="smr-setting-ranking-background-color-team-group" class="col-8 input-group">
                                <input id="smr-setting-ranking-background-color-team" type="text" class="form-control input-lg" name="smr-setting-ranking-background-color-team" value="<?php echo $settings_ranking->get_background_color_team(); ?>" <?php if( $smr_setting_ranking_team_value == 0 ){ echo 'disabled'; } ?>/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-text-color-team" class="col-4 col-form-label col-form-label-lg"> <?php _e( 'Your team', 'slider-matches-results' ); ?> -  <?php _e( 'Text color', 'slider-matches-results' ); ?></label>
                            <div id="smr-setting-ranking-text-color-team-group" class="col-8 input-group">
                                <input id="smr-setting-ranking-text-color-team" type="text" class="form-control input-lg" name="smr-setting-ranking-text-color-team" value="<?php echo $settings_ranking->get_text_color_team(); ?>" <?php if( $smr_setting_ranking_team_value == 0 ){ echo 'disabled'; } ?>/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-display-border" class="col-4 col-form-label col-form-label-lg"> <?php _e( 'Display border', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-setting-ranking-display-border" name="smr-setting-ranking-display-border" type="checkbox" <?php if( $settings_ranking->get_display_border() ){ echo 'checked'; } ?> <?php if( !$settings_ranking->get_display_ranking() ){ echo 'disabled'; } ?>/>
                                    <label class="custom-switch-btn" for="smr-setting-ranking-display-border"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-border-width" class="col-4 col-form-label col-form-label-lg"> <?php _e( 'Border width', 'slider-matches-results' ); ?></label>
                            <div class="col-8 input-group">
                                <input id="smr-setting-ranking-border-width" type="text" class="form-control input-lg" name="smr-setting-ranking-border-width" value="<?php echo $settings_ranking->get_border_width(); ?>" <?php if( !$settings_ranking->get_display_ranking() || !$settings_ranking->get_display_border() ){ echo 'disabled'; } ?>/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-border-style" class="col-4 col-form-label col-form-label-lg"> <?php _e( 'Border style', 'slider-matches-results' ); ?></label>
                            <div class="col-8 input-group">
                                <input id="smr-setting-ranking-border-style" type="text" class="form-control input-lg" name="smr-setting-ranking-border-style" value="<?php echo $settings_ranking->get_border_style(); ?>" <?php if( !$settings_ranking->get_display_ranking() || !$settings_ranking->get_display_border() ){ echo 'disabled'; } ?>/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-border-color" class="col-4 col-form-label col-form-label-lg"> <?php _e( 'Border color', 'slider-matches-results' ); ?></label>
                            <div id="smr-setting-ranking-border-color-group" class="col-8 input-group">
                                <input id="smr-setting-ranking-border-color" type="text" class="form-control input-lg" name="smr-setting-ranking-border-color" value="<?php echo $settings_ranking->get_border_color(); ?>" <?php if( !$settings_ranking->get_display_ranking() || !$settings_ranking->get_display_border() ){ echo 'disabled'; } ?>/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-nb-teams" class="col-4 col-form-label col-form-label-lg"> <?php _e( 'Nb teams', 'slider-matches-results' ); ?></label>
                            <div class="col-8 input-group">
                                <input id="smr-setting-ranking-nb-teams" type="number" class="form-control input-lg" name="smr-setting-ranking-nb-teams" value="<?php echo $settings_ranking->get_nb_teams(); ?>" <?php if( !$settings_ranking->get_display_ranking() ){ echo 'disabled'; } ?>/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-nb-teams-above" class="col-4 col-form-label col-form-label-lg"> <?php _e( 'Nb teams above', 'slider-matches-results' ); ?></label>
                            <div class="col-8 input-group">
                                <input id="smr-setting-ranking-nb-teams-above" type="number" class="form-control input-lg" name="smr-setting-ranking-nb-teams-above" value="<?php echo $settings_ranking->get_nb_teams_above(); ?>" <?php if( !$settings_ranking->get_display_ranking() ){ echo 'disabled'; } ?>/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-ranking-nb-teams-below" class="col-4 col-form-label col-form-label-lg"> <?php _e( 'Nb teams below', 'slider-matches-results' ); ?></label>
                            <div class="col-8 input-group">
                                <input id="smr-setting-ranking-nb-teams-below" type="number" class="form-control input-lg" name="smr-setting-ranking-nb-teams-below" value="<?php echo $settings_ranking->get_nb_teams_below(); ?>" <?php if( !$settings_ranking->get_display_ranking() ){ echo 'disabled'; } ?>/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 text-right">
                                <button id="smr-update-settings-ranking-reset" class="btn btn-danger btn-lg mr-3 " type="reset"> <?php _e( 'Reset', 'slider-matches-results' ); ?></button>
                                <button id="smr-update-settings-ranking-submit" class="btn btn-success btn-lg" type="submit" formmethod="post"> <?php _e( 'Save', 'slider-matches-results' ); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="v-pills-teams" class="tab-pane fade <?php echo get_settings_page_active( $page_active, 'teams' ); ?>" role="tabpanel" aria-labelledby="v-pills-teams-tab">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h2> <?php _e( 'Settings', 'slider-matches-results' ); ?> -  <?php _e( 'Teams', 'slider-matches-results' ); ?></h2>
                        <p class="lead"> <?php _e( 'In this page, you can change your "Teams" administration page.', 'slider-matches-results' ); ?></p>
                    </div>
                </div>
                <div class="alert alert-danger mt-4 smr-alert-update-error d-none " role="alert"> <?php _e( 'Fields with a red border are required', 'slider-matches-results' ); ?></div>
                <div class="alert alert-success mt-4 <?php if( !$this->is_state_active( $state_active, "update_success" ) || !is_settings_page_active( $page_active, 'teams' ) ){ echo 'd-none'; }?>" role="alert"> <?php _e( 'Your settings has been successfully updated', 'slider-matches-results' ); ?></div>
                <div class="col-xl mt-4">
                    <form id="smr-form-update-settings-teams" >
                        <input type="hidden" name="smr-form-update-settings">
                        <input id="smr-form-update-settings-teams-page" type="hidden" name="smr-form-update-settings-teams-page" value="teams">
                        <div class="form-group row">
                            <label for="smr-setting-teams-order-by" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Order by', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <select id="smr-setting-teams-order-by" class="form-control form-control-chosen-required" data-placeholder="Please select..." name="smr-setting-teams-order-by">
                                    <?php 
                                    $value = 0;
                                    foreach( get_settings_order_by( 'teams' ) as $setting_order_by ){ 
                                    ?>
                                    <option <?php if( $settings_teams->get_order_by() == $value ){ echo 'selected'; } ?> value="<?php echo $value; ?>"><?php echo $setting_order_by; ?></option>
                                    <?php 
                                        $value++;
                                    } 
                                    ?>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-teams-nb-elements" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Number of elements', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <select id="smr-setting-teams-nb-elements" class="form-control form-control-chosen-required" name="smr-setting-teams-nb-elements">
                                    <?php foreach ( get_settings_nb_elements() as $setting_nb_elements ){ ?>
                                    <option <?php if( $settings_teams->get_nb_elements() == $setting_nb_elements ){ echo 'selected'; } ?> value="<?php echo $setting_nb_elements; ?>"><?php echo $setting_nb_elements; ?></option>
                                    <?php } ?>
                                </select>                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-teams-display-logo" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Display logo', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-setting-teams-display-logo" name="smr-setting-teams-display-logo" type="checkbox" <?php if( $settings_teams->get_display_logo() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-setting-teams-display-logo"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 text-right">
                                <button id="smr-update-settings-teams-reset" class="btn btn-danger btn-lg mr-3 " type="reset"><?php _e( 'Reset', 'slider-matches-results' ); ?></button>
                                <button id="smr-update-settings-teams-submit" class="btn btn-success btn-lg" type="submit" formmethod="post"><?php _e( 'Save', 'slider-matches-results' ); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="v-pills-matches" class="tab-pane fade <?php echo get_settings_page_active( $page_active, 'matches' ); ?>" role="tabpanel" aria-labelledby="v-pills-matches-tab">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h2><?php _e( 'Settings', 'slider-matches-results' ); ?> - <?php _e( 'Matches', 'slider-matches-results' ); ?></h2>
                        <p class="lead"><?php _e( 'In this page, you can change your "Matches" administration page.', 'slider-matches-results' ); ?></p>
                    </div>
                </div>
                <div class="alert alert-danger mt-4 smr-alert-update-error d-none" role="alert"><?php _e( 'Fields with a red border are required', 'slider-matches-results' ); ?></div>
                <div class="alert alert-success mt-4 <?php if( !$this->is_state_active( $state_active, "update_success" ) || !is_settings_page_active( $page_active, 'matches' ) ){ echo 'd-none'; }?>" role="alert"><?php _e( 'Your settings has been successfully updated', 'slider-matches-results' ); ?></div>
                <div class="col-xl mt-4">
                    <form id="smr-form-update-settings-matches" >
                        <input type="hidden" name="smr-form-update-settings">
                        <input id="smr-form-update-settings-matches-page" type="hidden" name="smr-form-update-settings-matches-page" value="matches">
                        <div class="form-group row">
                            <label for="smr-setting-matches-order-by" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Order by', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <select id="smr-setting-matches-order-by" class="form-control form-control-chosen-required" data-placeholder="Please select..." name="smr-setting-matches-order-by">
                                    <?php 
                                        $value = 0;
                                        foreach( get_settings_order_by( 'matches' ) as $setting_order_by ) { 
                                    ?>
                                    <option <?php if( $settings_matches->get_order_by() == $value ){ echo 'selected'; } ?> value="<?php echo $value; ?>"><?php echo $setting_order_by; ?></option>
                                    <?php 
                                            $value++;
                                        } 
                                    ?>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smr-setting-matches-nb-elements" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Number of elements', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <select id="smr-setting-matches-nb-elements" class="form-control form-control-chosen-required" name="smr-setting-matches-nb-elements">
                                    <?php foreach( get_settings_nb_elements() as $setting_nb_elements ) { ?>
                                    <option <?php if( $settings_matches->get_nb_elements() == $setting_nb_elements ){ echo 'selected'; } ?> value="<?php echo $setting_nb_elements; ?>"><?php echo $setting_nb_elements; ?></option>
                                    <?php } ?>
                                </select>                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 text-right">
                                <button id="smr-update-settings-matches-reset" class="btn btn-danger btn-lg mr-3 " type="reset"><?php _e( 'Reset', 'slider-matches-results' ); ?></button>
                                <button id="smr-update-settings-matches-submit" class="btn btn-success btn-lg" type="submit" formmethod="post"><?php _e( 'Save', 'slider-matches-results' ); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
  </div>
</div>