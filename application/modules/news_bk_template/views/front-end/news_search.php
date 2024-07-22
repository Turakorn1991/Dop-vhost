
			<div class="row">
				<!-- <form class="searchform cf"> -->
				<?php echo form_open('',array('class'=>'searchform cf')); ?>
				  <div class="col s12 m6 search"><input type="text" name="search" placeholder="ค้นหา..." value="<?php echo $skey; ?>"></div>
				  <div class="col s6 m2 search"><input type="date" name="fromdate" class="datepicker" value="<?php echo $from; ?>"></div>
				  <div class="col s6 m2 search"><input type="date" name="todate" class="datepicker" value="<?php  echo $to; ?>"></div>
				  <div class="col s12 m1 search"><button type="submit" name="bt_submit" value="search">ค้นหา</button></div>
				<?php echo form_close(); ?>
				<!-- </form> -->
			</div>

			<!-- Side Menu -->
			<div class="col s12 m12 l3">				
				<div class="smenu">
					<h1 class="smenu-title"><?php echo labelDB('news');?></h1>
					<ul class="smenu-list">
					<?php
					$rows = $this->news_model->getAllCategory();
					$catefirst = $rows[0]['CN_ID']; 
					foreach ($rows as $key => $value) {

						$CN_Name = uns($value['CN_Name']);
					?>
						<li class="smenu-item <?php if($value['CN_ID']==$SUB_ID){?> active <?php }?>"><a href="<?php echo site_url('news/cate'.$value['CN_ID']);?>">&nbsp;<?php echo image($value['CNI_Img'],'news',array('width'=>'24px','height'=>'24px'))?>&nbsp;<?php echo lang($CN_Name);?></a></li>
					<?php
					}
					?>		
					</ul>
				</div>
			</div>

			<!-- Project Content -->
			<div class="col s12 m12 l9">			
				<h1 class="head-text"><?php echo labelDB('news'.$SUB_ID);?></h1>
				<h3><?php echo "ค้นหาจาก {$skey}"; ?></h3>
				<div class="divider"></div>	
				<?php 
				if(!empty($sResult)){
					foreach($sResult as $key=>$row) {?>
						<article class="news-list">
							<a title="<?php echo lang($row['N_Head']);?>" href="<?php echo site_url('news/cate'.$cNews['CN_ID'].'/view'.$row['N_ID']);?>">
								<div class="news-list-img">
									<!-- <div class="icon-tag" ><?php echo label($disMode[$row['CN_Status']]);?></div> -->
									<?php 
										if($catefirst == $row['CN_ID']){
											//if($row['N_ImgTitle'] != ''  && read_file(base_url("assets/modules/news/images/{$row['N_ImgTitle']}"))){
											if($row['N_ImgTitle'] != ''){
												echo image($row['N_ImgTitle'],'news',array('alt'=>'','title'=>'','onerror'=>'noimage(this)'));
											}else{
												echo image_asset('noimage.gif','',array('alt'=>'','title'=>''));
											}
										}
										
									?>
								</div>
								<div class="news-text">	
									<?php
									if($catefirst !=  $row['CN_ID']){?>
										<!-- <div class="icon-tag" ><?php echo label($disMode[$row['CN_Status']]);?></div> -->
										<p style="margin-bottom:7px">&nbsp;</p>
									<?php
									}
									?>
									
									<div >
										<!-- <h2 style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo lang($row['N_Head']);?></h2> -->
										<h2 style="font-size:18px;"><?php echo lang($row['N_Head']);?></h2>
										<?php 
											$dateST     = $row['N_StartActivity'];
			                                $dateED     = $row['N_EndActivity'];
			                                if($dateST == '0000-00-00'){
			                                    $dateST = $dateED;
			                                }elseif($dateED == '0000-00-00'){
			                                    $dateED = $dateST;
			                                }
											if($dateST != '0000-00-00' || $dateED != '0000-00-00'){ ?>
											<?php if($dateST == $dateED){ ?>
												<p class="date"><i class="fa fa-calendar"></i><?php echo langDate($dateST);?></p>
											<?php }else{ ?>
												<p class="date"><i class="fa fa-calendar"></i><?php echo langDate($dateST).' - '.langDate($dateED);?></p>
											<?php } ?>
										<?php }?>
										<!-- <p class="date"><i class="fa fa-calendar"></i><?php echo langDate(date($row['N_DateTimeAdd'])) ?></p> -->
										<p class="content"><?php echo nameTitle(lang($row['N_Title']),200);?></p>
										<!-- <p class="date d-news-update"><i class="fa fa-clock-o"></i>3 พ.ย. 2558</p> -->
									</div>					
								</div>
								<p class="date d-news-update"><i class="fa fa-clock-o"></i><?php echo langDate(date($row['N_DateTimeAdd'])) ?></p>								
								<!-- <p class="date d-news-update"><i class="fa fa-clock-o"></i><?php echo langDate(date($row['N_DateTimeUpdate'])) ?></p>								 -->
							</a>
						</article>
					<?php }
				}else{?>
					<div style="text-align:center">								
						<h2><?php echo label('NO_DATA'); ?></h2>
					</div><?php
				}
			?>

				

			</div>
