<link href="<?php echo theme_url();?>/assets/jquery-ui/jquery-ui.css" rel="stylesheet">
<script src="<?php echo theme_url();?>/assets/jquery-ui/jquery-ui.js"></script>
<style>
    #form-map{
        background-color: #e5e3df;
        height: 200px;
        width: 100%;
    }
    #form-map img { max-width: none; }
</style>
<?php $state_active = get_settings('content_settings', 'show_state_province', 'yes'); ?>

<div class="page-heading-two">
    <div class="container">
        <div class="col-md-7">
            <h5><?php echo lang_key('post_ad');?> <span><?php echo lang_key('post_ad_subtitle');?></span></h5>
        </div>
        <div class="col-md-5">
        <div class="breads">
            <a href="<?php echo site_url(); ?>"><?php echo lang_key('home'); ?></a> / <?php echo lang_key('post_ad');?>
        </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">

        <form action="<?php echo site_url('create-ad');?>" method="post" role="form" class="form-horizontal">
        <div class="row">
            <?php echo $this->session->flashdata('msg');?>
            <?php if(isset($msg) && $msg!='') echo $msg;?>
            <div class="col-md-6 col-sm-6">
                <!-- Shopping items content -->
                <div class="shopping-content">
                    <div class="shopping-checkout">
                        <!-- Heading -->
                            <h4><?php echo lang_key('basic_info');?></h4>
                            <hr/>
                            <?php 
                            $CI = get_instance();
                            $CI->load->model('admin/system_model');
                            $langs = $CI->system_model->get_all_langs();
                            if(count($langs)>1)
                            {
                            ?>
                                
                            <div class="tabbable">
                                <ul class="nav nav-tabs" id="myTab2">
                                    <?php $flag=1; foreach ($langs as $lang=>$long_name){ 
                                        ?>
                                    <li class="<?php echo (get_current_lang()==$lang)?'active':'';?>"><a data-toggle="tab" href="#<?php echo $lang;?>-<?php echo $flag;?>"> <?php echo $lang;?></a></li>
                                    <?php $flag++; }?>
                                </ul>
                                <div class="tab-content" id="myTabContent2">
                                     <?php $flag=1; foreach ($langs as $lang=>$long_name){ 
                                     ?>
                                     <div id="<?php echo $lang;?>-<?php echo $flag;?>" class="tab-pane fade in <?php echo (get_current_lang()==$lang)?'active':'';?>">
                                    
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo lang_key('title');?></label>
                                            <div class="col-md-8">
                                                <?php $v = (set_value('title_'.$lang)!='')?set_value('title_'.$lang):'';?>
                                                <input type="text" name="title_<?php echo $lang;?>" placeholder="<?php echo lang_key('title');?>" value="<?php echo $v;?>" class="form-control">
                                                <?php echo form_error('title_'.$lang);?>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo lang_key('description');?></label>
                                            <div class="col-md-8">
                                                <?php $v = (set_value('description_'.$lang)!='')?set_value('description_'.$lang):'';?>
                                                <textarea rows="5" name="description_<?php echo $lang;?>" class="form-control rich"><?php echo $v;?></textarea>
                                                <?php echo form_error('description_'.$lang);?>
                                            </div>
                                        </div>

                                    
                                    </div>
                                    <?php $flag++; }?>
                                </div>
                            </div>

                            <?php 
                            }else{
                                $lang = default_lang();
                            ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><?php echo lang_key('title');?></label>
                                        <div class="col-md-8">
                                            <?php $v = (set_value('title_'.$lang)!='')?set_value('title_'.$lang):'';?>
                                            <input type="text" name="title_<?php echo $lang;?>" placeholder="<?php echo lang_key('title');?>" value="<?php echo $v;?>" class="form-control">
                                            <?php echo form_error('title_'.$lang);?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><?php echo lang_key('description');?></label>
                                        <div class="col-md-8">
                                            <?php $v = (set_value('description_'.$lang)!='')?set_value('description_'.$lang):'';?>
                                            <textarea rows="15" name="description_<?php echo $lang;?>" class="form-control rich"><?php echo $v;?></textarea>
                                            <?php echo form_error('description_'.$lang);?>
                                        </div>
                                    </div>

                            <?php
                            }
                            ?>
                                <div style="margin-top:20px"></div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for=""><?php echo lang_key('category');?></label>
                                <div class="col-md-8">
                                    <select name="category" class="form-control">
                                        <option value=""><?php echo lang_key('select_category');?></option>
                                        <?php foreach ($categories as $row) {
                                            $sub = ($row->parent!=0)?'--':'';
                                            $sel = (set_value('category')==$row->id)?'selected="selected"':'';
                                        ?>
                                            <option value="<?php echo $row->id;?>" <?php echo $sel;?>><?php echo $sub.lang_key($row->title);?></option>
                                        <?php
                                        }?>
                                    </select>
                                    <?php echo form_error('category');?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for=""><?php echo lang_key('brand');?></label>
                                <div class="col-md-8">
                                    <select name="brand" class="form-control" id="select-brand">
                                        <option value=""><?php echo lang_key('select_brand');?></option>
                                        <?php foreach ($brands->result() as $brand) {
                                          $sel = ($brand->id==set_value('brand'))?'selected="selected"':'';
                                          ?>
                                          <option value="<?php echo $brand->id;?>" <?php echo $sel;?>><?php echo lang_key($brand->name);?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('brand');?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for=""><?php echo lang_key('model');?></label>
                                <div class="col-md-8">
                                    <select name="model" class="form-control" id="select-model">
                                        <option value=""><?php echo lang_key('select_model');?></option>
                                        <?php foreach ($models->result() as $model) {
                                            $sel = ($model->id==set_value('model'))?'selected="selected"':'';
                                        ?>
                                            <option value="<?php echo $model->id;?>" <?php echo $sel;?>><?php echo lang_key($model->name);?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('model');?>
                                </div>
                            </div>

                            <?php
                              $this->load->helper('date');
                              $current_year =  mdate("%Y", time());
                            ?>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for=""><?php echo lang_key('year');?></label>
                                <div class="col-md-8">
                                    <select name="year" class="form-control">
                                        <option value=""><?php echo lang_key('select_year');?></option>
                                        <?php for($i=$current_year+1;$i>=1910;$i--){
                                            $sel = ($i==$v)?'selected="selected"':'';
                                        ?>
                                        <option value="<?php echo $i;?>" <?php echo $sel;?>><?php echo $i;?></option>
                                        <?php }?>
                                    </select>
                                    <?php echo form_error('year');?>
                                </div>
                            </div>
 
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang_key('price');?></label>
                            <div class="col-md-8">
                                <div class="input-group">
                                  <span class="input-group-addon"><?php echo $this->session->userdata('system_currency');?></span>
                                  <?php $v = (set_value('price')!='')?set_value('price'):'';?>
                                  <input id="price" type="text" name="price" placeholder="<?php echo lang_key('price');?>" value="<?php echo $v;?>" class="form-control">
                                </div>
                                <?php echo form_error('price');?>
                            </div>
                        </div>        

                        
                         <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label">&nbsp;</label>
                            <div class="checkbox col-md-8 col-sm-8 col-xs-8">
                                <label>
                                    <?php $chk = (isset($_POST['ask_for_price']) && $_POST['ask_for_price']=='1')?'checked="checked"':'';?>
                                    <input <?php echo $chk;?> type="checkbox" class="" value="1" name="ask_for_price">
                                    <?php echo lang_key('ask_for_price'); ?>
                                </label>
                            </div>
                        </div>
                      
                        <!-- end -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang_key('mileage');?></label>
                            <div class="col-md-8">
                                <?php $v = (set_value('mileage')!='')?set_value('mileage'):'';?>
                                <input id="mileage" type="text" name="mileage" placeholder="<?php echo lang_key('mileage');?>" value="<?php echo $v;?>" class="form-control">
                                <?php echo form_error('mileage');?>
                            </div>
                        </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for=""><?php echo lang_key('transmission');?></label>
                                <div class="col-md-8">
                                    <select name="transmission" class="form-control">
                                        <option value=""><?php echo lang_key('select_transmission');?></option>
                                        <?php foreach ($transmissions as $option) {
                                            $sel = ($option==set_value('transmission'))?'selected="selected"':'';
                                        ?>
                                            <option value="<?php echo $option;?>" <?php echo $sel;?>><?php echo lang_key($option);?></option>
                                        <?php } ?>

                                    </select>
                                    <?php echo form_error('transmission');?>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for=""><?php echo lang_key('condition');?></label>
                                <div class="col-md-8">
                                    <select name="condition" class="form-control">
                                        <option value=""><?php echo lang_key('select_condition');?></option>
                                        <?php foreach ($conditions as $option) {
                                            $sel = ($option==set_value('condition'))?'selected="selected"':'';
                                        ?>
                                            <option value="<?php echo $option;?>" <?php echo $sel;?>><?php echo lang_key($option);?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('condition');?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for=""><?php echo lang_key('fuel_type');?></label>
                                <div class="col-md-8">
                                    <select name="fuel_type" class="form-control">
                                        <option value=""><?php echo lang_key('select_fuel_type');?></option>
                                        <?php foreach ($fueltypes as $option) {
                                            $v = (set_value('fuel_type')!='')?set_value('fuel_type'):'';
                                            $sel = ($v==$option)?'selected="selected"':'';

                                        ?>
                                            <option value="<?php echo $option;?>" <?php echo $sel;?>><?php echo lang_key($option);?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('fuel_type');?>
                                </div>
                            </div>


                            
                        <h4><?php echo lang_key('address_info');?></h4>
                        <hr/>


                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang_key('phone');?></label>
                            <div class="col-md-8">
                                <?php $v = (set_value('phone_no')!='')?set_value('phone_no'):'';?>
                                <input id="phone_no" type="text" name="phone_no" placeholder="<?php echo lang_key('phone');?>" value="<?php echo $v;?>" class="form-control">
                                <?php echo form_error('phone_no');?>
                            </div>
                        </div>

                        <!-- added on version 1.6 -->
                        
                         <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label">&nbsp;</label>
                            <div class="checkbox col-md-8 col-sm-8 col-xs-8">
                                <label>
                                    <?php $chk = (isset($_POST['hide_phone']) && $_POST['hide_phone']=='1')?'checked="checked"':'';?>
                                    <input <?php echo $chk;?> type="checkbox" class="" value="1" name="hide_phone">
                                    <?php echo lang_key('hide_phone'); ?>
                                </label>
                            </div>
                        </div>
                        <!-- end -->

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo lang_key('email');?></label>
                            <div class="col-md-8">
                                <?php $v = (set_value('email')!='')?set_value('email'):'';?>
                                <input id="email" type="text" name="email" placeholder="<?php echo lang_key('email');?>" value="<?php echo $v;?>" class="form-control">
                                <?php echo form_error('email');?>
                            </div>
                        </div>

                         <!-- added on version 1.5 -->
                        
                         <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label">&nbsp;</label>
                            <div class="checkbox col-md-8 col-sm-8 col-xs-8">
                                <label>
                                    <?php $chk = (isset($_POST['hide_email']) && $_POST['hide_email']=='1')?'checked="checked"':'';?>
                                    <input <?php echo $chk;?> type="checkbox" class="" value="1" name="hide_email">
                                    <?php echo lang_key('hide_email'); ?>
                                </label>

                                <label>
                                    <?php $chk = (isset($_POST['disable_email_contact']) && $_POST['disable_email_contact']=='1')?'checked="checked"':'';?>                                    
                                    <input <?php echo $chk;?> data-day="<?php echo 1; ?>" type="checkbox" class="" value="1" name="disable_email_contact">
                                    <?php echo lang_key('disable_email_contact'); ?>
                                </label>

                            </div>
                        </div>

                        <?php if(get_settings('content_settings','disable_location','no')=='no'){?>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang_key('country');?></label>
                                <div class="col-md-8">
                                    <select name="country" id="country" class="form-control">
                                        <option data-name="" value=""><?php echo lang_key('select_country');?></option>
                                        <?php foreach (get_all_locations_by_type('country')->result() as $row) {
                                            $sel = ($row->id==set_value('country'))?'selected="selected"':'';
                                            ?>
                                            <option data-name="<?php echo $row->name;?>" value="<?php echo $row->id;?>" <?php echo $sel;?>><?php echo lang_key($row->name);?></option>
                                        <?php }?>
                                    </select>
                                    <?php echo form_error('country');?>
                                </div>
                            </div>
                        <?php if($state_active == 'yes'){ ?>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang_key('state');?></label>
                                <div class="col-md-8">
                                    <select name="state" id="state" class="form-control">
                                        
                                    </select>
                                    <?php echo form_error('state');?>
                                </div>
                            </div>
                        <?php } ?>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang_key('city');?></label>
                                <div class="col-md-8">
                                    <?php $city_field_type = get_settings('content_settings', 'city_dropdown', 'autocomplete'); ?>
                                    <input type="hidden" name="selected_city" id="selected_city" value="<?php echo(set_value('selected_city')!='')?set_value('selected_city'):'';?>">
                                    <?php if ($city_field_type=='dropdown') {?>
                                    <select name="city" id="city_dropdown" class="form-control">                                        
                                    </select>
                                    <?php }else {?>
                                    <input type="text" id="city" name="city" value="<?php echo(set_value('city')!='')?set_value('city'):'';?>" placeholder="<?php echo lang_key('city');?>" class="form-control" >
                                    <span class="help-inline city-loading">&nbsp;</span>
                                    <?php }?>
                                    <?php echo form_error('city');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang_key('zip_code');?></label>
                                <div class="col-md-8">
                                    <?php $v = (set_value('zip_code')!='')?set_value('zip_code'):'';?>
                                    <input type="text" name="zip_code" placeholder="<?php echo lang_key('zip_code');?>" value="<?php echo $v;?>" class="form-control">
                                    <?php echo form_error('zip_code');?>
                                </div>
                            </div>

                            <?php 
                            $CI = get_instance();
                            $CI->load->model('admin/system_model');
                            $langs = $CI->system_model->get_all_langs();
                            if(count($langs)>1)
                            {
                            ?>
                                
                            <div class="tabbable">
                                <ul class="nav nav-tabs" id="myTab1">
                                    <?php $flag=1; foreach ($langs as $lang=>$long_name){ 
                                        ?>
                                    <li class="<?php echo (get_current_lang()==$lang)?'active':'';?>"><a data-toggle="tab" href="#<?php echo $lang;?>"> <?php echo $lang;?></a></li>
                                    <?php $flag++; }?>
                                </ul>
                                <div class="tab-content" id="myTabContent1">
                                     <?php $flag=1; foreach ($langs as $lang=>$long_name){ 
                                     ?>
                                     <div id="<?php echo $lang;?>" class="tab-pane fade in <?php echo (get_current_lang()==$lang)?'active':'';?>">
                                    
                                        

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo lang_key('address');?></label>
                                            <div class="col-md-8">
                                                <?php $v = (set_value('address_'.$lang)!='')?set_value('address_'.$lang):'';?>
                                                <input type="text" id="address_<?php echo $lang;?>" name="address_<?php echo $lang;?>" placeholder="<?php echo lang_key('address');?>" value="<?php echo $v;?>" class="form-control">
                                                <?php echo form_error('address_'.$lang);?>
                                            </div>
                                        </div>


                                    
                                    </div>
                                    <?php $flag++; }?>
                                </div>
                            </div>
                            <?php 
                            }else{
                                $lang = default_lang();
                            ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang_key('address');?></label>
                                    <div class="col-md-8">
                                        <?php $v = (set_value('address_'.$lang)!='')?set_value('address_'.$lang):'';?>
                                        <input type="text" id="address_<?php echo $lang;?>" name="address_<?php echo $lang;?>" placeholder="<?php echo lang_key('address');?>" value="<?php echo $v;?>" class="form-control">
                                        <?php echo form_error('address_'.$lang);?>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php 
                            if(get_settings('banner_settings','disable_all_map','No')=='No'){
                            ?>
                            <div class="hr-divider"></div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-8">
                                    <a href="javascript:void(0)" class="btn btn-danger" onclick="codeAddress()"><i class="fa fa-map-marker"></i> <?php echo lang_key('view_on_map');?></a>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">&nbsp;</label>
                                <div class="col-md-8">
                                    <div id="form-map"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang_key('latitude');?></label>
                                <div class="col-md-8">
                                    <?php $v = (set_value('latitude')!='')?set_value('latitude'):'';?>
                                    <input id="latitude" type="text" name="latitude" placeholder="<?php echo lang_key('latitude');?>" value="<?php echo $v;?>" class="form-control">
                                    <?php echo form_error('latitude');?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang_key('longitude');?></label>
                                <div class="col-md-8">
                                    <?php $v = (set_value('longitude')!='')?set_value('longitude'):'';?>
                                    <input id="longitude" type="text" name="longitude" placeholder="<?php echo lang_key('longitude');?>" value="<?php echo $v;?>" class="form-control">
                                    <?php echo form_error('longitude');?>
                                </div>
                            </div>                  
                            <?php 
                            }
                        }
                            ?>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">

                <h4><?php echo lang_key('general_info');?></h4>
                <hr/>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo lang_key('url_slug');?></label>
                    <div class="col-md-8">
                        <?php $v = (set_value('url_slug')!='')?set_value('url_slug'):'';?>
                        <input id="url_slug" type="text" name="url_slug" placeholder="<?php echo lang_key('help_url_slug');?>" value="<?php echo $v;?>" class="form-control">
                        <?php echo form_error('url_slug');?>
                    </div>
                </div>   

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo lang_key('tags');?></label>
                    <div class="col-md-8">
                        <?php $v = (set_value('tags')!='')?set_value('tags'):'';?>
                        <textarea rows="15" name="tags" class="form-control tag-input"><?php echo $v;?></textarea>
                        <span><?php echo lang_key('put_as_comma_seperated')?></span>
                        <?php echo form_error('tags');?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo lang_key('featured_image');?></label>
                    <div class="col-md-8">
                        <div class="featured-img">
                            <?php $v = (set_value('featured_img')!='')?set_value('featured_img'):'';?>
                            <input type="hidden" name="featured_img" id="featured-img-input" value="<?php echo $v;?>">
                            <img id="featured-img" src="<?php echo base_url('uploads/images/no-image.png');?>">
                            <div class="upload-button"><?php echo lang_key('upload');?></div>
                            <?php echo form_error('featured_img');?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo lang_key('video_url');?></label>
                    <div class="col-md-8">
                        <?php $v = (set_value('video_url')!='')?set_value('video_url'):"";?>
                        <span id="video_preview"></span>
                        <input id="video_url" type="text" name="video_url" placeholder="<?php echo lang_key('video_url');?>" value="<?php echo $v;?>" class="form-control">
                        <span class="help-inline"><?php echo lang_key('video_notes');?></span>
                        <?php echo form_error('video_url');?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo lang_key('gallery');?></label>
                    <div class="col-md-8">
                        <?php $tmp_gallery = (isset($post->gallery))?json_decode($post->gallery):array();?>
                        <?php $gallery = (isset($_POST['gallery']))?$_POST['gallery']:$tmp_gallery;?>
                        <ul class="multiple-uploads">
                            <?php foreach ($gallery as $item) {
                            ?>
                            <li class="gallery-img-list" style="margin:10px 10px 0 0;overflow:hidden">
                              <input type="hidden" name="gallery[]" value="<?php echo $item;?>" />
                              <img src="<?php echo base_url('uploads/gallery/'.$item);?>"   style="height:100%" />
                              <div style="clear:both"></div>
                              <div class="remove-image" onclick="removeImage(this);" img="<?php echo $item;?>">X</div>
                            </li>
                            <?php }?>
                            <li class="add-image" id="dragandrophandler">+</li>
                        </ul>       
                        <div class="clearfix"></div>
                        <span class="gallery-upload-instruction"><?php echo lang_key('gallery_notes');?></span>
                        <div class="clearfix clear-top-margin"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo lang_key('brochure');?></label>
                    <div class="col-md-8">
                        <div class="brochure">
                            <?php $v = (set_value('brochure')!='')?set_value('brochure'):'';?>
                            <input type="hidden" name="brochure" id="brochure-input" value="<?php echo $v;?>">
                            <div>
                            <div class="logo-upload-button btn btn-primary"><i class="fa fa-upload"></i> <?php echo lang_key('upload_brochure');?></div>                            
                            <div class="clearfix" style="margin-top:10px;"></div>
                            <span class="alert alert-info" id="brochure"><?php echo lang_key('none');?></span>
                            <a href="#" class="clear-brochure">X</a>
                            </div>
                            <div class="clearfix"></div>
                            <?php echo form_error('brochure');?>
                        </div>
                    </div>
                </div>
                      
                <h4><?php echo lang_key('optional_info');?></h4>
                <hr/>

                <?php foreach ($fields->result() as $field) {
                    echo render_custom_field($field);
                }?>

                <?php if(get_settings('package_settings','enable_pricing','No')=='Yes'){?>
                <div class="form-group">
                    <label class="col-md-3 control-label" style="padding:10px 0;"><?php echo lang_key('selected_package');?></label>
                    <div class="col-md-8">
                        <?php 
                        $CI = get_instance();
                        $CI->load->model('admin/package_model');
                        $package  = $CI->package_model->get_package_by_id($this->session->userdata('selected_package'));
                        ?>
                        <div class="clearfix" style="margin-top:5px;"></div>
                    
                        <div class="alert alert-info" style="padding:10px;font-weight:bold">
                            <?php echo lang_key($package->title);?><br/>
                            <?php echo lang_key('price');?> : <?php echo show_package_price($package->price);?><br/>
                            <?php echo lang_key('expiration_time');?> : <?php echo $package->expiration_time;?> <?php echo lang_key('days'); ?> 
                        </div>
                        <div class="clearfix" style="margin-top:5px;"></div>
                        <a class="btn btn-warning" href="<?php echo site_url('choose-package');?>" class=""> &lt;&lt; <?php echo lang_key('change_package');?></a>
                    </div>
                </div>
                <?php }?>

                <?php if(is_admin()){?>
                <hr/>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputEmail1"><?php echo lang_key('assigned_to');?></label>
                    <div class="col-md-8">
                        <select name="assigned_to" class="form-control">
                            <option value=""><?php echo lang_key('select_assigned_to');?></option>
                            <?php foreach (get_all_users() as $user) {
                                $v = (set_value('assigned_to')!='')?set_value('assigned_to'):$post->created_by;
                                $sel = ($v==$user->id)?'selected="selected"':'';
                            ?>
                                <option value="<?php echo $user->id;?>" <?php echo $sel;?>><?php echo get_user_fullname_from_user($user);?></option>
                            <?php
                            }?>
                        </select>
                        <?php echo form_error('assigned_to');?>
                    </div>
                </div>
                <?php }?>    
                
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <hr>
                <div class="form-group" style="text-align:center">
                    <button class="btn btn-success" type="submit"><?php echo lang_key('save');?></button>
                    <button class="btn btn-default" type="reset"><?php echo lang_key('reset');?></button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php 
if(get_settings('banner_settings','disable_all_map','No')=='No'){
?>
<?php
$map_api_key    = get_settings('banner_settings','map_api_key','');
$api_key_text   = ($map_api_key!='')?"&key=$map_api_key":'';
?>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&amp;libraries=places<?php echo $api_key_text;?>"></script>
<script src="<?php echo theme_url();?>/assets/js/markercluster.min.js"></script>
<script src="<?php echo theme_url();?>/assets/js/map-icons.min.js"></script>
<script src="<?php echo theme_url();?>/assets/js/map_config.js"></script>
<?php 
}
?>

<script src="<?php echo theme_url();?>/assets/js/jquery.form.js"></script>
<?php require'multiple-uploader.php';?>
<?php require'bulk_uploader_view.php';?>


<script type="text/javascript">
jQuery(document).ready(function(){

    $('input[name="title_<?php echo default_lang();?>"]').keyup(function(){
        var val = $(this).val();
        val = val.replace(/[^a-zA-Z ]/g, "");
        val = val.replace(/\s+/g, '-').toLowerCase();
        val = val.replace(" ", '-').toLowerCase();

        var slug_val = $('input[name=url_slug]').val();
        $('input[name=url_slug]').val(val);
    });


    $('select[name=category]').change(function(){
        var cat_id = $('select[name=category] > option:selected').val();
        if(cat_id=='')
        {
            $('.custom-fields').hide();
            $('.cat-all').show();
        }
        else
        {
            $('.custom-fields').hide();
            $('.cat-all').show();
            $('.cat-'+cat_id).show();            
        }
        
    }).change();

    var sel_model = '<?php echo (set_value("model")!='')?set_value("model"):"";?>';

    jQuery('#select-brand').change(function(){
        var val = jQuery(this).val();
        jQuery.post(
            "<?php echo site_url('show/get_models_ajax');?>/",
            {brand: val},
            function(html){
                
                jQuery('#select-model').empty();
                jQuery('#select-model').html(html);
                jQuery('#select-model').val(sel_model);
                //console.log(options);
            },
            "html"
        );
    }).change();

    var city_field_type =  '<?php echo get_settings("content_settings", "city_dropdown", "autocomplete"); ?>' ;
    jQuery('#video_url').change(function(){
        var url = jQuery(this).val();
        showVideoPreview(url);
    }).change();

    function getUrlVars(url) {
        var vars = {};
        var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }

    function showVideoPreview(url)
    {
        if(url.search("youtube.com")!=-1)
        {
            var video_id = getUrlVars(url)["v"];
            //https://www.youtube.com/watch?v=jIL0ze6_GIY
            var src = '//www.youtube.com/embed/'+video_id;
            //var src  = url.replace("watch?v=","embed/");
            var code = '<iframe class="thumbnail" width="100%" height="200" src="'+src+'" frameborder="0" allowfullscreen></iframe>';
            jQuery('#video_preview').html(code);
        }
        else if(url.search("vimeo.com")!=-1)
        {
            //http://vimeo.com/64547919
            var segments = url.split("/");
            var length = segments.length;
            length--;
            var video_id = segments[length];
            var src  = url.replace("vimeo.com","player.vimeo.com/video");
            var code = '<iframe class="thumbnail" src="//player.vimeo.com/video/'+video_id+'" width="100%" height="200" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
            jQuery('#video_preview').html(code);
        }
        else
        {
            //alert("only youtube and video url is valid");
        }
    }

    jQuery('#contact_for_price').click(function(){
        show_hide_price();
    });
    show_hide_price();

    jQuery('.upload-button').click(function(){
        jQuery('#photoimg_featured').click();
    });

    jQuery('#featured-img-input').change(function(){
        var val = jQuery(this).val();
        if(val=='')
        {
            val = 'no-image.png';
        }

        var base_url  = '<?php echo base_url();?>';
        var image_url = base_url+'uploads/thumbs/'+val;
        jQuery( '#featured-img' ).attr('src',image_url);

    }).change();


    jQuery('#photoimg').attr('target','.multiple-uploads');
    jQuery('#photoimg').attr('input','gallery');
    var obj = $("#dragandrophandler");
    obj.on('dragenter', function (e)
    {
        e.stopPropagation();
        e.preventDefault();
        $(this).css('border', '2px solid #0B85A1');
    });

    obj.on('dragover', function (e)
    {
         e.stopPropagation();
         e.preventDefault();
    });

    obj.on('drop', function (e)
    {
         $(this).css('border', '2px dotted #0B85A1');
         e.preventDefault();
         var files = e.originalEvent.dataTransfer.files;

         var curr_photo_count = jQuery('.multiple-uploads').children().length-1;
         var max = '<?php echo (isset($package->max_gallery_photos))?$package->max_gallery_photos:5;?>';

         if(files.length>(max-curr_photo_count))
         {
            var msg = "<?php echo lang_key('you_can_upload_max');?> "+max+" <?php echo lang_key('gallery_photos');?>";
            alert(msg);
         }
         else
             handleFileUpload(files,obj);
    });

    $(document).on('dragenter', function (e)
    {
        e.stopPropagation();
        e.preventDefault();
    });

    $(document).on('dragover', function (e)
    {
      e.stopPropagation();
      e.preventDefault();
      obj.css('border', '2px dotted #0B85A1');
    });
    
    $(document).on('drop', function (e)
    {
        e.stopPropagation();
        e.preventDefault();
    });

    jQuery('.multiple-uploads > .add-image').click(function(){
        jQuery('#photoimg').attr('target','.multiple-uploads');
        jQuery('#photoimg').attr('input','gallery');
        jQuery('#photoimg').click();
    });

    jQuery( ".multiple-uploads" ).sortable();

    jQuery('.logo-upload-button').click(function(){
        jQuery('#photoimg_logo').click();
    });

    jQuery('#brochure-input').change(function(){
        var val = jQuery(this).val();
        if(val=='')
        {
            val = 'N/A';
        }

        var base_url  = '<?php echo base_url();?>';
        var image_url = base_url+'uploads/brochure/'+val;
        jQuery( '#brochure' ).html('<a href="'+image_url+'">'+val+'</a>');

    }).change();

    jQuery('.clear-brochure').click(function(e){
        e.preventDefault();
        jQuery('#brochure-input').val('');
        jQuery('#brochure-input').trigger('change');
    });

    var site_url = '<?php echo site_url();?>';
    jQuery('#country').change(function(){
        var val = jQuery(this).val();        
        var loadUrl = site_url+'/show/get_locations_by_parent_ajax/'+val;
        jQuery.post(
            loadUrl,
            {},
            function(responseText){
                <?php if($state_active=='yes'){?>
                jQuery('#state').html(responseText);
                var sel_country = '<?php echo (set_value("country")!='')?set_value("country"):'';?>';
                var sel_state   = '<?php echo (set_value("state")!='')?set_value("state"):'';?>';
                if(val==sel_country)
                jQuery('#state').val(sel_state);
                else
                jQuery('#state').val('');
                jQuery('#state').focus();
                jQuery('#state').trigger('change');
                <?php }else{?>
                var sel_country = '<?php echo (set_value("country")!='')?set_value("country"):'';?>';
                var sel_city   = '<?php echo (set_value("selected_city")!='')?set_value("selected_city"):'';?>';
                var city   = '<?php echo (set_value("city")!='')?set_value("city"):'';?>';
                if(city_field_type=='dropdown')
                populate_city(val); //populate the city drop down
                if(val==sel_country)
                {
                    jQuery('#selected_city').val(sel_city);
                    jQuery('#city').val(city);
                }
                else
                {
                    jQuery('#selected_city').val(sel_city);
                    jQuery('#city').val('');            
                }
                <?php }?>

            }
        );
     }).change();

    jQuery('#state').change(function(){
        <?php if($state_active=='yes'){?>
        var val = jQuery(this).val();
        var sel_state   = '<?php echo (set_value("state")!='')?set_value("state"):'';?>';
        var sel_city   = '<?php echo (set_value("selected_city")!='')?set_value("selected_city"):'';?>';
        var city   = '<?php echo (set_value("city")!='')?set_value("city"):'';?>';
        
        if(city_field_type=='dropdown')
            populate_city(val);

        if(val==sel_state)
        {
            jQuery('#selected_city').val(sel_city);
            jQuery('#city').val(city);
        }
        else
        {
            jQuery('#selected_city').val('');
            jQuery('#city').val('');            
        }
        <?php }?>

    });

    <?php if($state_active == 'yes'){ ?>
        var parent = '#state';
    <?php } else { ?>
        var parent = '#country';
    <?php } ?>

    if(city_field_type=='autocomplete') {
        jQuery( "#city" ).bind( "keydown", function( event ) {
            if ( event.keyCode === jQuery.ui.keyCode.TAB &&
                jQuery( this ).data( "ui-autocomplete" ).menu.active ) {
                event.preventDefault();
            }
        })
            .autocomplete({
                source: function( request, response ) {

                    jQuery.post(
                        "<?php echo site_url('show/get_cities_ajax');?>/",
                        {term: request.term,parent: jQuery(parent).val()},
                        function(responseText){
                            response(responseText);
                            jQuery('#selected_city').val('');
                            jQuery('.city-loading').html('');
                        },
                        "json"
                    );
                },
                search: function() {
                    // custom minLength
                    var term = this.value ;
                    if ( term.length < 2 || jQuery(parent).val()=='') {
                        return false;
                    }
                    else
                    {
                        jQuery('.city-loading').html('Loading...');
                    }
                },
                focus: function() {
                    // prevent value inserted on focus
                    return false;
                },
                select: function( event, ui ) {
                    this.value = ui.item.value;
                    jQuery('#selected_city').val(ui.item.id);
                    jQuery('.city-loading').html('');
                    return false;
                }
            });
    }
    else if(city_field_type=='dropdown') {
        jQuery('#city_dropdown').change(function (){
            var val = jQuery('option:selected', this).attr('city_id');
            jQuery('#selected_city').val(val);
        });
    }

});
function show_hide_price()
{
    var val = jQuery('#contact_for_price').attr('checked');
    if(val=='checked')
    {
        jQuery('.price-input-holder').hide();
    }
    else
    {
        jQuery('.price-input-holder').show();        
    }
}

function populate_city(parent) {
    var site_url = '<?php echo site_url();?>';
    var loadUrl = site_url+'/show/get_city_dropdown_by_parent_ajax/'+parent;
        jQuery.post(
            loadUrl,
            {},
            function(responseText){
                jQuery('#city_dropdown').html(responseText);
                var sel_city   = '<?php echo (set_value("city")!='')?set_value("city"):'';?>';
                jQuery('#city_dropdown').val(sel_city);
            }
        );
}

function removeImage(e){

      var img_e =  e;
      var img = jQuery(e).attr('img');
      jQuery.post(
          "<?php echo site_url('admin/content/remove_unused_gallery_img');?>/",
          {name:img},
          function(responseText){
            jQuery(img_e).parent().remove();
          },
          "html"
      );

}
</script>

<script type="text/javascript" src="<?php echo base_url('assets/tinymce/tinymce.min.js');?>"></script>
<script type="text/javascript">
tinymce.init({
    convert_urls : 0,
    selector: ".rich",
    menubar: false,
    toolbar: "styleselect | bold | link | bullist | code | fullscreen",
    language_url : '<?php echo get_tinymce_translate_url();?>',
    plugins: [

         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",

         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",

         "save code table contextmenu directionality emoticons template paste textcolor"

   ]

 });
</script>

<?php 
if(get_settings('banner_settings','disable_all_map','No')=='No'){
?>
<script type="text/javascript">
    var markers = [];
    function initialize() {
        
        geocoder = new google.maps.Geocoder();
        var mapOptions = {
            center: new google.maps.LatLng(-34.397, 150.644),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: MAP_STYLE
        };
        map = new google.maps.Map(document.getElementById("form-map"),mapOptions);

        var ex_latitude = $('#latitude').val();
        var ex_longitude = $('#longitude').val();

        if (ex_latitude != '' && ex_longitude != ''){
            map.setCenter(new google.maps.LatLng(ex_latitude, ex_longitude));//center the map over the result
            var marker = new google.maps.Marker(
                {
                    map: map,
                    draggable:true,
                    animation: google.maps.Animation.DROP,
                    position: new google.maps.LatLng(ex_latitude, ex_longitude)
                });

            markers.push(marker);
            google.maps.event.addListener(marker, 'dragend', function()
            {
                var marker_positions = marker.getPosition();
                $('#latitude').val(marker_positions.lat());
                $('#longitude').val(marker_positions.lng());
            });

        }

    }

    function codeAddress()
    {
        var city_field_type =  '<?php echo get_settings("content_settings", "city_dropdown", "autocomplete"); ?>' ;

        var lang = '<?php echo get_current_lang();?>';
        var main_address = $('#address_'+lang).val();
        var country = $('#country').find(':selected').data('name');
        var state = $('#state').find(':selected').data('name');

        if(city_field_type=='autocomplete') {
            var city = $('#city').val();
        }
        else
        {
            var city = $('#city_dropdown').find(':selected').data('name');;
        }
        
        <?php if($state_active == 'yes'){ ?>
            var address = [main_address, city, state, country].join();
        <?php } else { ?>
            var address = [main_address, city, country].join();
        <?php } ?>


        if(country != '' && city != '')
        {


            setAllMap(null); //Clears the existing marker

            geocoder.geocode( {address:address}, function(results, status)
            {
                if (status == google.maps.GeocoderStatus.OK)
                {
                    $('#latitude').val(results[0].geometry.location.lat());
                    $('#longitude').val(results[0].geometry.location.lng());
                    map.setCenter(results[0].geometry.location);//center the map over the result


                    //place a marker at the location
                    var marker = new google.maps.Marker(
                        {
                            map: map,
                            draggable:true,
                            animation: google.maps.Animation.DROP,
                            position: results[0].geometry.location
                        });

                    markers.push(marker);


                    google.maps.event.addListener(marker, 'dragend', function()
                    {
                        var marker_positions = marker.getPosition();
                        $('#latitude').val(marker_positions.lat());
                        $('#longitude').val(marker_positions.lng());
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });

        }
        else{
            alert('<?php echo lang_key("atleast_a_country_city");?>');
        }

    }

    function setAllMap(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php 
}
?>