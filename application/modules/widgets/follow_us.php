<h5 class="bold"><i class="fa fa-user"></i>  About</h5>
                    <p><i>You can edit this section from admin panel > widgets > all widgets > follow us > edit </i></p>
                    <div class="brand-bg">
                        <!-- Social Media Icons -->
                        <a class="facebook" href="https://www.facebook.com/webhelios"><i class="fa fa-facebook circle-3"></i></a>
                        <a class="twitter" target="_blank" href="https://twitter.com/webheliosteam"><i class="fa fa-twitter circle-3"></i></a>
                        <a class="google-plus" href="#"><i class="fa fa-google-plus circle-3"></i></a>
                        <a class="linkedin" href="#"><i class="fa fa-linkedin circle-3"></i></a>
                        <a class="pinterest" href="#"><i class="fa fa-pinterest circle-3"></i></a>
                        <a class="pinterest" href="<?php echo site_url('show/rss');?>"><i class="fa fa-feed circle-3"></i></a>
                    </div>

<div class="clearfix" style="height: 0px"></div>
<?php if(@file_exists('./sitemap.xml')){?>
    <h5 class="widget-title"><?php echo lang_key('site_map');?></h5>
    <a href="<?php echo site_url('show/sitemap')?>"><?php echo lang_key('show_site_map');?></a>
<?php }?>
