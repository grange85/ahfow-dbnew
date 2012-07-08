<?php
/* End of file login.php */
/* Location: $(filePath} */
$this->load->helper('form');
?>
<div id="content_left">
    <h2><?php echo $section; ?></h2>
<?php echo form_open('admin/register'); ?>
    <p><?php echo form_label('Username', 'username'); ?> <?php echo form_input('username'); ?></p>
    <p><?php echo form_label('Email', 'email'); ?> <?php echo form_input('email'); ?></p>
    <p><?php echo form_label('Password', 'password'); ?> <?php echo form_password('password'); ?></p>
    <p><?php echo form_submit('Submit', 'Submit') . ' ' . form_reset('Reset', 'Reset'); ?></p>
<?php echo form_close(); ?>

</div>

<?php


/* End of file login.php */
/* Location: $(filePath} */
