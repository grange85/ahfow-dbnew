<div id="content_left">
    <h2>Home</h2>


    <?php foreach ($artist_list as $artist):?>
    <div class="artist_box clearfix">
    <?php
    if ($artist->image) {
        $image_props = array(
            'src' => MEDIA_HOST . '/sleeves/' . $artist->image,
            'alt' => $artist->display,
            'width' => '200',
            'height' => '200',
            'title' => $artist->display
        );
        ?>

        <div class="artist_imagebox_left">
            <?php echo img($image_props); ?>
        </div>
    <?php }?>
        <ul>
            <li><p><a href="<?php echo site_url('database/biography/' . $artist->slug);?>"><?php echo $artist->display;?> biography</a></p></li>
            <li><p><a href="<?php echo site_url('database/discography/' . $artist->slug);?>"><?php echo $artist->display;?> discography</a></p></li>
            <li><p><a href="<?php echo site_url('database/gigography/' . $artist->slug);?>"><?php echo $artist->display;?> gigography</a></p></li>
            
        </ul>
        
        
    </div>
    <?php        endforeach;?>

</div>