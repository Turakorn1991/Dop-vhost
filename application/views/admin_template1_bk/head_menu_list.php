<ul class="dropdown-menu head_menu">

      <?php
      $tmp = $this->admin_model->getOnce_Application(1);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(1,get_session('user_id')); //Check User Permission
      //dieArray($tmp1);
      ?>      
      <li
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_parent_id']==1 || $usrpm['app_id']==1 ) {
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('difficult/assist_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
        </a>
      </li>

      <?php
      $tmp = $this->admin_model->getOnce_Application(11);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(11,get_session('user_id')); //Check User Permission
      ?>      
      <li class="dropdown-submenu 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
       disabled 
    <?php 
    }else if($usrpm['app_parent_id']==11 || $usrpm['app_id']==11) {
    ?>
         active 
      <?php
        }
      ?>
       ">
        <a tabindex="-1" class="submenu" href="#" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
          <span class="fa fa-caret-right"></span>
        </a>
        <ul class="dropdown-menu">

          <?php
          $tmp = $this->admin_model->getOnce_Application(157);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(157,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==157) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('welfare/webblock_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>
          <?php
          $tmp = $this->admin_model->getOnce_Application(158);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(158,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==158) {
        ?>
              class="active"
          <?php 
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('welfare/welfare_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>

        </ul>
      </li>

      <?php
      $tmp = $this->admin_model->getOnce_Application(20);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(20,get_session('user_id')); //Check User Permission
      ?>      
      <li 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_parent_id']==20) {
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('funeral/funeral_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
        </a>
      </li>

      <?php
      $tmp = $this->admin_model->getOnce_Application(28);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(28,get_session('user_id')); //Check User Permission
      ?>      
      <li class="dropdown-submenu 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
        disabled 
    <?php 
    }else if($usrpm['app_parent_id']==28) {
    ?>
        active 
      <?php
        }
      ?>
       ">
        <a tabindex="-1" class="submenu" tabindex="-1" href="#" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
          <span class="fa fa-caret-right"></span>
        </a>
        <ul class="dropdown-menu">

          <?php
          $tmp = $this->admin_model->getOnce_Application(159);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(159,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==159) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('adaptenvir/adaptenvir_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>
          <?php
          $tmp = $this->admin_model->getOnce_Application(160);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(160,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==160) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('adaptenvir/activity_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>

        </ul>

      </li>
      <li style="border: 1px #eee solid;"></li>

      <?php
      $tmp = $this->admin_model->getOnce_Application(44);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(44,get_session('user_id')); //Check User Permission
      ?>      
      <li class="dropdown-submenu 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
       disabled 
    <?php 
    }else if($usrpm['app_parent_id']==44) {
    ?>
       active 
      <?php
        }
      ?>
       ">
        <a tabindex="-1" class="submenu" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('intelprop/intelprop_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
          <span class="fa fa-caret-right"></span>
        </a>
        <ul class="dropdown-menu">

          <?php
          $tmp = $this->admin_model->getOnce_Application(161);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(161,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==161) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('intelprop/intelprop_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>
          <?php
          $tmp = $this->admin_model->getOnce_Application(162);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(162,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==162) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('intelprop/intelprop_list1');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>

        </ul>
      </li>

      <?php
      $tmp = $this->admin_model->getOnce_Application(50);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(50,get_session('user_id')); //Check User Permission
      ?>      
      <li 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_parent_id']==50 || $usrpm['app_id']==50) {
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('volunteer/volunteer_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
        </a>
      </li>
 <li style="border: 1px #eee solid;"></li>

   <?php
      $tmp = $this->admin_model->getOnce_Application(53);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(53,get_session('user_id')); //Check User Permission
      ?>      
  <!--       <li 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_parent_id']==53 || $usrpm['app_id']==53) {
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('prepare/prepare_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
        </a>
      </li> -->

   <!-- เตียมความพร้อม สูงอายุ -->
      <li class="dropdown-submenu 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
       disabled  
    <?php 
    }else if($usrpm['app_parent_id']==53 || $usrpm['app_id']==53) {
    ?>
       active 
      <?php
        }
      ?>
      ">
        <a tabindex="-1" class="submenu" href="#" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
        <span class="fa fa-caret-right"></span>
        </a>
        <ul class="dropdown-menu">
          <?php
          $tmp = $this->admin_model->getOnce_Application(54);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(54,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==54) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('prepare/prepare_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>
          <?php
          $tmp = $this->admin_model->getOnce_Application(55);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==55) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('prepare/quiz_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>

          <?php
          $tmp = $this->admin_model->getOnce_Application(56);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(56,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==56) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('prepare/training_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>


          </ul>
      </li>
      <!--จบ เตียมความพร้อม สูงอายุ -->


      <!--the starting of school-->
      <?php
      $tmp = $this->admin_model->getOnce_Application(57);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(57,get_session('user_id')); //Check User Permission
      //dieArray($tmp1);
      ?>      
      <li
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_parent_id']==57) {
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('school/school_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
        </a>
      </li>
      <!--the ending of school-->




      <?php
      $tmp = $this->admin_model->getOnce_Application(63);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(63,get_session('user_id')); //Check User Permission
      ?>      
      <li class="dropdown-submenu 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
       disabled  
    <?php 
    }else if($usrpm['app_parent_id']==63 || $usrpm['app_id']==63) {
    ?>
       active 
      <?php
        }
      ?>
      ">
        <a tabindex="-1" class="submenu" href="#" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
        <span class="fa fa-caret-right"></span>
        </a>
        <ul class="dropdown-menu">
          <?php
          $tmp = $this->admin_model->getOnce_Application(151);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(151,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==151) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('jobs/jobs_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>
          <?php
          $tmp = $this->admin_model->getOnce_Application(152);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(152,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==152) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('jobs/registered_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>
          <?php
          $tmp = $this->admin_model->getOnce_Application(174);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(174,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==174) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('jobs/survey_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>
        </ul>
      </li>



<!--the starting of qlc-->
<?php
      $tmp = $this->admin_model->getOnce_Application(163);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(163,get_session('user_id')); //Check User Permission
      //dieArray($tmp1);
      ?>      
      <li
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_parent_id']==163) { //drop down menu of header tab เมนูตรงชื่อบัญชี
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('school/center_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
        </a>
      </li>
      <!--the ending of qlc-->

      <li style="border: 1px #eee solid;"></li>



      <?php
      $tmp = $this->admin_model->getOnce_Application(70);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(70,get_session('user_id')); //Check User Permission
      ?>      
      <li 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_parent_id']==70 || $usrpm['app_id']==70) {
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('individual/individual_list');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
        </a>
      </li>

      <?php
      $tmp = $this->admin_model->getOnce_Application(64);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(64,get_session('user_id')); //Check User Permission
      ?>      
      <li 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_parent_id']==64 || $usrpm['app_id']==64) {
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('usm');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
        </a>
      </li>

      <?php
      $tmp = $this->admin_model->getOnce_Application(74);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(74,get_session('user_id')); //Check User Permission
      ?>      
      <li class="dropdown-submenu 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
       disabled 
    <?php 
    }else if($usrpm['app_parent_id']==74 || $usrpm['app_id']==74) {
    ?>
       active 
      <?php
        }
      ?>
       ">
        <a tabindex="-1" class="submenu" href="#"><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
          <span class="fa fa-caret-right"></span>
        </a>
        <ul class="dropdown-menu">
          <?php
          $tmp = $this->admin_model->getOnce_Application(165);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(165,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==165) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('webconfig/webconfig_detail');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>
          <?php
          $tmp = $this->admin_model->getOnce_Application(166);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(166,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==166) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('webconfig/infrm2/Edit/1');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>
          <?php
          $tmp = $this->admin_model->getOnce_Application(167);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(167,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==167) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('webconfig/webconfig_news');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>
          <?php
          $tmp = $this->admin_model->getOnce_Application(168);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(168,get_session('user_id')); //Check User Permission
          ?>      
          <li 
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
          class="disabled" 
        <?php 
        }else if($usrpm['app_id']==168) {
        ?>
              class="active"
          <?php
            }
          ?>
           >
            <a tabindex="-1" href="<?php if(isset($tmp1['perm_status'])) {echo site_url('webconfig/webconfig_event');}else{echo '#';}?>" ><i class="fa <?php if(!isset($tmp1['perm_status'])) { ?>fa-lock<?php }?>" aria-hidden="true"></i> <?php if(isset($tmp['app_id'])) {echo '&nbsp;'.$tmp['app_name']; }?>
            </a>
          </li>
        </ul>
      </li>
      <li style="border: 1px #eee solid;"></li>
    
      <li>
        <a tabindex="-1" href="<?php echo site_url('control/main_module');?>" ><i class="fa" aria-hidden="true"></i> 
          &nbsp;เมนูหลัก
        </a>
      </li>
</ul>

  <script>
  $('.dropdown-submenu a.submenu').on("click", function(e){
    var tmp = $(this).next('ul').css('display');
    //console.log(tmp);
    $(this).next('ul').toggle();
    
    $('.dropdown-submenu ul').css('display','none');

    if(tmp=='table'){
      console.log(tmp);
      $(this).next('ul').css('display','none');
    }else{
      $(this).next('ul').css('display','table');
    }
    e.stopPropagation();
    e.preventDefault();
  });
  </script>




