
<?php $this->firephp->log($discography); ?>

<div id="content_left">


    <?php
    foreach (array_keys($discography) as $section):
//    $this->firephp->log(key($discography));
        ?>
        <h3><?php echo $section; ?></h3>
        <ul>
            <?php foreach ($discography[$section] as $item) : ?>
                <li><a href="<?php echo site_url('database/discography/' . $slug . '/' . $item->album_id); ?>"><?php echo $item->album; ?> (<?php echo $item->label . ' ' . $item->release_date; ?>)</a></li>
            <?php endforeach; ?>
        </ul>

    <?php endforeach; ?>
</div>