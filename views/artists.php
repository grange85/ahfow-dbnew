<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//var_dump($artists);
?>
<div id="content_main">
    <ul>
        <?php foreach ($artists as $artist) : ?>

            <li>
                <p><?php echo $artist->display ?></p>
                <p><?php echo $artist->notes ?></p>

            </li>


        <?php endforeach; ?>

    </ul>
</div>