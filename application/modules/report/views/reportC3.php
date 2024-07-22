<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
    <div class="body large">
     <div class="row">
            <div class="col col-xs-4"></div>
            <div class="col col-xs-4 text-center">
               
            </div>
            <div class="col col-xs-4 text-right"><span class="label-code">แบบ ศผส.03</span></div>
        </div>
        <div class="row">
          <div class="col col-xs-12 caption text-center" >
       แบบใบรับเงินค่าจัดการศพผู้สูงอายุตามประเพณี
        </div>
        </div>
        <div class="row section">
            <div class="text-right"><span class="_input _30 text-left"><?php echo $res->org ?></span></div>
            <div class="text-right">
                วัน<span class="_input _5 text-center"><?php echo $res->date->day ?></span>
                เดือน<span class="_input _10 text-center"><?php echo $res->date->month ?></span>
                พ.ศ.<span class="_input _10 text-center"><?php echo $res->date->year ?></span>
            </div>
        </div>
         <div class="row section">
             <div>
                 ข้าพเจ้า<span class="_input _90 "><?php echo "{$res->prename}{$res->name} {$res->surname}" ?></span>
             </div>
             <div>
                บ้านเลขที่<span class="_input _20 "><?php echo $res->addr->no ?></span>
                ตรอก/ซอย<span class="_input _30 "><?php echo $res->addr->side_street ?></span>
                ถนน<span class="_input _25 "><?php echo $res->addr->street ?></span>
             </div>
             <div>
                ตำบล/แขวง<span class="_input _20"><?php echo $res->addr->locality ?></span>
                อำเภอ/เขต<span class="_input _20"><?php echo $res->addr->district ?></span>
                 จังหวัด<span class="_input _30"><?php echo $res->addr->province ?></span>
             </div>
             
             <div>
ได้รับเงินสงเคราะห์ในการจัดการศพผู้สูงอายุตามประเพณีของ 
<span class="_input _inlune"><?php echo makeText($res->dead->prename.$res->dead->name." ".$res->dead->surname,40) ?> </span>
เป็นเงิน  <span class="_input "><?php echo makeText($res->money,21) ?></span> บาท<br>
 (<span class="_input "><?php echo $res->moneytext ?> </span> ) ไปถูกต้องแล้ว
             </div>
         </div>
      <div class="row">
        <div class="col col-xs-5 col-xs-offset-6 text-center">
          <div style="margin-top: 100px">
            <div>(ลงนาม)<span class="_input _50">&nbsp;</span>ผู้รับเงิน</div>
            <div>(<span class="_input _60"><?php echo "{$res->prename}{$res->name} {$res->surname}" ?></span>)</div>

            <div>(ลงนาม)<span class="_input _50"><?php echo "{$res->staff->prename}{$res->staff->name} {$res->staff->surname}" ?></span>ผู้จ่ายเงิน</div>
            <div>(<span class="_input _60">&nbsp;</span>)</div>

            <div>(ลงนาม)<span class="_input _50">&nbsp;</span>พยาน</div>
            <div>(<span class="_input _60">&nbsp;</span>)</div>

            <div>(ลงนาม)<span class="_input _50">&nbsp;</span>พยาน</div>
            <div>(<span class="_input _60">&nbsp;</span>)</div>

          </div>
        </div>
      </div>

    </div>
</div>