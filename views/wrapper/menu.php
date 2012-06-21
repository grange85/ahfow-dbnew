<?php
$this->load->helper('artist_helper');
?>

<ul class="menu level0 clearfix">
    <li><p><a href="<?php echo site_url('database/'); ?>" title="Database home">Home</a></p></li>
    <li class="<?php echo is_active('galaxie_500', $slug); ?>"><p><a href="<?php echo site_url('database/discography/galaxie_500'); ?>">Galaxie 500</a></p></li>
    <li class="<?php echo is_active('luna', $slug); ?>"><p><a href="<?php echo site_url('database/discography/luna'); ?>">Luna</a></p></li>
    <li class="<?php echo is_active('damon_and_naomi', $slug); ?>"><p><a href="<?php echo site_url('database/discography/damon_and_naomi'); ?>">Damon &amp; Naomi</a></p></li>
    <li class="<?php echo is_active('dean_and_britta', $slug); ?>"><p><a href="<?php echo site_url('database/discography/dean_and_britta'); ?>">Dean &amp; Britta</a></p></li>
</ul>

<?php if ($this->uri->segment(3)) : ?>
    <ul class="menu level2 clearfix">
        <li class="<?php echo is_active('biography', $this->uri->segment(2)); ?>"><p><a href="<?php echo site_url('database/biography/' . $slug); ?>" title="<?php echo $display; ?> Biography">Biography</a></p></li>
        <li class="<?php echo is_active('discography', $this->uri->segment(2)); ?>"><p><a href="<?php echo site_url('database/discography/' . $slug); ?>" title="<?php echo $display; ?> Biography">Discography</a></p></li>
        <li class="<?php echo is_active('gigography', $this->uri->segment(2)); ?>"><p><a href="<?php echo site_url('database/gigography/' . $slug); ?>" title="<?php echo $display; ?> Biography">Gigography</a></p></li>
    </ul>         
<?php endif; ?>


<?php if ($this->uri->segment(2) === 'gigography') : ?>
    <ul class="menu level2 clearfix">
        <li><p>Gigography sub menu</p></li>    
    </ul>         
<?php endif; ?>


<div id="content_wrap" class="clearfix">

