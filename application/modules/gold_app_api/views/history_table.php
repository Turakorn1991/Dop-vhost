<table class="uk-table uk-table-striped uk-text-bold" style="font-size: 26px; line-height: 0.75em; border-style: solid; border-width: 4px 4px 4px 4px; border-color: #ffffff;">
            <thead style="background-color: #ffc43a;">
                <tr style="border-style: solid; border-width: 4px 4px 4px 4px; border-color: #ffffff;">
                    <th class="uk-text-center" style="color: #000000; font-weight: bold; border-style: solid; border-width: 0px 2px 0px 4px; border-color: #ffffff; font-size: 30px; width: 100px; min-width: 100px; max-width: 100px;">วันที่ได้รับ</th>
                    <th class="uk-text-center" style="color: #000000; font-weight: bold; border-style: solid; border-width: 0px 2px 0px 2px; border-color: #ffffff; font-size: 30px;">ชื่อสิทธิ</th>
                    <th class="uk-text-center" style="color: #000000; font-weight: bold; border-style: solid; border-width: 0px 2px 0px 2px; border-color: #ffffff; font-size: 30px; width: 150px; min-width: 150px; max-width: 150px;">ประเภทความช่วยเหลือ</th>
                    <th class="uk-text-center" style="color: #000000; font-weight: bold; border-style: solid; border-width: 0px 4px 0px 2px; border-color: #ffffff; font-size: 30px; width: 80px; min-width: 80px; max-width: 80px;">จำนวนเงิน</th>
                </tr>
            </thead>
             <tbody>
<?php

                        if(isset($diff_history)){
                            foreach ($diff_history as $i => $row) { ?>
                            <tr style="background-color: #ffe8cb; border-style: solid; border-width: 2px 2px 2px 2px; border-color: #ffffff;">
                                <td style="border-style: solid; border-width: 0px 2px 0px 4px; border-color: #ffffff;"><?php echo dateChange($row->date_of_pay,5) ?></td>
                                <td style="border-style: solid; border-width: 0px 2px 0px 2px; border-color: #ffffff;">การช่วยเหลือในภาวะยากลำบาก</td>
                                <td style="border-style: solid; border-width: 0px 2px 0px 2px; border-color: #ffffff;">เงินช่วยเหลือ</td>
                                <td style="border-style: solid; border-width: 0px 4px 0px 2px; border-color: #ffffff;"><?php echo number_format($row->pay_amount)." บาท" ?></td>

                            </tr>

                          <?php  }?>
                      <?php  }  ?>

                  <?php
                        if(isset($impv_history)){
                            foreach ($impv_history as $i => $row) { ?>
                            <tr style="background-color: #ffe8cb; border-style: solid; border-width: 2px 2px 2px 2px; border-color: #ffffff;">
                                <td style="border-style: solid; border-width: 0px 2px 0px 4px; border-color: #ffffff;"><?php echo dateChange($row->date_of_finish,5) ?></td>
                                <td style="border-style: solid; border-width: 0px 2px 0px 2px; border-color: #ffffff;">การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวก</td>
                                <td style="border-style: solid; border-width: 0px 2px 0px 2px; border-color: #ffffff;">ซ่อมบ้าน</td>
                                <td style="border-style: solid; border-width: 0px 4px 0px 2px; border-color: #ffffff;"><?php echo number_format($row->case_budget)." บาท" ?></td>

                            </tr>

                          <?php  }?>
                      <?php  }  ?>
                      <?php 
                        if(isset($adm_history)){
                            foreach ($adm_history as $i => $row) { ?>
                            <tr style="background-color: #ffe8cb; border-style: solid; border-width: 2px 2px 2px 2px; border-color: #ffffff;">
                                <td style="border-style: solid; border-width: 0px 2px 0px 4px; border-color: #ffffff;"><?php echo dateChange($row->date_of_adm,5) ?></td>
                                <td style="border-style: solid; border-width: 0px 2px 0px 2px; border-color: #ffffff;">ศูนย์พัฒนาการจัดสวัสดิการสังคมผู้สูงอายุ</td>
                                <td style="border-style: solid; border-width: 0px 2px 0px 2px; border-color: #ffffff;">รับเข้าศูนย์</td>
                                <td style="border-style: solid; border-width: 0px 4px 0px 2px; border-color: #ffffff;">-</td>

                            </tr>

                          <?php  }?>
                      <?php  }  ?>

           
       
                
           
            </tbody>
        </table>