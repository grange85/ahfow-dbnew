
<?php
$this->firephp->log($details);?>

<div>
    <h3><?php echo $details->album;?></h3>
    <p><?php echo $details->format . ' - ' . $details->label . ' (' . $details->release_date . ')';?></p>
    <p><?php echo $details->notes;?></p>
    
    
</div>
