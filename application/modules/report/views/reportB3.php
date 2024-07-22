<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/9/2017 AD
 * Time: 21:18
 */ ?>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body smalled full">
    <div class="row">
      <div class="col-xs-12 border" style="padding: 5px;">
        <div class="row">
          <div class="col-xs-12">
            <div><strong>ข้อมูลผู้ประเมิน</strong></div>
            <div>
                เจ้าหน้าที่ผู้ประเมิน<span class="_input _20"><?php echo $res->irp_name  ?>&nbsp;</span>
                พยาบาล <span class="_input _25"><?php echo $res->nurse_name ?>&nbsp;</span>
                นักสังคมสงเคราะห์  <span class="_input _25"><?php echo $res->almoner_name ?>&nbsp;</span>
              </div>
            <div><strong>ข้อมูลผู้สูงอายุ</strong></div>
            <div>
              ชื่อ<span class="_input _25"><?php echo $res->per->prename . $res->per->name ?>&nbsp;</span>
              นามสกุล<span class="_input _25"><?php echo $res->per->surname ?>&nbsp;</span>
              เลขที่บัตรประชาชน <span class="_input _25"><?php echo $res->per->idcard ?>&nbsp;</span>
            </div>
            <div>วันเดือนปีเกิด<span class="_input _25"><?php echo $res->per->birth ?>&nbsp;</span>
              อายุ<span class="_input _10"><?php echo $res->per->age ?>&nbsp;</span>ปี
              สัญชาติ<span class="_input _10"><?php echo $res->per->nationality ?>&nbsp;</span>
              ศาสนา<span class="_input _10"><?php echo $res->per->religion ?>&nbsp;</span>
              สถานะภาพ<span class="_input _15"><?php echo $res->per->status ?>&nbsp;</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12">
      <?php
      foreach($res->irp as $d_index=> $dimension){
        $dino=$d_index+1;
        echo "<div class='row'>";
        echo "<div class=\"col-xs-12\"><h4><strong>มิติที่ {$dino} : {$dimension->qstn_title}</strong></h4></div>";
       if(count($dimension->child)){
         echo "<table class=\"table table-result table-small table-bordered\" style=\"width: 100%\">";
           foreach($dimension->child as $q_index=> $question){
               $quno=$q_index+1;
               $tr=0;
              if(($q_index%2)==0){
                  $tr=1;
                echo "<tr >";
                echo "<td style='width: 5%;padding: 10px 5px;text-align:center'>{$quno}</td>";
                echo "<td style='width: 45%;padding: 10px 5px'>";
                echo "<div>$question->qstn_title</div>";
                  foreach($question->child as $ans){
                      $chk=($ans->chk)?"checked":"";
                      echo "<div> <div class='checkbox {$chk}'></div> {$ans->qstn_title}</div>";
                  }
                echo"</td>";
              }else{
                  $tr=0;
                  echo "<td style='width: 5%;padding: 10px 5px;text-align: center'>{$quno}</td>";
                  echo "<td style='width: 45%;padding: 10px 5px'>";
                  echo "<div>$question->qstn_title</div>";
                  foreach($question->child as $ans){
                    $chk=($ans->chk)?"checked":"";
                      echo "<div> <div class='checkbox {$chk}'></div> {$ans->qstn_title}</div>";
                  }
                  echo"</td>";

                  echo "</tr>";
              }
           }

           if($tr){
               echo "<td style='width: 5%;text-align: center'></td>";
               echo "<td style='width: 45%'></td>";
               echo "</tr>";
           }
         echo "</table>";
       }
      echo "</div>";
      echo "<div style='page-break-after: avoid' >&nbsp;</div>";
      }
      ?>

      </div>

    </div>
  </div>
