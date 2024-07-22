<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/16/2017 AD
 * Time: 21:56
 */
?>
<div>
    บ้านเลขที่ <span class="_input _10"><?php echo $addr->no ?>&nbsp;</span >
    หมู่ที่<span class="_input _15"><?php echo $addr->moo ?>&nbsp;</span >
    ตรอก<span class="_input _20"><?php echo $addr->lane ?>&nbsp;</span >
    ซอย<span class="_input _20"><?php echo $addr->side_street ?>&nbsp;</span >
    ถนน<span class="_input _15"><?php echo $addr->street ?>&nbsp;</span >
</div>
<div>ตำบล/แขวง<span class="_input _20"><?php echo $addr->locality ?>&nbsp;</span >
    อำเภอ/เขต<span class="_input _20"><?php echo $addr->district ?>&nbsp;</span >
    จังหวัด<span class="_input _15"><?php echo $addr->province ?>&nbsp;</span >
    รหัสไปรษณีย์<span class="_input _15"><?php echo $addr->postcode ?>&nbsp;</span >
</div>
<div>เบอร์โทรศัพท์ (ที่ติดต่อได้)<span class="_input _20"><?php echo $addr->phone ?>&nbsp;</span >
<!--    เบอร์ต่อ<span class="_input _15">--><?php //echo $addr->phone_ex ?><!--&nbsp;</span >-->
<!--    โทรสาร<span class="_input _20">--><?php //echo $addr->fax ?><!--&nbsp;</span >-->
<!--    อีเมล<span class="_input _20">--><?php //echo $addr->email ?><!--&nbsp;</span >-->
</div>
