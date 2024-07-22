
			<div class="row">
				<?php echo form_open('',array('class'=>'searchform cf')); ?>
				  <div class="col s12 m6 search"><input type="text" name="search" placeholder="ค้นหา..."></div>
				  <div class="col s6 m2 search"><input type="date" name="fromdate" class="datepicker"></div>
				  <div class="col s6 m2 search"><input type="date" name="todate" class="datepicker"></div>
				  <div class="col s12 m1 search"><button type="submit" name="bt_submit" value="search">ค้นหา</button></div>
				<?php echo form_close(); ?>
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

				<div class="divider"></div>	
<?php
	$disMode = array(1=>'NEWS_NEW',2=>'HOT_NEWS',3=>'UPDATE_NEWS');
	$rows = array();


    switch ($cNews['CN_DisplayConfig']) {
        case '2': // hot news 
        	$dateThis = date("Y-m-d");
            $temp_News    = $this->common_model->custom_query("SELECT A.*,count(B.ID) AS view  FROM news AS A LEFT JOIN news_views_downloads AS B ON A.N_ID = B.ID WHERE A.N_Allow = '1' AND B.NVD_Type ='1' AND A.CN_ID = {$cNews['CN_ID']} GROUP BY B.ID ORDER BY view DESC");
            foreach($temp_News as $key=>$row) {
                if($row['view'] >= $row['N_HotNumDisplay']) { 
                    if(!isset($rows[$row['N_ID']])) {
                        $row['CN_Status'] = 2;
                        $rows[$row['N_ID']] = $row;
                    }
            	}
            }

            $temp_News = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND (('$dateThis'=N_StartDate OR '$dateThis'=N_EndDate) OR ('$dateThis'>=N_StartDate AND '$dateThis'<=N_EndDate)) AND CN_ID = {$cNews['CN_ID']} ORDER BY N_StartDate DESC");
            foreach($temp_News as $key=>$row) {
                if(!isset($rows[$row['N_ID']])) {
                    $row['CN_Status'] = 1;
                    $rows[$row['N_ID']] = $row;
                }
            }

            $temp_News  = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND CN_ID = {$cNews['CN_ID']} ORDER BY N_DateTimeUpdate DESC");
            foreach($temp_News as $key=>$row) {
                if(!isset($rows[$row['N_ID']])) {
                    $row['CN_Status'] = 3;
                    $rows[$row['N_ID']] = $row;
                }
            }
            break;
            case '3': // update news
            	$dateThis = date("Y-m-d");
                $temp_News  = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND CN_ID = {$cNews['CN_ID']} ORDER BY N_DateTimeUpdate DESC");
	            foreach($temp_News as $key=>$row) {
	                if(!isset($rows[$row['N_ID']])) {
	                    $row['CN_Status'] = 3;
	                    $rows[$row['N_ID']] = $row;
	                }
	            }

	            $temp_News = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND (('$dateThis'=N_StartDate OR '$dateThis'=N_EndDate) OR ('$dateThis'>=N_StartDate AND '$dateThis'<=N_EndDate)) AND CN_ID = {$cNews['CN_ID']} ORDER BY N_StartDate DESC");
	            foreach($temp_News as $key=>$row) {
	                if(!isset($rows[$row['N_ID']])) {
	                    $row['CN_Status'] = 1;
	                    $rows[$row['N_ID']] = $row;
	                }
	            }

                $temp_News  = $this->common_model->custom_query("SELECT A.*,count(B.ID) AS view  FROM news AS A LEFT JOIN news_views_downloads AS B ON A.N_ID = B.ID WHERE A.N_Allow = '1' AND B.NVD_Type ='1' AND A.CN_ID = {$cNews['CN_ID']} GROUP BY B.ID ORDER BY view DESC");
	            foreach($temp_News as $key=>$row) {
	                if($row['view'] >= $row['N_HotNumDisplay']) { 
	                    if(!isset($rows[$row['N_ID']])) {
	                        $row['CN_Status'] = 2;
	                        $rows[$row['N_ID']] = $row;
	                    }
	            	}
	            }

            break;
            default: // new news
            	$dateThis = date("Y-m-d");
	            $temp_News = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND (('$dateThis'=N_StartDate OR '$dateThis'=N_EndDate) OR ('$dateThis'>=N_StartDate AND '$dateThis'<=N_EndDate)) AND CN_ID = {$cNews['CN_ID']} ORDER BY N_StartDate DESC");
	            foreach($temp_News as $key=>$row) {
	                if(!isset($rows[$row['N_ID']])) {
	                    $row['CN_Status'] = 1;
	                    $rows[$row['N_ID']] = $row;
	                }
	            }

                $temp_News  = $this->common_model->custom_query("SELECT A.*,count(B.ID) AS view  FROM news AS A LEFT JOIN news_views_downloads AS B ON A.N_ID = B.ID WHERE A.N_Allow = '1' AND B.NVD_Type ='1' AND A.CN_ID = {$cNews['CN_ID']} GROUP BY B.ID ORDER BY view DESC");
	            foreach($temp_News as $key=>$row) {
	                if($row['view'] >= $row['N_HotNumDisplay']) { 
	                    if(!isset($rows[$row['N_ID']])) {
	                        $row['CN_Status'] = 2;
	                        $rows[$row['N_ID']] = $row;
	                    }
	            	}
	            }

                $temp_News  = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND CN_ID = {$cNews['CN_ID']} ORDER BY N_DateTimeUpdate DESC");
	            foreach($temp_News as $key=>$row) {
	                if(!isset($rows[$row['N_ID']])) {
	                    $row['CN_Status'] = 3;
	                    $rows[$row['N_ID']] = $row;
	                }
	            }
        }
?>
<?php
	$num_rows		= count($rows);
	$one_page 		= 8;
	$page_start		= (($one_page*$page)-$one_page);
	$num_page		= $page;
	$page_row		= ceil($num_rows/$one_page);
	$i=0;
	$start = $page ;
	if($num_rows>0){
		foreach($rows as $key=>$row) {
			if($i < $page_start){
				$i++;
			 	continue;
			}
			if($i < $one_page * $page){?>
				<article class="news-list">
					<a title="<?php echo lang($row['N_Head']);?>" href="<?php echo site_url('news/cate'.$cNews['CN_ID'].'/view'.$row['N_ID']);?>">
						<div class="news-list-img">
							<div class="icon-tag" ><?php echo label($disMode[$row['CN_Status']]);?></div>
							<?php 
								if($catefirst == $row['CN_ID']){
									//if($row['N_ImgTitle'] != '' && read_file(base_url("assets/modules/news/images/{$row['N_ImgTitle']}"))){
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
								<div class="icon-tag" ><?php echo label($disMode[$row['CN_Status']]);?></div>
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
								<p class="content" style="text-indent: 15px;"><?php echo nameTitle(lang($row['N_Title']),200);?></p>
								<!-- <p class="date d-news-update"><i class="fa fa-clock-o"></i>3 พ.ย. 2558</p> -->
							</div>					
						</div>
						<p class="date d-news-update"><i class="fa fa-clock-o"></i><?php echo langDate(date($row['N_DateTimeAdd'])) ?></p>								
						<!-- <p class="date d-news-update"><i class="fa fa-clock-o"></i><?php echo langDate(date($row['N_DateTimeUpdate'])) ?></p>								 -->
					</a>
				</article><?php
			}else{
				break;
			}
			$i++;
		}
	}else{?>
		<div style="text-align:center">								
			<h2><?php echo label('NO_DATA'); ?></h2>
		</div><?php
	}
?>

					
					<?php if ($page_row>1) { ?>
						<div class="col s12">
							<ul class="pagination">
								<?php if($num_page == 1) {?>
									<li class="disabled"><a href="javascript:void(0);"><i class="material-icons">chevron_left</i></a></li>
								<?php }else{?>
									<a href="<?php $perv = $num_page - 1 ; echo site_url("news/cate{$SUB_ID}/page{$perv}");?>"><li class="waves-effect"><i class="material-icons">chevron_left</i></li></a>
								<?php }?>

								<?php 
									if($page_row > 10){
										$pgS = $num_page - 5;
										$pgE = $num_page + 5;

										if($pgS <= 0){
											$pgS = 1;
											$pgE = $pgS + 9;
										}
										if($pgE >= $page_row){
											$pgS = $page_row - 9;
											$pgE = $page_row;
										}
									}else{
										$pgS = 1;
										$pgE = $page_row;
									}
								?>

								<?php if($pgS > 1){ ?>
									<a href="<?php echo site_url("news/cate{$SUB_ID}/page1"); ?>"><li class="waves-effect">1</li></a>
									<li class="disabled"><a href="javascript:void(0);"><i class="material-icons">...</i></a></li>
								<?php } ?>

								<?php for ($i = $pgS; $i <= $pgE ; $i++) { ?>
									<a href="<?php echo site_url("news/cate{$SUB_ID}/page{$i}"); ?>"><li class="waves-effect <?php if($num_page == $i) echo "active" ;?>"><?php echo $i ?></li></a>
								<?php } ?>

								<?php if(($page_row - $num_page) > 5 ){ ?>
									<li class="disabled"><a href="javascript:void(0);"><i class="material-icons">...</i></a></li>
									<a href="<?php echo site_url("news/cate{$SUB_ID}/page{$page_row}"); ?>"><li class="waves-effect"><?php echo $page_row; ?></li></a>
								<?php } ?>

								<?php if($num_page == $page_row) {?>
									<li class="disabled"><a href="javascript:void(0);"><i class="material-icons">chevron_right</i></a></li>
								<?php }else{?>
									<a href="<?php $nex = $num_page + 1 ; echo site_url("news/cate{$SUB_ID}/page{$nex}");?>"><li class="waves-effect <?php if($num_page == $page_row) echo "disabled"; ?>"><i class="material-icons">chevron_right</i></li></a>
								<?php }?>
							</ul>
						</div>
					<?php } ?>
	
			</div>
