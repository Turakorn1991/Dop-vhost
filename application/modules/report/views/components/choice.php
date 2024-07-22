<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/16/2017 AD
 * Time: 23:02
 */
?>
<?php
foreach ($choices as $choice){
    ?>
    <div> <div class="checkbox <?php echo ($choice->check)?"checked":"";?>"></div> <?php echo $choice->title?><span class="_input _inline" style="font-weight: normal"><?php echo $choice->remark ?></span></div>
    <?php
}
?>
