<div id="content_left">
    <h2>Home</h2>
    <gcse:searchbox-only resultsUrl="<?php echo site_url($this->uri->rsegment(1) . '/search/');?>" newWindow="false" queryParameterName="q">
</gcse:searchbox-only>
    <?php 
    

    
    foreach ($artist_list as $artist):?>
    <div class="artist_box clearfix">
    <?php
    if ($artist->image) {
        $basepath = MEDIA_HOST . '/0' . $artist->artist_id . '-' . $artist->slug . '/pictures/';
        $image_props = array(
            'src' => $basepath . $artist->image,
            'alt' => htmlentities($artist->display),
            'width' => '200',
            'height' => '200',
            'title' => htmlentities($artist->display)
        );
        ?>

        <div class="artist_imagebox_left">
            <?php echo img($image_props); ?>
        </div>
    <?php }?>
        <ul>
            <li><p><a href="<?php echo site_url($this->uri->rsegment(1) . '/biography/' . $artist->slug);?>"><?php echo htmlentities($artist->display);?> biography</a></p></li>
            <li><p><a href="<?php echo site_url($this->uri->rsegment(1) . '/discography/' . $artist->slug);?>"><?php echo htmlentities($artist->display);?> discography</a></p></li>
            <li><p><a href="<?php echo site_url($this->uri->rsegment(1) . '/gigography/' . $artist->slug);?>"><?php echo htmlentities($artist->display);?> gigography</a></p></li>
            
        </ul>
        
        
    </div>
    <?php        endforeach;?>

</div>