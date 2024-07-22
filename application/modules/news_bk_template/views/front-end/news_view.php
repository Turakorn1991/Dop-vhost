					<!-- Side Menu -->
					<div class="col s12 m12 l3">				
						<div class="smenu">
							<h1 class="smenu-title"><?php echo labelDB('news');?></h1>
							<ul class="smenu-list">
							<?php
							$rows = $this->news_model->getAllCategory();
							foreach ($rows as $key => $value) {
								$CN_Name = uns($value['CN_Name']);
							?>
								<li class="smenu-item <?php if($value['CN_ID']==$SUB_ID){?> active <?php }?>"><a href="<?php echo site_url('news/cate'.$value['CN_ID']);?>">&nbsp;<?php echo image($value['CNI_Img'],'news',array('width'=>'24px','height'=>'24px'))?>&nbsp;<?php echo $CN_Name[getLang()];?></a></li>
							<?php
							}
							?>		
							</ul>
						</div>
					</div>

					<!-- Content -->
					<div class="col s12 m12 l9">			
						<h1 class="head-text"><?php echo lang($news['N_Head']); ?></h1>
						<div class="divider"></div>
						<div class="news-desc">
							<?php if(lang($news['N_Owner_info']) != ''){?>
									<p class="author"><i class="fa fa-user"></i><?php echo lang($news['N_Owner_info']); ?></p>
							<?php }?>
							<?php 
								$dateST     = $news['N_StartActivity'];
	                            $dateED     = $news['N_EndActivity'];
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
							<!-- <p class="date"><i class="fa fa-calendar"></i><?php echo langDate(date($news['N_DateTimeAdd']));?></p> -->
							<p class="view"><i class="fa fa-eye"></i>เข้าชม <?php echo $countView.' '.label('TIMES'); ?></p>
							<p class="date right" title="วันที่ประกาศ"><i class="fa fa-clock-o"></i><?php echo langDate(date($news['N_DateTimeAdd']));?></p>
							<?php if(date($news['N_DateTimeAdd']) !== date($news['N_DateTimeUpdate'])){ ?>
								<br><p class="date right" title="วันที่แก้ไข"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><?php echo langDate(date($news['N_DateTimeUpdate']));?></p>
							<?php } ?>
						</div>

						<div class="news-view">
							<?php 
								//if($news['N_ImgTitle'] != '' && read_file(base_url("assets/modules/news/images/{$news['N_ImgTitle']}"))){
								if($news['N_ImgTitle'] != ''){
									echo image($news['N_ImgTitle'],'news',array('class'=>'responsive-img img-head','onerror'=>'noimage(this)')); 
								}
							?>

							<?php echo html_entity_decode(lang($news['N_Descript'])); ?>
							<!-- <img class="responsive-img" src="../../../images/sample/1.jpg" alt=""> -->
							<!-- <p>วันที่ 24 ธ.ค 2558 เวลา 09.30 น นายสังคม เกิดก่อ นายอำเภอเจาะไอร้อง / ผอ.ศปก.อ.เจาะไอร้อง เป็นประธานพิธีเปิดโครงการฝึกอบรมหลักสูตร "วิทยากรเสริมสร้างสันติสุข จังหวัดชายแดนภาคใต้" วิทยากรครู ข รุ่นที่ 2 ประจำปี 2559 ณ หอประชุมอำเภอเจาะไอร้อง โดยมี หัวหน้าส่วนราชการ หน่วยกำลัง กำนัน ผู้ใหญ่บ้าน และหน่วยงานที่เกี่ยวข้อง ร่วมพิธีเปิดในครั้งนี้ มีกลุ่มเป้าหมายจากคณะกรรมการหมู่บ้าน ผู้ช่วยผู้ใหญ่บ้านฝ่ายปกครอง ผู้ช่วยผู้ใหญ่บ้านฝ่ายรักษาความสงบ และบัณฑิตอาสา ทุกตำบลทุกหมู่บ้าน เข้ารับการฝึกอบรมรวมทั้งสิ้น 350 คน วัตถุประสงค์เพื่อสร้างการเรียนรู้กระบวนการ เทคนิดการทำงานเป็นทีม สามารถสร้างทีมและเครือข่ายเพื่อสนับสนุนการสร้างสันติสุขในจังหวัดชายแดนภาคใต้ โดยกิจกรรมหลักสูตรประกอบด้วย 1.การบรรยายหัวข้อ "นโยบายกระบวนการพูดคุยสันติสุข จชต. 2.การเสวนาหัวข้อ "โรดแมป กระบวนการพูดคุยและการแสวงหาทางออกจากความขัดแย้งโดยสันติวิธี 3.การบรรยายหัวข้อ "แผนการปฏิบัติขับเคลื่อนการแก้ไขปัญหาและพัฒนา จชต. 4.การเสวนาหัวข้อ "การจัดเวทีเสวนาประชาคมที่มีประสิทธิภาพการจัดทำแผนชุมชน"</p> -->
						</div>


						<?php if(!empty($nFiles)) {?>
							<?php foreach ($nFiles as $row) {
								$ext = explode('.', $row['ND_File']);
								$ext = strtolower($ext[count($ext)-1]);
								$countDL = $this->db->select('ID')->where('NVD_Type','2')->where('ID',$row['ND_ID'])->count_all_results('news_views_downloads');
								//dieArray($ext);
								?>
									<div class="col s12 m6 l4 news-file">
										<?php
										// dieFont(base_url("assets/modules/news/images/file-ico/{$ext}.png"));
										//if(read_file("./assets/modules/news/images/file-ico/{$ext}.png"))
										 	echo image("file-ico/{$ext}.png",'news',array('width'=>'25','onerror'=>'noimage(this)'));  ?>
										<a target="_blank" title="<?php echo lang($row['ND_Name']);?>" href="<?php echo base_url('news/download/'.$row['ND_ID']);?>">
											<?php echo lang($row['ND_Name']);?> <i class="fa fa-download"></i> <small><?php echo $countDL.' '.label('TIMES');?></small>
										</a>
									</div>
									<!-- <a target="_blank" title="<?php echo lang($row['ND_Name']);?>" href="<?php echo base_url('news/fileDownload/uploads/'.downloadName(lang($row['ND_Name'])).'/'.$row['ND_File']);?>">
										<article class="about-item">
											<?php echo lang($row['ND_Name']);?>
										</article>
									</a> -->
								<?php }?>
							<?php }?>

						<!-- <div class="news-file">
							<img src="../../../images/file-ico/pdf.png" alt="" width="25">
							<a href="#!">มท 0305.1/ว 23690 การสำรวจข้อมูลจุดเคาน์เตอร์บริการอำเภอ..ยิ้ม นอกสถานที่ตั้งที่ว่าการอำเภอ ประจำปีงบประมาณ พ.ศ.2559</a>
						</div>

						<div class="news-file">
							<img src="../../../images/file-ico/doc.png" alt="" width="25">
							<a href="#!">มท 0305.1/ว 23690 การสำรวจข้อมูลจุดเคาน์เตอร์บริการอำเภอ..ยิ้ม นอกสถานที่ตั้งที่ว่าการอำเภอ ประจำปีงบประมาณ พ.ศ.2559</a>
						</div>

						<div class="news-file">
							<img src="../../../images/file-ico/ppt.png" alt="" width="25">
							<a href="#!">มท 0305.1/ว 23690 การสำรวจข้อมูลจุดเคาน์เตอร์บริการอำเภอ..ยิ้ม นอกสถานที่ตั้งที่ว่าการอำเภอ ประจำปีงบประมาณ พ.ศ.2559</a>
						</div> -->

					</div>