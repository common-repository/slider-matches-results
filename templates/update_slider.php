<div id='smr' class="wrap">
    <div class="row">
        <div class="col-xl mt-1 mb-1">
            <h1> SMR - <?php _e( 'Update slider', 'slider-matches-results' ); ?></h1>
        </div>
    </div>
    <div id="smr-update-slider" class="row mt-3">
        <div class="col-12">
            <form id="smr-form-update-slider" role="form">
                <div class="col-xl mt-1 mb-1">
                    <div class="form-group row mb-2">
                        <div class="col-12">     
                            <a class="btn btn-primary btn-lg" href='<?php echo admin_url( 'admin.php?page=smr_plugin_sliders' ); ?>'><?php _e( 'My sliders', 'slider-matches-results' ); ?></a>
                            <button class="smr-update-slider-submit btn btn-success btn-lg float-right" type="submit" formmethod="post"><?php _e( 'Update slider', 'slider-matches-results' ); ?></button>
                            <button class="smr-update-slider-reset btn btn-danger btn-lg mr-3 float-right" type="reset"><?php _e( 'Reset', 'slider-matches-results' ); ?></button>
                        </div>
                    </div>
                    <div id="smr-alert-update-error" class="alert alert-danger mt-4 d-none " role="alert"><?php _e( 'Fields with a red border are required', 'slider-matches-results' ); ?></div>
                    <div class="alert alert-success mt-4 <?php if( !$this->is_state_active( $state_active, "create_success" ) ){ echo 'd-none'; }?>" role="alert"><?php _e( 'Your slider has been successfully created', 'slider-matches-results' ); ?></div>
                    <div class="alert alert-success mt-4 <?php if( !$this->is_state_active( $state_active, "update_success" ) ){ echo 'd-none'; }?>" role="alert"><?php _e( 'Your slider has been successfully updated', 'slider-matches-results' ); ?></div>

                    <input type="hidden" name="smr-form-update-slider">
                    <input type="hidden" name="smr-update-slider-id" value="<?php echo $slider->get_id(); ?>">

                    <div class="col-xl pb-2 mb-2 mt-4 border-bottom border-primary">
                        <h2> <?php _e( 'Slider', 'slider-matches-results' ); ?> </h2>
                    </div>
                    <div class="col-xl mt-4">
                        <div class="form-group row">
                            <label for="smr-update-slider-name" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Name', 'slider-matches-results' ); ?></label>
                            <div class="col-8 input-group">
                                <input id="smr-update-slider-name" type="text" class="form-control input-lg" name="smr-update-slider-name" value="<?php echo $slider->get_name(); ?>"/>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="smr-update-slider-shortcode" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Shortcode', 'slider-matches-results' ); ?></label>
                            <div class="col-8 input-group">
                                <input id="smr-update-slider-shortcode" type="text" class="form-control input-lg" name="smr-update-slider-shortcode" value="<?php echo $slider->get_shortcode(); ?>" disabled/>
                            </div>
                        </div> 
                    </div>
                    <div class="col-xl pb-2 mb-2 mt-4 border-bottom border-primary">
                        <h2> <?php _e( 'Header', 'slider-matches-results' ); ?> </h2>
                    </div>
                    <div class="col-xl mt-4">
                        <div class="col-xl">
                            <div class="form-group row">
                                <label for="smr-update-slider-header-date-text-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Date', 'slider-matches-results' ); - _e( 'Text color', 'slider-matches-results' ); ?></label>
                                <div id="smr-update-slider-header-date-text-color-group" class="col-8 input-group">
                                    <input id="smr-update-slider-header-date-text-color" type="text" class="form-control input-lg" name="smr-update-slider-header-date-text-color" value="<?php echo $settings_slider_header->get_date_text_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-update-slider-header-date-background-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Date', 'slider-matches-results' ); - _e( 'Background color', 'slider-matches-results' ); ?></label>
                                <div id="smr-update-slider-header-date-background-color-group" class="col-8 input-group">
                                    <input id="smr-update-slider-header-date-background-color" type="text" class="form-control input-lg" name="smr-update-slider-header-date-background-color" value="<?php echo $settings_slider_header->get_date_background_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-update-slider-header-title-text-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Title', 'slider-matches-results' ); ?> - <?php _e( 'Text color', 'slider-matches-results' ); ?> </label>
                                <div id="smr-update-slider-header-title-text-color-group" class="col-8 input-group">
                                    <input id="smr-update-slider-header-title-text-color" type="text" class="form-control input-lg" name="smr-update-slider-header-title-text-color" value="<?php echo $settings_slider_header->get_title_text_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-update-slider-header-title-background-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Title', 'slider-matches-results' ); ?> - <?php _e( 'Background color', 'slider-matches-results' ); ?></label>
                                <div id="smr-update-slider-header-title-background-color-group" class="col-8 input-group">
                                    <input id="smr-update-slider-header-title-background-color" type="text" class="form-control input-lg" name="smr-update-slider-header-title-background-color" value="<?php echo $settings_slider_header->get_title_background_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>  


                    <div class="col-xl pb-2 mb-2 border-bottom border-primary">
                        <h2> <?php _e( 'Content', 'slider-matches-results' ); ?> </h2>
                    </div>
                    <div class="col-xl mt-4">

                        <div class="col-xl">
                            <div class="form-group row">
                                <label for="smr-update-slider-content-text-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Text color', 'slider-matches-results' ); ?></label>
                                <div id="smr-update-slider-content-text-color-group" class="col-8 input-group">
                                    <input id="smr-update-slider-content-text-color" type="text" class="form-control input-lg" name="smr-update-slider-content-text-color" value="<?php echo $settings_slider_content->get_text_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-update-slider-content-background-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Background color', 'slider-matches-results' ); ?></label>
                                <div id="smr-update-slider-content-background-color-group" class="col-8 input-group">
                                    <input id="smr-update-slider-content-background-color" type="text" class="form-control input-lg" name="smr-update-slider-content-background-color" value="<?php echo $settings_slider_content->get_background_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-update-slider-content-max-width-logo" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Max width logo', 'slider-matches-results' ); ?></label>
                                <div id="smr-update-slider-content-max-width-logo-group" class="col-8 input-group">
                                    <input id="smr-update-slider-content-max-width-logo" type="text" class="form-control input-lg" name="smr-update-slider-content-max-width-logo" value="<?php echo $settings_slider_content->get_max_width_logo(); ?>"/>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="col-xl pb-2 mb-2 border-bottom border-primary">
                        <h2> <?php _e( 'Footer', 'slider-matches-results' ); ?> </h2>
                    </div>
                    <div class="col-xl mt-4">
                        <div class="col-xl">
                            <div class="form-group row">
                                <label for="smr-update-slider-footer-display-footer" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Display footer', 'slider-matches-results' ); ?></label>
                                <div class="col-8">
                                    <div class="custom-switch custom-switch-label-onoff">
                                        <input class="custom-switch-input" id="smr-update-slider-footer-display-footer" name="smr-update-slider-footer-display-footer" type="checkbox" <?php if( $settings_slider_footer->get_display_footer() ){ echo 'checked'; } ?>>
                                        <label class="custom-switch-btn" for="smr-update-slider-footer-display-footer"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-update-slider-footer-text-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Text color', 'slider-matches-results' ); ?></label>
                                <div id="smr-update-slider-footer-text-color-group" class="col-8 input-group">
                                    <input id="smr-update-slider-footer-text-color" type="text" class="form-control input-lg" name="smr-update-slider-footer-text-color" value="<?php echo $settings_slider_footer->get_text_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smr-update-slider-footer-background-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Background color', 'slider-matches-results' ); ?></label>
                                <div id="smr-update-slider-footer-background-color-group" class="col-8 input-group">
                                    <input id="smr-update-slider-footer-background-color" type="text" class="form-control input-lg" name="smr-update-slider-footer-background-color" value="<?php echo $settings_slider_footer->get_background_color(); ?>"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl pb-2 mb-2 border-bottom border-primary">
                        <h2> Slide </h2>
                    </div>
                    <div class="col-xl mt-4">

                        <input type="hidden" name="smr-update-slider-slide-slides-to-show" value="<?php echo $settings_slide->get_slides_to_show(); ?>">
                        <input type="hidden" name="smr-update-slider-slide-slides-to-scroll" value="<?php echo $settings_slide->get_slides_to_scroll(); ?>">
                        <input type="hidden" name="smr-update-slider-slide-adaptative-height" value="<?php echo $settings_slide->get_adaptative_height() ? 'true' : 'false'; ?>">


                        <div class="form-group row">
                            <label for="smr-update-slider-slide-infinite" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Infinite', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-update-slider-slide-infinite" name="smr-update-slider-slide-infinite" type="checkbox" <?php if( $settings_slide->get_infinite() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-update-slider-slide-infinite"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-update-slider-slide-dots" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Dots', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-update-slider-slide-dots" name="smr-update-slider-slide-dots" type="checkbox" <?php if( $settings_slide->get_dots() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-update-slider-slide-dots"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-update-slider-slide-dots-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Dots', 'slider-matches-results' ); ?> - <?php _e( 'Color', 'slider-matches-results' ); ?></label>
                            <div id="smr-update-slider-slide-dots-color-group" class="col-8 input-group">
                                <input id="smr-update-slider-slide-dots-color" type="text" class="form-control input-lg" name="smr-update-slider-slide-dots-color" value="<?php echo $settings_slide->get_dots_color();?>" <?php if(!$settings_slide->get_dots()){ echo 'disabled'; }?> />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-update-slider-slide-autoplay" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Autoplay', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-update-slider-slide-autoplay" name="smr-update-slider-slide-autoplay" type="checkbox" <?php if( $settings_slide->get_autoplay() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-update-slider-slide-autoplay"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-update-slider-slide-autoplay-speed" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Autoplay', 'slider-matches-results' ); ?> - <?php _e( 'Speed', 'slider-matches-results' ); ?> (ms)</label>
                            <div class="col-8 input-group">
                                <input id="smr-update-slider-slide-autoplay-speed" type="text" class="form-control input-lg" name="smr-update-slider-slide-autoplay-speed" value="<?php echo $settings_slide->get_autoplay_speed(); ?>" <?php if( !$settings_slide->get_autoplay() ){ echo 'disabled'; } ?>/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-update-slider-slide-arrows" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Arrows', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-update-slider-slide-arrows" name="smr-update-slider-slide-arrows" type="checkbox" <?php if( $settings_slide->get_arrows() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-update-slider-slide-arrows"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-update-slider-slide-arrows-color" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Arrows', 'slider-matches-results' ); ?> - <?php _e( 'Color', 'slider-matches-results' ); ?></label>
                            <div id="smr-update-slider-slide-arrows-color-group" class="col-8 input-group">
                                <input id="smr-update-slider-slide-arrows-color" type="text" class="form-control input-lg" name="smr-update-slider-slide-arrows-color"  value="<?php echo $settings_slide->get_arrows_color();?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-update-slider-slide-arrows-in" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Arrows in slider', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-update-slider-slide-arrows-in" name="smr-update-slider-slide-arrows-in" type="checkbox" <?php if( $settings_slide->get_arrows_in() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-update-slider-slide-arrows-in"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-update-slider-slide-fade" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Transition', 'slider-matches-results' ); ?> - <?php _e( 'Fade', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-update-slider-slide-fade" name="smr-update-slider-slide-fade" type="checkbox" <?php if( $settings_slide->get_fade() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-update-slider-slide-fade"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-update-slider-slide-transition-type" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Transition', 'slider-matches-results' ); ?> - <?php _e( 'Type', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <select id="smr-update-slider-slide-transition-type" class="form-control form-control-chosen-required" data-placeholder="Please select..." name="smr-update-slider-slide-transition-type">
                                    <?php foreach( get_settings_transition_type() as $setting_transition_type ){ ?>
                                    <option <?php if( $settings_slide->get_transition_type() == $setting_transition_type ){ echo 'selected'; } ?> value="<?php echo $setting_transition_type; ?>"><?php echo $setting_transition_type; ?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-update-slider-slide-transition-speed" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Transition', 'slider-matches-results' ); ?> - <?php _e( 'Speed', 'slider-matches-results' ); ?> (ms)</label>
                            <div class="col-8 input-group">
                                <input id="smr-update-slider-slide-transition-speed" type="text" class="form-control input-lg" name="smr-update-slider-slide-transition-speed" value="<?php echo $settings_slide->get_transition_speed(); ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="smr-update-slider-slide-swipe" class="col-4 col-form-label col-form-label-lg"><?php _e( 'Swipe', 'slider-matches-results' ); ?></label>
                            <div class="col-8">
                                <div class="custom-switch custom-switch-label-onoff">
                                    <input class="custom-switch-input" id="smr-update-slider-slide-swipe" name="smr-update-slider-slide-swipe" type="checkbox" <?php if( $settings_slide->get_swipe() ){ echo 'checked'; } ?>>
                                    <label class="custom-switch-btn" for="smr-update-slider-slide-swipe"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <button id="smr-update-settings-slider-slide-show" class="btn btn-primary btn-lg" type="button"><?php _e( 'Show slide animation', 'slider-matches-results' ); ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl mt-4">
                        <div id="smr-update-settings-slider-slide-example" class="col-4 mx-auto p-0">
                            <div class="smr-update-settings-slider-slide-example-div">1</div>
                            <div class="smr-update-settings-slider-slide-example-div">2</div>
                            <div class="smr-update-settings-slider-slide-example-div">3</div>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <div class="col-12">                        
                            <button class="smr-update-slider-submit btn btn-success btn-lg float-right" type="submit" formmethod="post"><?php _e( 'Update slider', 'slider-matches-results' ); ?></button>
                            <button class="smr-update-slider-reset btn btn-danger btn-lg mr-3 float-right" type="reset"><?php _e( 'Reset', 'slider-matches-results' ); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
  </div>
</div>