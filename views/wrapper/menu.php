<?php
$this->load->helper('artist_helper');

if (isset($artist_details)) {
    $bln_artist = TRUE;
} else {
    $bln_artist = FALSE;
}
if (isset($track_details)) {
    $bln_track = TRUE;
} else {
    $bln_track = FALSE;
}
?>

<ul class="menu level0 clearfix">
    <li><p><a href="<?php echo site_url('database/'); ?>" title="Database home">Home</a></p></li>
    <li class="<?php if ($bln_artist) echo is_active('galaxie_500', $artist_details->slug); ?>"><p><a href="<?php echo site_url('database/biography/galaxie_500'); ?>">Galaxie 500</a></p></li>
    <li class="<?php if ($bln_artist) echo is_active('luna', $artist_details->slug); ?>"><p><a href="<?php echo site_url('database/biography/luna'); ?>">Luna</a></p></li>
    <li class="<?php if ($bln_artist) echo is_active('damon_and_naomi', $artist_details->slug); ?>"><p><a href="<?php echo site_url('database/biography/damon_and_naomi'); ?>">Damon &amp; Naomi</a></p></li>
    <li class="<?php if ($bln_artist) echo is_active('dean_and_britta', $artist_details->slug); ?>"><p><a href="<?php echo site_url('database/biography/dean_and_britta'); ?>">Dean &amp; Britta</a></p></li>
    <li class="<?php if ($bln_track) echo 'active'; ?>"><p><a href="<?php echo site_url('database/lists'); ?>">Lists</a></p></li>
</ul>

<?php if ($this->uri->segment(3) && $bln_artist) : ?>
    <ul class="menu level1 clearfix">
        <li class="<?php echo is_active('biography', $this->uri->segment(2)); ?>"><p><a href="<?php echo site_url('database/biography/' . $artist_details->slug); ?>" title="<?php echo $artist_details->display; ?> Biography">Biography</a></p></li>
        <li class="<?php echo is_active('discography', $this->uri->segment(2)); ?>"><p><a href="<?php echo site_url('database/discography/' . $artist_details->slug); ?>" title="<?php echo $artist_details->display; ?> Biography">Discography</a></p></li>
        <li class="<?php echo is_active('gigography', $this->uri->segment(2)); ?>"><p><a href="<?php echo site_url('database/gigography/' . $artist_details->slug); ?>" title="<?php echo $artist_details->display; ?> Biography">Gigography</a></p></li>
    </ul>         
<?php endif; ?>

<?php if ($this->uri->segment(2) === 'track') : ?>
    <ul class="menu level1 clearfix">
        <li class="<?php echo is_active('track', $this->uri->segment(2)); ?>"><p><a href="<?php echo site_url('database/track/az'); ?>" title="A-Z of tracks">Tracks</a></p></li>
        <li class="<?php echo is_active('covers', $this->uri->segment(3)); ?>"><p><a href="<?php echo site_url('database/track/covers'); ?>" title="A-Z of cover versions">Covers</a></p></li>
        <li class="<?php echo is_active('guitar', $this->uri->segment(3)); ?>"><p><a href="<?php echo site_url('database/tracks/guitar'); ?>" title="A-Z of guitar">Guitar</a></p></li>
    </ul>         
    <?php
    $current = '';
    ?>
    <ul class="menu level2 clearfix">
        <?php
        foreach ($track_list['az'] as $az):
            if ($az->sort !== $current):
                $current = $az->sort;
                ?>
                <li class="<?php echo is_active(strtoupper($key), $az->sort); ?>"><p><a href="<?php echo site_url('database/track/az/' . strtolower($current)); ?>"><?php echo strtoupper($current); ?></a></p></li>
            <?php
            endif;

        endforeach;
        ?>
    </ul>         
<?php endif; ?>


    <?php if ($this->uri->segment(2) === 'gigography' && $this->uri->segment(4) !== 'show') : ?>
    <ul class="menu level2 clearfix">
    <?php foreach ($show_list['years'] as $active_year): ?>

            <li class="<?php echo is_active($year, $active_year->year); ?>"><p><a href="<?php echo site_url('database/gigography/' . $artist_details->slug . '/' . $active_year->year); ?>"><?php echo $active_year->year; ?></a></p></li>


    <?php endforeach; ?>
    </ul>         
<?php endif; ?>

<?php if ($this->uri->segment(4) === 'show') : ?>
    <ul class="menu level2 clearfix">
        <li class="active"><p><a href="<?php echo site_url('database/gigography/' . $artist_details->slug . '/' . $show['show_details']->year); ?>">Shows from <?php echo $show['show_details']->year; ?></a></p></li>
    </ul>         
<?php endif; ?>



<div id="content_wrap" class="clearfix">

