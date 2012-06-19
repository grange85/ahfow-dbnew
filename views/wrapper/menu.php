<ul id="main_menu" class="clearfix">
    <li><p><a href="<?php echo site_url('database/'); ?>" title="Database home">Home</a></p></li>

    <li><p><a href="<?php echo site_url('database/discography/galaxie_500'); ?>">Galaxie 500</a></p></li>
    <li><p><a href="<?php echo site_url('database/discography/luna'); ?>">Luna</a></p></li>
    <li><p><a href="<?php echo site_url('database/discography/damon_and_naomi'); ?>">Damon &amp; Naomi</a></p></li>
    <li><p><a href="<?php echo site_url('database/discography/dean_and_britta'); ?>">Dean &amp; Britta</a></p></li>
</ul>

<?php if ($this->uri->segment(3)) : ?>
    <ul class="sub_menu level1">
        <li><p>Artist sub menu</p></li>    
    </ul>         
<?php endif; ?>

<?php if ($this->uri->segment(2) === 'discography' && $this->uri->segment(3)) : ?>
    <ul class="sub_menu level2">
        <li><p>Discography sub menu</p></li>    
    </ul>         
<?php endif; ?>

<?php if ($this->uri->segment(2) === 'gigography') : ?>
    <ul class="sub_menu level2">
        <li><p>Gigography sub menu</p></li>    
    </ul>         
<?php endif; ?>


<div id="content_wrap" class="clearfix">

