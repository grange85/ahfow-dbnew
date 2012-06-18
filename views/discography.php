
<ul>
<?php
$this->firephp->log($discography);

foreach(array_keys($discography) as $section):
//    $this->firephp->log(key($discography));
    ?>
    <h3><?php echo $section;?></h3>
    <?php foreach ($discography[$section] as $item) :?>
    <li><a href="<?php echo site_url('databasetest/discography/' . $slug . '/' . $item->album_id);?>"><?php echo $item->album;?> (<?php echo $item->label . ' ' . $item->release_date;?>)</a></li>
    <?php endforeach;?>
    
<?php endforeach;?>
</ul>