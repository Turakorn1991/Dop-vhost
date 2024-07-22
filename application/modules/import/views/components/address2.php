<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/16/2017 AD
 * Time: 21:56
 */
?>
<div>
    บ้านเลขที่ <span class="_input _10"><?php echo $addr->no ?>&nbsp;&nbsp;</span >
    หมู่ที่<span class="_input _15"><?php echo $addr->moo ?>&nbsp;&nbsp;</span >
    ตรอก<span class="_input _20"><?php echo $addr->lane ?>&nbsp;</span >
    ซอย<span class="_input _20"><?php echo $addr->side_street ?>&nbsp;&nbsp;</span >
    ถนน<span class="_input _15"><?php echo $addr->street ?>&nbsp;&nbsp;</span >
</div>
<div>ตำบล/แขวง<span class="_input _20"><?php echo $addr->locality ?>&nbsp;&nbsp;</span >
    อำเภอ/เขต<span class="_input _20"><?php echo $addr->district ?>&nbsp;&nbsp;</span >
    จังหวัด<span class="_input _20"><?php echo $addr->province ?>&nbsp;&nbsp;</span >
    รหัสไปรษณีย์<span class="_input _10"><?php echo $addr->postcode ?>&nbsp;&nbsp;</span >
</div>

