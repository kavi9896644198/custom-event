<div class="page-content-area">
	<div class="top-heading-title">
		<label>Title:</label>
		<input type="text" name="content_title" value="<?php echo esc_attr( get_post_meta( $post->ID, 'content_title', true ) );?>">
	</div>
	<input type="hidden" name="textcount" id="textid" value="1">
	<input type="hidden" name="photocount" id="photoid" value="1">
	<input type="hidden" name="ticketcount" id="ticketid" value="1">
	<input type="hidden" name="programcount" id="programid" value="1">
	<div class="page-content-repeater">
		<div class="repeater-new-block-main">
			<div class="repeater-new-block">
				<div class="repeater-new-block-inner text-block-repeater">
					<?php 
					$get_data = stripslashes(get_post_meta($post->ID,'save_text',true));
					$save_text = json_decode($get_data,true);
					if(empty($save_text)){
						?>
						<div class="page-content-repeater-col classtextremove1">
						<div class="page-content-repeater-col-box">
							<div class="count-number">1</div>
						</div>
						<div class="page-content-repeater-col-box">
							<div class="block-name"><h3>Text Block</h3></div>
						</div>
						<div class="page-content-repeater-col-box">
							<div class="text-block">
								<textarea name="text[text_block1]"></textarea>
							</div>
						</div>
						<div class="page-content-repeater-col-box">
							<div class="add-remove-btn">

								<a class="remove-text-block remove-block" data-id="classtextremove1"><img src="/wp-content/uploads/2023/05/minus.png"></a>
							</div>
						</div>
					</div>
						<?php 
					}
					
					$save_ticket = json_decode(stripslashes(get_post_meta($post->ID,'save_ticket',true)));
					$save_photo = json_decode(stripslashes(get_post_meta($post->ID,'save_photo',true)));
					$save_program = json_decode(stripslashes(get_post_meta($post->ID,'save_program',true)));
					//echo '<pre>';print_r($save_ticket);die;
					$textcount = get_post_meta($post->ID,'textcount',true);
					$i=1;
					foreach ($save_text as $key => $value){
						$keys= substr($key, 0, -1);
						$keynum = $key[strlen($key)-1];
						if($keys == 'text_block'){
							// echo $i;
							// echo $key;
							?>
							<div class="page-content-repeater-col classtextremove<?php echo $i; ?>" data-lastdivid="<?php echo $keynum; ?>">
									<div class="page-content-repeater-col-box">
										<div class="count-number">
										<?php 
										if($i == 1){
											echo '1';
										}
										?>
										</div>
									</div>
									<div class="page-content-repeater-col-box">
										<div class="block-name"><h3>Text Block</h3></div>
									</div>
									<div class="page-content-repeater-col-box">
										<div class="text-block">
											<textarea name="text[<?php echo $key;?>]"><?php echo esc_attr(trim($value));?></textarea>
										</div>
									</div>
									<div class="page-content-repeater-col-box">
										<div class="add-remove-btn">

											<a class="remove-text-block remove-block" data-id="classtextremove<?php echo $i; ?>"><img src="/wp-content/uploads/2023/05/minus.png"></a>
										</div>
									</div>
								</div>
							<?php 
						}
						if($keys == 'block_photo'){
							?>
							<div class="page-content-repeater-col classtextremove<?php echo $i; ?>" data-lastdivid="<?php echo $keynum; ?>">
								<div class="page-content-repeater-col-box">
									<div class="count-number"></div>
								</div>
								<div class="page-content-repeater-col-box">
									<div class="block-name"><h3>Photo Block</h3></div>
								</div>
								<div class="page-content-repeater-col-box">
									<div class="upload-image-block">
										<div class="upload-image-btn">
											<a href="#" id="img-upload" class="img-upload-class">
												<span id='insert_image'>
													<img src="">
												</span>
												<span>Upload</span></a>
												<a href="#" class="img-upload-Skift">Skift</a>
												<?php //$block_photo = esc_attr( get_post_meta( $post->ID, 'block_photo', true ) );?>
												<input type="hidden" name="text[<?php echo $key;?>]" id="block_photo" value="<?php echo $value;?>">
											</div>
											<div class="upload-image-preview">
												<?php 
												if(!empty($value)){
													?>
													<img src="<?php echo esc_attr($value);?>" alt="">
													<?php 
												}else{
													?>
													<img src="/wp-content/uploads/2023/06/noimage.jpeg" alt="">
													<?php 
												}
												?>
											</div>
										</div>
									</div>
									<div class="page-content-repeater-col-box">
										<div class="add-remove-btn">

											<a class="remove-photo-block remove-block" data-id="classtextremove<?php echo $i; ?>"><img src="/wp-content/uploads/2023/05/minus.png"></a>
										</div>
									</div>
								</div>
							<?php
						}
						if($keys == 'tickettitle'){
							
							$keynum = $key[strlen($key)-1];
							$tickettitle = 'tickettitle'.$keynum;
							$ticketmonth = 'ticketmonth'.$keynum;
							$ticketday = 'ticketday'.$keynum;
							$ticketyear = 'ticketyear'.$keynum;
							$tickethours = 'tickethours'.$keynum;
							$ticketminutes = 'ticketminutes'.$keynum;
							$ticketlink = 'ticketlink'.$keynum;
							?>
							<div class="page-content-repeater-col classtextremove<?php echo $i; ?>" data-lastdivid="<?php echo $keynum; ?>">
						<div class="page-content-repeater-col-box">
							<div class="count-number"></div>
						</div>
						<div class="page-content-repeater-col-box">
							<div class="block-name">
								<h3>Tickets Block</h3>
							</div>
						</div>
						<div class="page-content-repeater-col-box">
							<div class="ticket-block-append" style="width: 100%;">
							<?php $ticket_blocks = json_decode(get_post_meta( $post->ID, 'ticket_blocks', true ));
							//if(!empty($ticket_blocks->ticket_block->ticketmonth)){
							//echo "<pre>";print_r($ticket_blocks);die;
							$ticket_num = 1;
							///foreach ($ticket_blocks->ticket_block->ticketmonth as $keyticketmonth => $valueticketmonth){
							?>
								<div class="ticket-block remove_<?php echo $ticket_num;?>">
										<div class="ticket-block-left">
											<div class="count-number"><?php echo $ticket_num;?>
											</div>
										</div>
									<div class="ticket-block-right">
										<div class="ticket-block-content">
											<div class="ticket-block-content-col">
											<label>Ticket Title</label>
											<input type="text" name="text[tickettitle<?php echo $keynum; ?>]" value="<?php echo $save_text->$tickettitle;?>">
											</div>
											<div class="ticket-block-content-col">
												<label>Ticket Date and time</label>
												<div class="date-col event-date" id="ticket-event-choose">
													<select id="ticketmonth" name="text[ticketmonth<?php echo $keynum; ?>]">
													<!--  <option value="">Select Month</option> -->

													<?php
													//$ticket_blocks->ticket_block->ticketmonth[$keyticketmonth];
													$selected_month = 'ticketmonth'.$keynum; //current month
													for ($i_month = 1; $i_month <= 12; $i_month++) { 
													$selected = $save_text->$selected_month == $i_month ? ' selected' : ''; // If select current month
													//$selected = $monts_select == $i_month ? ' selected' : '';
													echo '<option value="'.$i_month.'" '.$selected .'>'. date('F', mktime(0,0,0,$i_month)).'</option>'."\n";
													}
													?>
													</select>
													<select id="ticketday" name="text[ticketday<?php echo $keynum; ?>]">
													<!-- <option value="">Select Day</option> -->
													<?php
													$selected_day = 'ticketday'.$keynum;
													//$selected_day = date('d'); //current day
													for ($i_day = 1; $i_day <= 31; $i_day++) { 
													$selected = $save_text->$selected_day == $i_day ? ' selected' : '';
													echo '<option value="'.$i_day.'"'.$selected.'>'.$i_day.'</option>'."\n";
													}
													?>
													</select>
													<select id="ticketyear" name="text[ticketyear<?php echo $keynum; ?>]">
													<!-- <option value="">Select Year</option> -->
													<?php 
													$year_start  = date('Y');
													$year_end = date('Y')+30; // current Year
													$selected_year = 'ticketyear'.$keynum;// user date of birth year
													// $year_select = esc_attr( get_post_meta( $post->ID, 'year', true ) ); 
													for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
													$selected = $save_text->$selected_year == $i_year ? ' selected' : '';
													echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
													}
													?>
													</select>
													<select id="tickethours" name="text[tickethours<?php echo $keynum; ?>]">
													<?php 
													$selected_d = 'tickethours'.$keynum;
													for ($i_day = 1; $i_day <= 24; $i_day++) { 
													$selected = $save_text->$selected_d == $i_day ? ' selected' : '';
													if($i_day <= 9 ){
													echo '<option value="'.$i_day.'" '.$selected.'>0'.$i_day.'</option>'."\n";
													}else{
													echo '<option value="'.$i_day.'" '.$selected.'>'.$i_day.'</option>'."\n";
													}
													}
													?>
													</select>
													<select id="ticketminutes" name="text[ticketminutes<?php echo $keynum; ?>]">
													<?php 
													$selected_t = 'ticketminutes'.$keynum;
													for ($i_day = 0; $i_day <= 60; $i_day++) { 
													$selected = $save_text->$selected_t == $i_day ? ' selected' : '';
													if($i_day <= 9 ){
													echo '<option value="'.$i_day.'" '.$selected.'>0'.$i_day.'</option>'."\n";
													}else{
													echo '<option value="'.$i_day.'" '.$selected.'>'.$i_day.'</option>'."\n";
													}

													}
													?>
													</select>
													<?php 
													$checkdata = 'ticketnodatenodate'.$keynum;
													$checked = ($save_text->$checkdata == 1) ? 'checked' : '';
													?>
													<div class="event-date-col">
														<input type="checkbox" id="ticketnodate" name="text[ticketnodatenodate<?php echo $keynum; ?>]" value="1" <?php echo $checked;?>>
														<label for="nodate"> No Date</label>
													</div>

												</div>
											</div> 
											<div class="ticket-block-content-col">
											<label>LifePeaks Link:</label>
											<input type="text" name="text[ticketlink<?php echo $keynum; ?>]" value="<?php echo $save_text->$ticketlink;?>">
											</div>
										</div>
										<!-- <div class="delete-btn">
											<a class="remove_field" data-id="<?php echo $ticket_num;?>">Delete</a>
										</div> -->
									</div>
								</div>
							<?php 
							$ticket_num++;
							//} 
							//}
							?>
							</div>
							<!-- <div class="add-more">
							<a class="add-ticket-block" >Add More</a>
							</div> -->
						</div>
						<div class="page-content-repeater-col-box">
						<div class="add-remove-btn">

						<a class="remove-block remove-ticket-block" data-id="classtextremove<?php echo $i; ?>"><img src="/wp-content/uploads/2023/05/minus.png"></a>
						</div>
						</div>
					</div>
							<?php 
						}
			if($keys == 'block_day'){
				$keynum = $key[strlen($key)-1];
				$block_day = 'block_day'.$keynum;
				$timehours = 'timehours'.$keynum;
				$timeminutes = 'timeminutes'.$keynum;
				$ticket_description = 'ticket_description'.$keynum;
				?>
				<div class="page-content-repeater-col classtextremove<?php echo $i; ?>" data-lastdivid="<?php echo $keynum; ?>">
					<div class="page-content-repeater-col-box">
						<div class="count-number"></div>
					</div>
					<div class="page-content-repeater-col-box">
						<div class="block-name"><h3>Program Block</h3></div>
					</div>
					<div class="page-content-repeater-col-box">
						<!-- <div class="top-heading-title">
							<label>Block Title</label>
							<input type="text" name="program_block_title" value="<?php //echo get_post_meta( $post->ID, 'program_block_title', true );?>">
						</div> -->
						<div class="add_timeblock" style="display: none;">
							<select id="timehoursd">
								<?php 
								for ($i_day = 1; $i_day <= 24; $i_day++) { 
									if($i_day <= 9 ){
										echo '<option value="'.$i_day.'">0'.$i_day.'</option>'."\n";
									}else{
										echo '<option value="'.$i_day.'">'.$i_day.'</option>'."\n";
									}
								}
								?>
							</select>
							<select id="timeminutesddd">
								<?php 
								for ($i_day = 0; $i_day <= 60; $i_day++) { 
									        //$selected = $selected_day == $i_day ? ' selected' : '';
									if($i_day <= 9 ){
										echo '<option value="'.$i_day.'">0'.$i_day.'</option>'."\n";
									}else{
										echo '<option value="'.$i_day.'">'.$i_day.'</option>'."\n";
									}
								}
								?>
							</select>		
						</div>
						<div class="mainticketblock" style="width: 100%;">
							<?php $blocks_days = json_decode(get_post_meta( $post->ID, 'blocks_days', true ));
					//echo "<pre>";print_r($blocks_days);die;	
							//if(count($blocks_days) <= 1){ 
								
								$selectedblock_day = 'block_day'.$keynum;
								$selectdays = $save_text->$selectedblock_day;
								?>
								<div class="ticket-block">
									<div class="program-block-left">
										<div class="count-number">1</div>
									</div>

									<div class="ticket-block-right">
										<div class="ticket-block-content">
											<div class="ticket-block-content-col">
												<label>Choose Day</label>
												<select class="choose-day" name="text[block_day<?php echo $keynum; ?>]">
													<option value="monday" <?php if($selectdays == 'monday'){echo 'selected';}?>>Monday</option>
													<option value="tuesday" <?php if($selectdays == 'tuesday'){echo 'selected';}?>>Tuesday</option>
													<option value="wednesday" <?php if($selectdays == 'wednesday'){echo 'selected';}?>>Wednesday</option>
													<option value="thursday" <?php if($selectdays == 'thursday'){echo 'selected';}?>>Thursday</option>
													<option value="friday" <?php if($selectdays == 'friday'){echo 'selected';}?>>Friday</option>
													<option value="saturday" <?php if($selectdays == 'saturday'){echo 'selected';}?>>Saturday</option>
													<option value="sunday" <?php if($selectdays == 'sunday'){echo 'selected';}?>>Sunday</option>
												</select>
											</div>
											<div class="ticket-block-content-col">
												<div class="time-frame" id="timeid_<?php echo $keynum;?>">
													<?php $programs_block = json_decode(get_post_meta( $post->ID, 'programs_block', true ));
				//echo "<pre>";print_r($blocks_days);
													$prognum = 1;
													//foreach ($blocks_days[0]->{0} as $keyprogram => $valueprogram) {

													foreach ($save_text->$timehours as $key_program => $valueprogram) {
														//echo $key_program;
														?>

														<div class="time-frame-repeater time_remove_<?php echo $keynum;?>_<?php echo $key_program;?>">
															<div class="time-frame-col-left">
																<label>Time Frames</label>
																<div class="event-date" id="ticket-time">

																	<select id="timehours" name="text[timehours<?php echo $keynum; ?>][<?php echo $key_program;?>]">
																		<?php

																		$selected_blockday = $valueprogram;
																		for ($i_day = 1; $i_day <= 24; $i_day++) { 
																			$selectedtime = $selected_blockday == $i_day ? ' selected' : '';
																			if($i_day <= 9 ){
																				echo '<option value="'.$i_day.'" '.$selectedtime.'>0'.$i_day.'</option>'."\n";
																			}else{
																				echo '<option value="'.$i_day.'" '.$selectedtime.'>'.$i_day.'</option>'."\n";
																			}
																		}

																		?>
																	</select>
<?php //echo "<pre>";print_r($save_text->$timeminutes);?>
																	<select id="timeminutes" name="text[timeminutes<?php echo $keynum; ?>][<?php echo $key_program;?>]">
																		<?php 

																		for ($i_day = 0; $i_day <= 60; $i_day++) { 
																			$selectedday = $save_text->$timeminutes->$key_program == $i_day ? ' selected' : '';
																			if($i_day <= 9 ){
																				echo '<option value="'.$i_day.'" '.$selectedday.'>0'.$i_day.'</option>'."\n";
																			}else{
																				echo '<option value="'.$i_day.'" '.$selectedday.'>'.$i_day.'</option>'."\n";
																			}
																		}
																		$desctime = 'ticket_description'.$keynum;
																		?>
																	</select>
																	<?php //die("Fsfs");?>
																</div>
															</div>
															<div class="time-frame-col-right">
																<label>Description</label>
																<input type="text" name="text[ticket_description<?php echo $keynum; ?>][<?php echo $key_program;?>]" value="<?php echo $save_text->$desctime->$key_program ;?>">
															</div>
															<div class="delete-time-frame">
																<a class="time_frame_remove" data-id="time_remove_<?php echo $keynum;?>_<?php echo $key_program;?>"><img src="/wp-content/uploads/2023/05/delete12_1.png"></a>
															</div>
														</div>
														<?php
													}
													
													 ?>
												</div>
											</div>
										</div>
										<div class="add-time">
											<a class="add-times" data-num="<?php echo $keynum;?>" data-block="text" data-id="timeid_<?php echo $keynum;?>" datanum="1">Add Time</a>
										</div>
									</div>
								</div>
							<?php// } ?>
						</div>
						<!-- <div class="add-more add-day">
							<a class="add_dayID">Add Day</a>
						</div> -->
					</div>
					<div class="page-content-repeater-col-box">
						<div class="add-remove-btn">
							<a class="remove-block add_remove_program" data-id="classtextremove<?php echo $i; ?>"><img src="/wp-content/uploads/2023/05/minus.png"></a>
						</div>
					</div>
				</div>
			<?php 
		}
		//echo "<pre>";print_r($key);
		$i++;
	}
					
					?>
				</div>
				<div class="add_all_blocks">
					<a href="javascript:void(0)" data-block="text" class="add-block select_block_option"><img src="/wp-content/uploads/2023/05/plus.png"></a>
					<select id="select_block_text" data-block_text='text' style="display: none;" data-block="text-block-repeater">
						<option value="">Select Block</option>
						<option value="add-block-text" class="text_block_id" data-textcount="1">Text Block</option>
						<option value="photo-block-add-btn" id="photo_block_id">Photo Block</option>
						<option value="add_ticket_block" id="ticket_block_id">Tickets Block</option>
						<option value="add_program_block" class="program_block_id" data-textcount="1">Program Block</option>
					</select>
				</div>
			</div>
			<div class="repeater-new-block">
				<div class="repeater-new-block-inner photo-block-repeater">
					<?php 
					$text_block_main = json_decode(get_post_meta( $post->ID, 'block_photo', true ));
					
						$i=1;
						if(empty($save_photo)){
							?>
							<div class="page-content-repeater-col classphotoremove1">
								<div class="page-content-repeater-col-box">
									<div class="count-number">2</div>
								</div>
								<div class="page-content-repeater-col-box">
									<div class="block-name"><h3>Photo Block</h3></div>
								</div>
								<div class="page-content-repeater-col-box">
									<div class="upload-image-block">
										<div class="upload-image-btn">
											<a href="#" id="img-upload" class="img-upload-class">
												<span id='insert_image'>
													<img src="">
												</span>
												<span>Upload</span></a>
												<a href="#" class="img-upload-Skift">Skift</a>
												<?php //$block_photo = esc_attr( get_post_meta( $post->ID, 'block_photo', true ) );?>
												<input type="hidden" name="photo[block_photo1]" id="block_photo" value="<?php echo $value;?>">
											</div>
											<div class="upload-image-preview">
												<?php 
												if(!empty($value)){
													?>
													<img src="<?php echo $value;?>">
													<?php 
												}else{
												?>
												<img src="/wp-content/uploads/2023/06/noimage.jpeg">
												<?php 
											}
												?>
											</div>
										</div>
									</div>
									<div class="page-content-repeater-col-box">
										<div class="add-remove-btn">

											<a class="remove-photo-block remove-block" data-id="classphotoremove1"><img src="/wp-content/uploads/2023/05/minus.png"></a>
										</div>
									</div>
								</div>
								<?php 
								$i++;
							}else{
						include EVENTS_PATH . '/includes/custom-fields/event-contenttwo.php';
					 
							}
							?>
						</div>
						<!-- <a href="#" class="add-block photo-block-add-btn"><img src="/wp-content/uploads/2023/05/plus.png"></a> -->
						<div class="add_all_blocks">
							<a href="javascript:void(0)" data-block="photo" class="add-block select_block_option"><img src="/wp-content/uploads/2023/05/plus.png"></a>
							<select id="select_block_photo" data-block_text='photo' style="display: none;" data-block="photo-block-repeater">
								<option value="">Select Block</option>
								<option value="add-block-text" class="text_block_id" data-textcount="1">Text Block</option>
								<option value="photo-block-add-btn" id="photo_block_id">Photo Block</option>
								<option value="add_ticket_block" id="ticket_block_id">Tickets Block</option>
								<option value="add_program_block" class="program_block_id" data-textcount="1">Program Block</option>
							</select>
						</div>
			</div>
			<div class="ticket-block_add_extra repeater-new-block">
				<div class="repeater-new-block-inner ticket-block-repeater">
					<?php 
					if(empty($save_ticket)){
						?>
						<div class="page-content-repeater-col classticketremove1" >
						<div class="page-content-repeater-col-box">
							<div class="count-number">3</div>
						</div>
						<div class="page-content-repeater-col-box">
							<div class="block-name">
								<h3>Tickets Block</h3>
							</div>
						</div>
						<div class="page-content-repeater-col-box">
							<div class="ticket-block-append" style="width: 100%;">
							<?php $ticket_blocks = json_decode(get_post_meta( $post->ID, 'ticket_blocks', true ));
							if(!empty($ticket_blocks->ticket_block->ticketmonth)){
							//echo "<pre>";print_r($ticket_blocks);die;
							$ticket_num = 1;
							foreach ($ticket_blocks->ticket_block->ticketmonth as $keyticketmonth => $valueticketmonth){
							?>
								<div class="ticket-block remove_<?php echo $ticket_num;?>">
										<div class="ticket-block-left">
											<div class="count-number"><?php echo $ticket_num;?>
											</div>
										</div>
									<div class="ticket-block-right">
										<div class="ticket-block-content">
											<div class="ticket-block-content-col">
											<label>Ticket Title</label>
											<input type="text" name="ticket[tickettitle1]" value="<?php echo $ticket_blocks->ticket_block->tickettitle[$keyticketmonth];?>">
											</div>
											<div class="ticket-block-content-col">
												<label>Ticket Date and time</label>
												<div class="date-col event-date" id="ticket-event-choose">
													<select id="ticketmonth" name="ticket[ticketmonth1]" valu>
													<!--  <option value="">Select Month</option> -->

													<?php
													//$ticket_blocks->ticket_block->ticketmonth[$keyticketmonth];
													$selected_month = $ticket_blocks->ticket_block->ticketmonth[$keyticketmonth]; //current month
													for ($i_month = 1; $i_month <= 12; $i_month++) { 
													$selected = $selected_month == $i_month ? ' selected' : ''; // If select current month
													//$selected = $monts_select == $i_month ? ' selected' : '';
													echo '<option value="'.$i_month.'" '.$selected .'>'. date('F', mktime(0,0,0,$i_month)).'</option>'."\n";
													}
													?>
													</select>
													<select id="ticketday" name="ticket[ticketday1]">
													<!-- <option value="">Select Day</option> -->
													<?php
													$selected_day = $ticket_blocks->ticket_block->ticketday[$keyticketmonth];
													//$selected_day = date('d'); //current day
													for ($i_day = 1; $i_day <= 31; $i_day++) { 
													$selected = $selected_day == $i_day ? ' selected' : '';
													echo '<option value="'.$i_day.'"'.$selected.'>'.$i_day.'</option>'."\n";
													}
													?>
													</select>
													<select id="ticketyear" name="ticket[ticketyear1]">
													<!-- <option value="">Select Year</option> -->
													<?php 
													$year_start  = date('Y');
													$year_end = date('Y')+30; // current Year
													$selected_year = $ticket_blocks->ticket_block->ticketyear[$keyticketmonth];// user date of birth year
													// $year_select = esc_attr( get_post_meta( $post->ID, 'year', true ) ); 
													for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
													$selected = $selected_year == $i_year ? ' selected' : '';
													echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
													}
													?>
													</select>
													<select id="tickethours" name="ticket[tickethours1]">
													<?php 
													$selected_d = $ticket_blocks->ticket_block->tickethours[$keyticketmonth];
													for ($i_day = 1; $i_day <= 24; $i_day++) { 
													$selected = $selected_d == $i_day ? ' selected' : '';
													if($i_day <= 9 ){
													echo '<option value="'.$i_day.'" '.$selected.'>0'.$i_day.'</option>'."\n";
													}else{
													echo '<option value="'.$i_day.'" '.$selected.'>'.$i_day.'</option>'."\n";
													}
													}
													?>
													</select>
													<select id="ticketminutes" name="ticket[ticketminutes1]">
													<?php 
													$selected_t = $ticket_blocks->ticket_block->ticketminutes[$keyticketmonth];
													for ($i_day = 0; $i_day <= 60; $i_day++) { 
													$selected = $selected_t == $i_day ? ' selected' : '';
													if($i_day <= 9 ){
													echo '<option value="'.$i_day.'" '.$selected.'>0'.$i_day.'</option>'."\n";
													}else{
													echo '<option value="'.$i_day.'" '.$selected.'>'.$i_day.'</option>'."\n";
													}

													}
													?>
													</select>
													<?php 
													$checked = ($ticket_blocks->ticket_block->ticketnodatenodate[$keyticketmonth] == 1) ? 'checked' : '';
													?>
													<div class="event-date-col">
														<input type="checkbox" id="ticketnodate" name="ticket[ticketnodatenodate1]" value="1" <?php echo $checked;?>>
														<label for="nodate"> No Date</label>
													</div>

												</div>
											</div> 
											<div class="ticket-block-content-col">
											<label>LifePeaks Link:</label>
											<input type="text" name="ticket[ticketlink1]" value="<?php echo $ticket_blocks->ticket_block->ticketlink[$keyticketmonth];?>">
											</div>
										</div>
										<!-- <div class="delete-btn">
											<a class="remove_field" data-id="<?php echo $ticket_num;?>">Delete</a>
										</div> -->
									</div>
								</div>
							<?php 
							$ticket_num++;
							} 
							}else{
							?>
							<div class="ticket-block remove_1">
								<div class="ticket-block-left">
									<div class="count-number">1</div>
								</div>
								<div class="ticket-block-right">
									<div class="ticket-block-content">
										<div class="ticket-block-content-col">
										<label>Ticket Title</label>
										<input type="text" name="ticket[tickettitle1]" value="">
										</div>
										<div class="ticket-block-content-col">
											<label>Ticket Date and time</label>
											<div class="date-col event-date" id="ticket-event-choose">
												<select id="ticketmonth" name="ticket[ticketmonth1" valu>
												<?php
												$selected_month = date('m'); //current month
												for ($i_month = 1; $i_month <= 12; $i_month++) {
												echo '<option value="'.$i_month.'">'. date('F', mktime(0,0,0,$i_month)).'</option>'."\n";
												}
												?>
												</select>
												<select id="ticketday" name="ticket[ticketday1]">
												<?php
												$selected_day = date('d'); //current day
												for ($i_day = 1; $i_day <= 31; $i_day++) { 
												$selected = $selected_day == $i_day ? ' selected' : '';
												echo '<option value="'.$i_day.'"'.$selected.'>'.$i_day.'</option>'."\n";
												}
												?>
												</select>
												<select id="ticketyear" name="ticket[ticketyear1">
												<?php 
												$year_start  = date('Y');
												$year_end = date('Y')+30; // current Year
												$selected_year = 2023; 
												for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
												$selected = $selected_year == $i_year ? ' selected' : '';
												echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
												}
												?>
												</select>

												<select id="tickethours" name="ticket[tickethours1">
												<?php 

												for ($i_day = 1; $i_day <= 24; $i_day++) { 
												if($i_day <= 9 ){
												echo '<option value="'.$i_day.'">0'.$i_day.'</option>'."\n";
												}else{
												echo '<option value="'.$i_day.'">'.$i_day.'</option>'."\n";
												}
												}
												?>
												</select>

												<select id="ticketminutes" name="ticket[ticketminutes1]">
												<?php 

												for ($i_day = 0; $i_day <= 60; $i_day++) {
												if($i_day <= 9 ){
												echo '<option value="'.$i_day.'">0'.$i_day.'</option>'."\n";
												}else{
												echo '<option value="'.$i_day.'">'.$i_day.'</option>'."\n";
												}
												}
												?>
												</select>

											<div class="event-date-col">
												<input type="checkbox" id="ticketnodate" name="ticket[ticketnodatenodate1]" value="1" >
												<label for="nodate"> No Date</label>
											</div>
											</div>
										</div> 
										<div class="ticket-block-content-col">
											<label>LifePeaks Link:</label>
											<input type="text" name="ticket[ticketlink1]" value="">
										</div>
									</div>
									<div class="delete-btn">
									<a class="remove_field" data-id="1">Delete</a>
									</div>
								</div>
							</div>
							<?php } ?>
							</div>
							<!-- <div class="add-more">
							<a class="add-ticket-block" >Add More</a>
							</div> -->
						</div>
						<div class="page-content-repeater-col-box">
						<div class="add-remove-btn">

						<a class="remove-block remove-ticket-block" data-id="classticketremove1"><img src="/wp-content/uploads/2023/05/minus.png"></a>
						</div>
						</div>
					</div>
						<?php 
					}else{
					include EVENTS_PATH . '/includes/custom-fields/event-contentone.php';
					}
					?>
				</div>
			<!-- <a href="#" class="add-block add_ticket_block"><img src="/wp-content/uploads/2023/05/plus.png"></a> -->
				<div class="add_all_blocks">
				<a href="javascript:void(0)" data-block="ticket" class="add-block select_block_option"><img src="/wp-content/uploads/2023/05/plus.png"></a>
				<select id="select_block_ticket" style="display: none;" data-block_text='ticket' data-block="ticket-block-repeater">
				<option value="">Select Block</option>
				<option value="add-block-text" class="text_block_id" data-textcount="1">Text Block</option>
				<option value="photo-block-add-btn" id="photo_block_id">Photo Block</option>
				<option value="add_ticket_block" id="ticket_block_id">Tickets Block</option>
				<option value="add_program_block" class="program_block_id" data-textcount="1">Program Block</option>
				</select>
				</div>
			</div>

			<div class="program-block_add_extra repeater-new-block">
				<div class="repeater-new-block-inner program-block-repeater">
					<?php 
					if(empty($save_program)){
						?>
						<div class="page-content-repeater-col classprogramremove1">
						<div class="page-content-repeater-col-box">
							<div class="count-number">4</div>
						</div>
						<div class="page-content-repeater-col-box">
							<div class="block-name"><h3>Program Block</h3></div>
						</div>
						<div class="page-content-repeater-col-box">
							<!-- <div class="top-heading-title">
								<label>Block Title</label>
								<input type="text" name="program[program_block_title]" value="<?php echo get_post_meta( $post->ID, 'program_block_title', true );?>">
							</div> -->
							<div class="add_timeblock" style="display: none;">
								<select id="timehoursd">
									<?php 
									for ($i_day = 1; $i_day <= 24; $i_day++) { 
										if($i_day <= 9 ){
											echo '<option value="'.$i_day.'">0'.$i_day.'</option>'."\n";
										}else{
											echo '<option value="'.$i_day.'">'.$i_day.'</option>'."\n";
										}
									}
									?>
								</select>
								<select id="timeminutesddd">
									<?php 
									for ($i_day = 0; $i_day <= 60; $i_day++) { 
												        //$selected = $selected_day == $i_day ? ' selected' : '';
										if($i_day <= 9 ){
											echo '<option value="'.$i_day.'">0'.$i_day.'</option>'."\n";
										}else{
											echo '<option value="'.$i_day.'">'.$i_day.'</option>'."\n";
										}
									}
									?>
								</select>		
							</div>
							<div class="mainticketblock" style="width: 100%;">
								<?php $blocks_days = json_decode(get_post_meta( $post->ID, 'blocks_days', true ));
								//echo "<pre>";print_r($blocks_days);die;	
								//if(count($blocks_days) <= 1){ 
									if(isset($blocks_days[0]->day)){
										$selectdays = $blocks_days[0]->day;
									}else{
										$selectdays = '';
									}

									?>
									<div class="ticket-block">
										<div class="program-block-left">
											<div class="count-number">1</div>
										</div>

										<div class="ticket-block-right">
											<div class="ticket-block-content">
												<div class="ticket-block-content-col">
													<label>Choose Day</label>
													<select class="choose-day" name="program[block_day1][1]">
														<option value="monday" <?php if($selectdays == 'monday'){echo 'selected';}?>>Monday</option>
														<option value="tuesday" <?php if($selectdays == 'tuesday'){echo 'selected';}?>>Tuesday</option>
														<option value="wednesday" <?php if($selectdays == 'wednesday'){echo 'selected';}?>>Wednesday</option>
														<option value="thursday" <?php if($selectdays == 'thursday'){echo 'selected';}?>>Thursday</option>
														<option value="friday" <?php if($selectdays == 'friday'){echo 'selected';}?>>Friday</option>
														<option value="saturday" <?php if($selectdays == 'saturday'){echo 'selected';}?>>Saturday</option>
														<option value="sunday" <?php if($selectdays == 'sunday'){echo 'selected';}?>>Sunday</option>
													</select>
												</div>
												<div class="ticket-block-content-col">
													<div class="time-frame" id="timeid_1">
														<?php $programs_block = json_decode(get_post_meta( $post->ID, 'programs_block', true ));
							//echo "<pre>";print_r($blocks_days);
														$program_num = 1;
														// foreach ($blocks_days[0]->{0} as $keyprogram => $valueprogram) {

															?>
															<div class="time-frame-repeater time_remove_11">
																<div class="time-frame-col-left">
																	<label>Time Frames</label>
																	<div class="event-date" id="ticket-time">
																		<select id="timehours" name="program[timehours1][1]">
																			<?php 

																			for ($i_day = 1; $i_day <= 24; $i_day++) { 
																				$selectedtime = $blocks_days[0]->{0}[$keyprogram] == $i_day ? ' selected' : '';
																				if($i_day <= 9 ){
																					echo '<option value="'.$i_day.'" '.$selectedtime.'>0'.$i_day.'</option>'."\n";
																				}else{
																					echo '<option value="'.$i_day.'" '.$selectedtime.'>'.$i_day.'</option>'."\n";
																				}
																			}
																			?>
																		</select>

																		<select id="timeminutes" name="program[timeminutes1][1]">
																			<?php 

																			for ($i_day = 0; $i_day <= 60; $i_day++) { 
																				$selectedday = $blocks_days[0]->{1}[$keyprogram] == $i_day ? ' selected' : '';
																				if($i_day <= 9 ){
																					echo '<option value="'.$i_day.'" '.$selectedday.'>0'.$i_day.'</option>'."\n";
																				}else{
																					echo '<option value="'.$i_day.'" '.$selectedday.'>'.$i_day.'</option>'."\n";
																				}
																			}
																			?>
																		</select>
																	</div>
																</div>
																<div class="time-frame-col-right">
																	<label>Description</label>
																	<input type="text" name="program[ticket_description1][1]" value="">
																</div>
																<div class="delete-time-frame">
																	<a class="time_frame_remove" data-id="time_remove_11"><img src="/wp-content/uploads/2023/05/delete12_1.png"></a>
																</div>
															</div>
														<?php //} ?>
													</div>
												</div>
											</div>
											<div class="add-time">
												<a class="add-times" data-num="1" data-block="program" data-id="timeid_1" datanum="1">Add Time</a>
											</div>
										</div>
									</div>
								
							</div>
							<!-- <div class="add-more add-day">
								<a class="add_dayID">Add Day</a>
							</div> -->
						</div>
						<div class="page-content-repeater-col-box">
							<div class="add-remove-btn">
								<a class="remove-block add_remove_program" data-id="classprogramremove1"><img src="/wp-content/uploads/2023/05/minus.png"></a>
							</div>
						</div>
					</div>
						<?php 
					   }else{
					   	include EVENTS_PATH . '/includes/custom-fields/event-contentthree.php';
					   }
					?>
					
				</div>
				<!-- <a href="#" class="add-block add_program_block"><img src="/wp-content/uploads/2023/05/plus.png"></a> -->
				<div class="add_all_blocks">
					<a href="javascript:void(0)" data-block="program" class="add-block select_block_option"><img src="/wp-content/uploads/2023/05/plus.png"></a>
					<select id="select_block_program" style="display: none;" data-block_text='program' data-block="program-block-repeater">
						<option value="">Select Block</option>
						<option value="add-block-text" class="text_block_id" data-textcount="1">Text Block</option>
						<option value="photo-block-add-btn" id="photo_block_id">Photo Block</option>
						<option value="add_ticket_block" id="ticket_block_id">Tickets Block</option>
						<option value="add_program_block" class="program_block_id" data-textcount="1">Program Block</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	
			<?php 
			 submit_button( 'Save' );
	?>
</div>

	
		<div class="date-col event-date" id="ticket-event-choose2" style="display: none;">
		<?php
		//$ticket_blocks->ticket_block->ticketmonth[$keyticketmonth];
		    $selected_month = date('m'); //current month
		    for ($i_month = 1; $i_month <= 12; $i_month++) { 
		        //$selected = $selected_month == $i_month ? ' selected' : ''; // If select current month
		        //$selected = $monts_select == $i_month ? ' selected' : '';
		    	echo '<option value="'.$i_month.'">'. date('F', mktime(0,0,0,$i_month)).'</option>'."\n";
		    }
		    ?>
		</div>
	
		<div class="date-col event-date" id="ticket-event-choose3" style="display: none;">
		<?php
	    //$day_select = esc_attr( get_post_meta( $post->ID, 'day', true ) ); 
	    $selected_day = date('d'); //current day
	    for ($i_day = 1; $i_day <= 31; $i_day++) { 
	    	$selected = $selected_day == $i_day ? ' selected' : '';
	    	echo '<option value="'.$i_day.'"'.$selected.'>'.$i_day.'</option>'."\n";
	    }
	    ?>
	</div>
	<div class="date-col event-date" id="ticket-event-choose4" style="display: none;">
	
		<!-- <option value="">Select Year</option> -->
		<?php 
		$year_start  = date('Y');
	    $year_end = date('Y')+30; // current Year
	    $selected_year = 2023; // user date of birth year
	   // $year_select = esc_attr( get_post_meta( $post->ID, 'year', true ) ); 
	    for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
	    	$selected = $selected_year == $i_year ? ' selected' : '';
	    	echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
	    }
	    ?>
	</div>
	<div class="date-col event-date" id="ticket-event-choose5" style="display: none;">
	
		<?php 
		for ($i_day = 1; $i_day <= 24; $i_day++) { 
			if($i_day <= 9 ){
				echo '<option value="'.$i_day.'">0'.$i_day.'</option>'."\n";
			}else{
				echo '<option value="'.$i_day.'">'.$i_day.'</option>'."\n";
			}
		}
		?>
	</div>
	<div class="date-col event-date" id="ticket-event-choose6" style="display: none;">
	
		<?php 
		for ($i_day = 0; $i_day <= 60; $i_day++) { 
	        //$selected = $selected_day == $i_day ? ' selected' : '';
			if($i_day <= 9 ){
				echo '<option value="'.$i_day.'">0'.$i_day.'</option>'."\n";
			}else{
				echo '<option value="'.$i_day.'">'.$i_day.'</option>'."\n";
			}
		}
		?>
	</div>
	

<select id="timehoursd2" style="display: none;">
	<?php 
	for ($i_day = 1; $i_day <= 24; $i_day++) { 
		if($i_day <= 9 ){
			echo '<option value="'.$i_day.'">0'.$i_day.'</option>'."\n";
		}else{
			echo '<option value="'.$i_day.'">'.$i_day.'</option>'."\n";
		}
	}
	?>
</select>
<select id="timeminutesddd2" style="display: none;">
	<?php 
	for ($i_day = 0; $i_day <= 60; $i_day++) { 
				        //$selected = $selected_day == $i_day ? ' selected' : '';
		if($i_day <= 9 ){
			echo '<option value="'.$i_day.'">0'.$i_day.'</option>'."\n";
		}else{
			echo '<option value="'.$i_day.'">'.$i_day.'</option>'."\n";
		}
	}
	?>
</select>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
		
		    var max_fields      = 20;
		    var wrapper         = jQuery(".ticket-block-append");
		    var wrapper2         = jQuery(".ticket-block_add_extra");
		    var add_button      = jQuery(".add-ticket-block");
		    var add_button2      = jQuery(".add_ticket_block");
		    var height = jQuery(".ticket-block-append .ticket-block").length;
		    //alert(height);
		    var x = height; 
		    //alert(x);
		    jQuery(add_button).click(function(e){ 
		        e.preventDefault();
		        if(x < max_fields){ 
		            x++;
		            //jQuery("#id_"+ids+" .cat-list-col-sub-col-add").append('');
		            var date_time = jQuery("#ticket-event-choose").html();
		            $(wrapper).append('<div class="ticket-block remove_'+x+'"><div class="ticket-block-left"><div class="count-number">'+x+'</div></div><div class="ticket-block-right"><div class="ticket-block-content"><div class="ticket-block-content-col"><label>Ticket Title</label><input type="text" name="tickettitle[]"></div><div class="ticket-block-content-col"><label>Ticket Date and time</label><div class="date-col event-date">'+date_time+'</div></div><div class="ticket-block-content-col"><label>LifePeaks Link:</label><input type="text" name="ticketlink[]"></div></div><div class="delete-btn"><a class="remove_field" data-id="'+x+'">Delete</a></div></div></div>');
		        }
		    });
		    jQuery(add_button2).click(function(e){ 
		        e.preventDefault();
		        if(x < max_fields){ 
		            x++;
		            //jQuery("#id_"+ids+" .cat-list-col-sub-col-add").append('');
		            var date_time = jQuery("#ticket-event-choose").html();
		            $(wrapper2).append('<div class="page-content-repeater-col classtextremove'+x+'"><div class="page-content-repeater-col-box"><div class="count-number">3</div></div><div class="page-content-repeater-col-box"><div class="block-name"><h3>Tickets Block</h3></div></div><div class="page-content-repeater-col-box"><div class="ticket-block-append" style="width: 100%;"><div class="ticket-block remove_'+x+'"><div class="ticket-block-left"><div class="count-number">'+x+'</div></div><div class="ticket-block-right"><div class="ticket-block-content"><div class="ticket-block-content-col"><label>Ticket Title</label><input type="text" name="tickettitle[]"></div><div class="ticket-block-content-col"><label>Ticket Date and time</label><div class="date-col event-date">'+date_time+'</div></div><div class="ticket-block-content-col"><label>LifePeaks Link:</label><input type="text" name="ticketlink[]"></div></div><div class="delete-btn"><a class="remove_field" data-id="'+x+'">Delete</a></div></div></div></div></div><div class="page-content-repeater-col-box"><div class="add-remove-btn"><a class="remove-ticket-block remove-block" data-id="classtextremove'+x+'"><img src="/wp-content/uploads/2023/05/minus.png"></a></div></div></div>');
		        }
		    });

		    jQuery(wrapper).on("click",".remove_field", function(e){ 
		        e.preventDefault(); 
		        dataid = jQuery(this).attr("data-id");
		        jQuery(".remove_"+dataid).remove(); 
		        x--;
		    });
		    jQuery(wrapper2).on("click",".remove-ticket-block", function(e){ 
		        e.preventDefault(); 
		        dataid = jQuery(this).attr("data-id");
		       
				swal({
					  title: "Are you sure want to delete block?",
					  text: "",
					  icon: "warning",
					  buttons: true,
				      dangerMode: true,
				      buttons: ['No', 'Yes'],
					  dangerMode: true,
					})
					.then((willDelete) =>{
					  if (willDelete){
					  	jQuery("."+dataid).remove();  
						x--;
					  }
					});
		    });

		    function removeDiv(){
		    	//jQuery(wrapper2).on("click",".remove-ticket-block", function(e){ 
		    	jQuery(".remove-ticket-block, .add_remove_program, .remove-block").click(function(){
		       // alert("fdfd"); 
		        dataid = jQuery(this).attr("data-id");
		       
				swal({
					  title: "Are you sure want to delete block?",
					  text: "",
					  icon: "warning",
					  buttons: true,
				      dangerMode: true,
				      buttons: ['No', 'Yes'],
					  dangerMode: true,
					})
					.then((willDelete) =>{
					  if (willDelete){
					  	jQuery("."+dataid).remove();  
						x--;
					  }
					});
		    });
		    }

		    // Add Time Frame

		    var time_fields      = 20;
		    var timwwrapper         = jQuery(".time-frame");
		    var add_timebutton      = jQuery(".add-times");

		    var timenum = 1; 
		    jQuery(add_timebutton).click(function(e){ 
		        e.preventDefault();
		        var timeID = jQuery(this).attr("data-id");
		        var datablock = jQuery(this).attr("data-block");
		        var data_num = jQuery(this).attr("data-num");
		        var datanum = jQuery(this).attr("datanum");
		        var addDiv = jQuery(".mainticketblock .time-frame").length;
		        var length = jQuery("#timeid_"+addDiv+" .time-frame-repeater").length + 1;
		        var totallengyt = jQuery("#"+timeID+" .time-frame-repeater").length + 1;
		        //alert(totallengyt);
		       // alert(length);
		        //var addDiv = jQuery(".mainticketblock .time-frame").length + 1;
		        if(timenum < time_fields){ 
		            timenum++;
		            //jQuery("#id_"+ids+" .cat-list-col-sub-col-add").append('');
		            var datetime = jQuery("#ticket-time").html();
		            var datetimes = jQuery(".add_timeblock").html();
		            var timehoursd = jQuery("#timehoursd2").html(); 
		            var timeminutesddd = jQuery("#timeminutesddd2").html(); 
		            //console.log(datetime);
		            $("#"+timeID).append('<div class="time-frame-repeater time_remove_'+datanum+''+timenum+'"><div class="time-frame-col-left"><label>Time Frames</label><div class="event-date" id="ticket-time"><select id="timehours" name="'+datablock+'[timehours'+data_num+']['+totallengyt+']">'+timehoursd+'</select><select id="timeminutes" name="'+datablock+'[timeminutes'+data_num+']['+totallengyt+']">'+timeminutesddd+'</select></div></div><div class="time-frame-col-right"><label>Description</label><input type="text" name="'+datablock+'[ticket_description'+data_num+']['+totallengyt+']"></div><div class="delete-time-frame"><a class="time_frame_remove" data-id="time_remove_'+datanum+''+timenum+'"><img src="/wp-content/uploads/2023/05/delete12_1.png"></a></div></div>');
		        }
		    });

		    jQuery(timwwrapper).on("click",".time_frame_remove", function(e){ 
		        e.preventDefault(); 
		        dataid = jQuery(this).attr("data-id");
		        jQuery("."+dataid).remove(); 
		        x--;
		    });

		    function run_add_time(ClassShow, addDiv,block_text,divlast){
		    	var time_fields      = 20;
		    var timwwrapper         = jQuery("#timeid_"+addDiv);
		    var add_timebutton      = jQuery("."+ClassShow);

		    var timenum = 1; 
		    jQuery(add_timebutton).click(function(e){ 
		        e.preventDefault();
		        if(timenum < time_fields){ 
		            timenum++;
		            //jQuery("#id_"+ids+" .cat-list-col-sub-col-add").append('');
		            var datetime = jQuery("#ticket-time").html();
		             var timehoursd = jQuery("#timehoursd2").html(); 
		            var timeminutesddd = jQuery("#timeminutesddd2").html(); 
		            $(timwwrapper).append('<div class="time-frame-repeater time_remove_'+addDiv+''+timenum+'"><div class="time-frame-col-left"><label>Time Frames</label><div class="event-date" id="ticket-time"><select id="timehours" name="'+block_text+'[timehours'+divlast+']['+timenum+']">'+timehoursd+'</select><select id="timeminutes" name="'+block_text+'[timeminutes'+divlast+']['+timenum+']">'+timeminutesddd+'</select></div></div><div class="time-frame-col-right"><label>Description</label><input type="text" name="'+block_text+'[ticket_description'+divlast+']['+timenum+']"></div><div class="delete-time-frame"><a class="time_frame_remove" data-id="time_remove_'+addDiv+''+timenum+'"><img src="/wp-content/uploads/2023/05/delete12_1.png"></a></div></div>');
		        }
		    });

		    jQuery(timwwrapper).on("click",".time_frame_remove", function(e){ 
		        e.preventDefault(); 
		        dataid = jQuery(this).attr("data-id");
		        jQuery("."+dataid).remove(); 
		        x--;
		    });
		    }

		    // Add Day

		    var day_fields      = 20;
		    var ticketblock         = jQuery(".mainticketblock");
		    var ticketblock2        = jQuery(".program-block_add_extra");
		    var add_dayID      = jQuery(".add_dayID");
		    var add_dayID2     = jQuery(".add_program_block");

		    // var daynum = 1; 
		    // jQuery(add_dayID).click(function(e){ 
		    //     e.preventDefault();
		    //     var addDiv = jQuery(".mainticketblock .time-frame").length + 1;
		    //     if(daynum < day_fields){ 
		    //         daynum++;
		    //        // alert(addDiv);
		    //        var ClassShow = "add-times-"+addDiv;
		    //         //jQuery("#id_"+ids+" .cat-list-col-sub-col-add").append('');
		    //         var datetimes = jQuery(".add_timeblock").html();
		    //         var timehoursd = jQuery("#timehoursd").html(); 
		    //         var timeminutesddd = jQuery("#timeminutesddd").html(); 
		    //         $(ticketblock).append('<div class="ticket-block"><div class="ticket-block-left"><div class="count-number">'+addDiv+'</div></div><div class="ticket-block-right"><div class="ticket-block-content"><div class="ticket-block-content-col"><label>Choose Day</label><select class="choose-day" name="block_day[]"><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option><option value="sunday">Sunday</option></select></div><div class="ticket-block-content-col"><div class="time-framess"><div class="event-date" id="ticket-time"><div class="time-frame demosdsdsd" id="timeid_'+addDiv+'"><div class="time-frame-repeater time_remove_'+addDiv+'1"><div class="time-frame-col-left"><label>Time Frames</label><div class="event-date" id="ticket-time"><select id="timehours" name="'+addDiv+'timehours[]">'+timehoursd+'</select><select id="timeminutes" name="'+addDiv+'timeminutes[]">'+timeminutesddd+'</select></div></div><div class="time-frame-col-right"><label>Description</label><input type="text" name="'+addDiv+'ticket_description[]"></div><div class="delete-time-frame"><a class="time_frame_remove" data-id="time_remove_'+addDiv+'1"><img src="/wp-content/uploads/2023/05/delete12_1.png"></a></div></div></div></div></div><div class="add-time"><a class="add-times-'+addDiv+'">Add Time</a></div></div></div>');
		    //         run_add_time(ClassShow, addDiv);
		    //     }
		    // });
		    // jQuery(add_dayID2).click(function(e){ 
		    //     e.preventDefault();
		    //     var addDiv = jQuery(".mainticketblock .time-frame").length + 1;
		    //     if(daynum < day_fields){ 
		    //         daynum++;
		    //        	var ClassShow = "add-times-"+addDiv;
		    //         var datetimes = jQuery(".add_timeblock").html();
		    //         var timehoursd = jQuery("#timehoursd").html(); 
		    //         var timeminutesddd = jQuery("#timeminutesddd").html(); 
		    //         $(ticketblock2).append('<div class="page-content-repeater-col classtextremove'+daynum+'"><div class="page-content-repeater-col-box"><div class="count-number">4</div></div><div class="page-content-repeater-col-box"><div class="block-name"><h3>Program Block</h3></div></div><div class="page-content-repeater-col-box"><div class="mainticketblock" style="width: 100%;"><div class="ticket-block"><div class="ticket-block-left"><div class="count-number">'+addDiv+'</div></div><div class="ticket-block-right"><div class="ticket-block-content"><div class="ticket-block-content-col"><label>Choose Day</label><select class="choose-day" name="block_day[]"><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option><option value="sunday">Sunday</option></select></div><div class="ticket-block-content-col"><div class="time-framess"><div class="event-date" id="ticket-time"><div class="time-frame demosdsdsd" id="timeid_'+addDiv+'"><div class="time-frame-repeater time_remove_'+addDiv+'1"><div class="time-frame-col-left"><label>Time Frames</label><div class="event-date" id="ticket-time"><select id="timehours" name="'+addDiv+'timehours[]">'+timehoursd+'</select><select id="timeminutes" name="'+addDiv+'timeminutes[]">'+timeminutesddd+'</select></div></div><div class="time-frame-col-right"><label>Description</label><input type="text" name="'+addDiv+'ticket_description[]"></div><div class="delete-time-frame"><a class="time_frame_remove" data-id="time_remove_'+addDiv+'1"><img src="/wp-content/uploads/2023/05/delete12_1.png"></a></div></div></div></div></div><div class="add-time"><a class="add-times-'+addDiv+'">Add Time</a></div></div></div></div></div></div></div><div class="page-content-repeater-col-box"><div class="add-remove-btn add_remove_program" data-id="classtextremove'+daynum+'"><a href="#" class="remove-block"><img src="/wp-content/uploads/2023/05/minus.png"></a></div></div></div>');
		    //         run_add_time(ClassShow, addDiv);
		    //     }
		    // });

		    jQuery(ticketblock).on("click",".time_frame_removes", function(e){ 
		        e.preventDefault(); 
		        dataid = jQuery(this).attr("data-id");
		        jQuery("."+dataid).remove(); 
		        x--;
		    });
		     jQuery(ticketblock2).on("click",".add_remove_program", function(e){ 
		        e.preventDefault(); 
		        dataid = jQuery(this).attr("data-id");
		        //alert(dataid);
		        swal({
					  title: "Are you sure want to delete block?",
					  text: "",
					  icon: "warning",
					  buttons: true,
				      dangerMode: true,
				      buttons: ['No', 'Yes'],
					  dangerMode: true,
					})
					.then((willDelete) =>{
					  if (willDelete){
					  	jQuery("."+dataid).remove(); 
		        		x--;
					  }
					});
		    });
	
	jQuery(function($) {
	   jQuery(document).on('click','.img-upload-class,.img-upload-Skift',function(e){
	        e.preventDefault();
	        var uploadButton = jQuery(this);
        	var uploadPreview = uploadButton.closest('.upload-image-btn').siblings('.upload-image-preview');
        	var inputField = uploadButton.siblings('#block_photo');
	        var upload = wp.media({
	        title:'Choose Image',
	        multiple:false 
	        })
	        .on('select', function(){
	            var select = upload.state().get('selection');
	            var attach = select.first().toJSON();
	            //jQuery('img#img-src').attr('src',attach.url);
	            //jQuery(".upload-image-preview").empty().html('<img class="cfw-admin-image-preview" src="'+attach.url+'" width="100" style="max-height: 100px; width: 100px;">');
	            uploadPreview.empty().html('<img class="cfw-admin-image-preview" src="' + attach.url + '" width="100" style="max-height: 100px; width: 100px;">');
	            //jQuery("#block_photo").val(attach.url);
	            inputField.val(attach.url);
	            
	        })
	        .open();
	   });
	   });

	// PLus minus for text block

	 // Add Day

		    var dayfields      = 20;
		    var textblock         = jQuery(".text-block-repeater");
		    var addtextblock      = jQuery(".add-block-text");

		    var daynum = 1; 
		    jQuery(addtextblock).click(function(e){ 
		        e.preventDefault();
		        var textcount = jQuery(this).attr("data-textcount");
		        var addDiv = jQuery(".mainticketblock .time-frame").length + 1;
		        if(textcount < dayfields){ 
		            textcount++;
		           jQuery(this).attr("data-textcount", textcount);
		            $(textblock).append('<div class="page-content-repeater-col classtextremove'+textcount+'"><div class="page-content-repeater-col-box"><div class="count-number">1</div></div><div class="page-content-repeater-col-box"><div class="block-name"><h3>Text Block</h3></div></div><div class="page-content-repeater-col-box"><div class="text-block"><textarea name="text_block_main[]"></textarea></div></div><div class="page-content-repeater-col-box"><div class="add-remove-btn"><a class="remove-text-block remove-block" data-id="classtextremove'+textcount+'"><img src="/wp-content/uploads/2023/05/minus.png"></a></div></div></div>');
		           // run_add_time(ClassShow, addDiv);
		        }
		    });

		    jQuery(textblock).on("click",".remove-text-block", function(e){ 
		        e.preventDefault(); 
		        dataid = jQuery(this).attr("data-id");

		        	
		        	swal({
					  title: "Are you sure want to delete block?",
					  text: "",
					  icon: "warning",
					  buttons: true,
				      dangerMode: true,
				      buttons: ['No', 'Yes'],
					  dangerMode: true,
					})
					.then((willDelete) =>{
					  if (willDelete){
					  	jQuery("."+dataid).remove();
		        		x--;

					  }
					});
		        //e.preventDefault(); $(this).parent('div').remove(); x--;
		    });

		    // Add photo block

		    var dayfields      = 20;
		    var photoblock         = jQuery(".photo-block-repeater");
		    var addphotoblock      = jQuery(".photo-block-add-btn");

		    var photonum = 1; 
		    jQuery(addphotoblock).click(function(e){ 
		        e.preventDefault();
		        var addDiv = jQuery(".mainticketblock .time-frame").length + 1;
		        if(photonum < dayfields){ 
		            photonum++;
		            $(photoblock).append('<div class="page-content-repeater-col classtextremove'+photonum+'"><div class="page-content-repeater-col-box"><div class="count-number">2</div></div><div class="page-content-repeater-col-box"><div class="block-name"><h3>Photo Block</h3></div></div><div class="page-content-repeater-col-box"><div class="upload-image-block"><div class="upload-image-btn"><a href="#" id="img-upload" class="img-upload-class"><span id="insert_image"><img src=""></span><span>Upload</span></a><a href="#" class="img-upload-Skift">Skift</a><input type="hidden" name="block_photo[]" id="block_photo" value=""></div><div class="upload-image-preview"><img src="/wp-content/uploads/2023/06/noimage.jpeg"></div></div></div><div class="page-content-repeater-col-box"><div class="add-remove-btn"><a class="remove-photo-block remove-block" data-id="classtextremove'+photonum+'"><img src="/wp-content/uploads/2023/05/minus.png"></a></div></div></div>');
		           // run_add_time(ClassShow, addDiv);
		        }
		    });

		    jQuery(photoblock).on("click",".remove-photo-block", function(e){ 
		        e.preventDefault(); 
		        dataid = jQuery(this).attr("data-id");
		        swal({
				  title: "Are you sure want to delete block?",
				  text: "",
				  icon: "warning",
				  buttons: true,
			      dangerMode: true,
			      buttons: ['No', 'Yes'],
				  dangerMode: true,
				})
				.then((willDelete) =>{
				  if (willDelete){
				  	 jQuery("."+dataid).remove(); 
		        	 x--;
				  }
				});
		        //e.preventDefault(); $(this).parent('div').remove(); x--;
		    });
		    jQuery(document).ready(function(){
	removeDiv();
				jQuery('.select_block_option').click(function(e){
		    		 e.preventDefault();
		    		 e.stopPropagation();
		    		  jQuery('#select_block_text').hide();
			         jQuery('#select_block_photo').hide();
			         jQuery('#select_block_program').hide();
			         jQuery('#select_block_ticket').hide();
			      var block = jQuery(this).attr('data-block');
			        if(block === 'text'){
			        	jQuery('#select_block_text').toggle();
			        }else if(block === 'photo'){
			        	jQuery('#select_block_photo').toggle();
			        }else if(block === 'program'){
			        	jQuery('#select_block_program').toggle();
			        }else if(block === 'ticket'){
			        	jQuery('#select_block_ticket').toggle();
			        }

			      //jQuery('#select_block').trigger('change');
			  });
				$('#select_block_text,#select_block_photo,#select_block_program,#select_block_ticket').click( function(e) {
			        e.stopPropagation(); 
			    });
				jQuery('body').click(function(){
				     jQuery('#select_block_text').hide();
			         jQuery('#select_block_photo').hide();
			         jQuery('#select_block_program').hide();
			         jQuery('#select_block_ticket').hide();
				    
			  });

		    jQuery(document).on('change','#select_block_text,#select_block_program,#select_block_photo,#select_block_ticket',function(){

		    	 var dayfields      = 20;
		         var selectedOptions = jQuery(this).find('option:selected');
		         selectedOptions.each(function() {
			      var selectedOption = jQuery(this).val();
			      var textblock = jQuery(this).parent().attr('data-block');
			      var id = jQuery(this).parent().attr('id');
			      var block_text = jQuery(this).parent().attr('data-block_text');
			     var textcount = jQuery("."+block_text+"-block-repeater .page-content-repeater-col").length;
			     var divlast = jQuery("."+block_text+"-block-repeater .page-content-repeater-col:last").data("lastdivid");
			     if (isNaN(divlast)) {
				  var divlast = 1;
				}
			      textcount++;
			      divlast++;
			      jQuery("#"+block_text+"id").val(textcount);
		         if(selectedOption == 'add-block-text'){
		         	var daynum = 1; 
		         	//var textcount = jQuery(".text_block_id").attr("data-textcount");
			        var addDiv = jQuery(".mainticketblock .time-frame").length + 1;

			        if(textcount < dayfields){ 
			            // textcount++;
			           //jQuery(".text_block_id").attr("data-textcount", textcount);
//textid
			            $('.'+textblock).append('<div class="page-content-repeater-col class'+block_text+'remove'+textcount+'" data-lastdivid='+divlast+'><div class="page-content-repeater-col-box"><div class="count-number"></div></div><div class="page-content-repeater-col-box"><div class="block-name"><h3>Text Block</h3></div></div><div class="page-content-repeater-col-box"><div class="text-block"><textarea name="'+block_text+'[text_block'+divlast+']"></textarea></div></div><div class="page-content-repeater-col-box"><div class="add-remove-btn"><a  class="remove-text-block remove-block" data-delete='+block_text+' data-id="class'+block_text+'remove'+textcount+'"><img src="/wp-content/uploads/2023/05/minus.png"></a></div></div></div>');
			           	removeDiv();
			        }
		         }else if(selectedOption == 'photo-block-add-btn'){
		         	//var photoblock = jQuery(".photo-block-repeater");
		         	var addDiv = jQuery(".mainticketblock .time-frame").length + 1;
			        if(textcount < dayfields){ 
			            $('.'+textblock).append('<div class="page-content-repeater-col class'+block_text+'remove'+textcount+'" data-lastdivid='+divlast+'><div class="page-content-repeater-col-box"><div class="count-number"></div></div><div class="page-content-repeater-col-box"><div class="block-name"><h3>Photo Block</h3></div></div><div class="page-content-repeater-col-box"><div class="upload-image-block"><div class="upload-image-btn"><a href="#" id="img-upload" class="img-upload-class"><span id="insert_image"><img src=""></span><span>Upload</span></a><a href="#" class="img-upload-Skift">Skift</a><input type="hidden" name="'+block_text+'[block_photo'+divlast+']" id="block_photo" value=""></div><div class="upload-image-preview"><img src="/wp-content/uploads/2023/06/noimage.jpeg"></div></div></div><div class="page-content-repeater-col-box"><div class="add-remove-btn"><a class="remove-photo-block remove-block"  data-id="class'+block_text+'remove'+textcount+'" data-delete='+block_text+'><img src="/wp-content/uploads/2023/05/minus.png"></a></div></div></div>');
			           // run_add_time(ClassShow, addDiv);
			           	removeDiv();
			        }
		        }else if(selectedOption == 'add_ticket_block'){
		        	//var height = jQuery(".ticket-block-append .ticket-block").length;
		        	//var wrapper2         = jQuery(".ticket-block_add_extra");
		        	//var x = height; 
		        	if(textcount < dayfields){ 
		            //textcount++;
		            //jQuery("#id_"+ids+" .cat-list-col-sub-col-add").append('');
		            
		            var date_time = jQuery("#ticket-event-choose2").html();
		            var date_time3 = jQuery("#ticket-event-choose3").html();
		            var date_time4 = jQuery("#ticket-event-choose4").html();
		            var date_time5 = jQuery("#ticket-event-choose5").html();
		            var date_time6 = jQuery("#ticket-event-choose6").html();
		            $('.'+textblock).append('<div class="page-content-repeater-col class'+block_text+'remove'+textcount+'" data-lastdivid='+divlast+'><div class="page-content-repeater-col-box"><div class="count-number"></div></div><div class="page-content-repeater-col-box"><div class="block-name"><h3>Tickets Block</h3></div></div><div class="page-content-repeater-col-box"><div class="ticket-block-append" style="width: 100%;"><div class="ticket-block remove_'+textcount+'"><div class="ticket-block-left"><div class="count-number">'+textcount+'</div></div><div class="ticket-block-right"><div class="ticket-block-content"><div class="ticket-block-content-col"><label>Ticket Title</label><input type="text" name="'+block_text+'[tickettitle'+divlast+']"></div><div class="ticket-block-content-col"><label>Ticket Date and time</label><div class="date-col event-date"><select id="ticketmonth" name="'+block_text+'[ticketmonth'+divlast+']">'+date_time+'</select><select id="ticketday" name="'+block_text+'[ticketday'+divlast+']">'+date_time3+'</select><select id="ticketyear" name="'+block_text+'[ticketyear'+divlast+']">'+date_time4+'</select><select id="tickethours" name="'+block_text+'[tickethours'+divlast+']">'+date_time5+'</select><select id="ticketminutes" name="'+block_text+'[ticketminutes'+divlast+']">'+date_time6+'</select><div class="event-date-col"><input type="checkbox" id="ticketnodate" name="'+block_text+'[ticketnodatenodate'+divlast+']" value="1" ><label for="nodate"> No Date</label></div></div></div><div class="ticket-block-content-col"><label>LifePeaks Link:</label><input type="text" name="'+block_text+'[ticketlink'+divlast+']"></div></div><div class="delete-btn"><a class="remove_field" data-id="'+textcount+'">Delete</a></div></div></div></div></div><div class="page-content-repeater-col-box"><div class="add-remove-btn"><a class="remove-ticket-block remove-block" data-delete='+block_text+' data-id="class'+block_text+'remove'+textcount+'"><img src="/wp-content/uploads/2023/05/minus.png"></a></div></div></div>');
		            	removeDiv();
		        	}
		        }else if(selectedOption == 'add_program_block'){
		        	//var ticketblock2         = jQuery(".program-block_add_extra");
					//var daynum = jQuery(".program_block_id").attr("data-textcount"); 
		        	var addDiv = jQuery(".mainticketblock .time-frame").length + 1;
			        if(textcount < dayfields){ 
			            //daynum++;
			            //jQuery(".program_block_id").attr("data-textcount", daynum);
			           	var ClassShow = "add-times-"+addDiv;
			            var datetimes = jQuery(".add_timeblock").html();
			            var timehoursd = jQuery("#timehoursd2").html(); 
			            var timeminutesddd = jQuery("#timeminutesddd2").html(); 
			            $('.'+textblock).append('<div class="page-content-repeater-col class'+block_text+'remove'+textcount+'" data-lastdivid='+divlast+'><div class="page-content-repeater-col-box"><div class="count-number"></div></div><div class="page-content-repeater-col-box"><div class="block-name"><h3>Program Block</h3></div></div><div class="page-content-repeater-col-box"><div class="mainticketblock" style="width: 100%;"><div class="ticket-block"><div class="program-block-left"><div class="count-number">'+addDiv+'</div></div><div class="ticket-block-right"><div class="ticket-block-content"><div class="ticket-block-content-col"><label>Choose Day</label><select class="choose-day" name="'+block_text+'[block_day'+divlast+']"><option value="monday">Monday</option><option value="tuesday">Tuesday</option><option value="wednesday">Wednesday</option><option value="thursday">Thursday</option><option value="friday">Friday</option><option value="saturday">Saturday</option><option value="sunday">Sunday</option></select></div><div class="ticket-block-content-col"><div class="time-framess"><div class="event-date" id="ticket-time"><div class="time-frame demosdsdsd" id="timeid_'+addDiv+'"><div class="time-frame-repeater time_remove_'+addDiv+'1"><div class="time-frame-col-left"><label>Time Frames</label><div class="event-date" id="ticket-time"><select id="timehours" name="'+block_text+'[timehours'+divlast+'][1]">'+timehoursd+'</select><select id="timeminutes" name="'+block_text+'[timeminutes'+divlast+'][1]">'+timeminutesddd+'</select></div></div><div class="time-frame-col-right"><label>Description</label><input type="text" name="'+block_text+'[ticket_description'+divlast+'][1]"></div><div class="delete-time-frame"><a class="time_frame_remove" data-id="time_remove_'+addDiv+'1"><img src="/wp-content/uploads/2023/05/delete12_1.png"></a></div></div></div></div></div><div class="add-time"><a class="add-times-'+addDiv+'" data-block="'+block_text+'">Add Time</a></div></div></div></div></div></div></div><div class="page-content-repeater-col-box"><div class="add-remove-btn add_remove_program" data-delete='+block_text+' data-id="class'+block_text+'remove'+textcount+'"><a class="remove-block"><img src="/wp-content/uploads/2023/05/minus.png"></a></div></div></div>');
			            run_add_time(ClassShow, addDiv,block_text,divlast);
			            	removeDiv();
			        	}
		        }
		        jQuery('.'+textblock).on("click",".remove-photo-block,.remove-ticket-block,.add_remove_program,.remove-text-block", function(e){ 
		        e.preventDefault(); 
		        dataid = jQuery(this).attr("data-id");
		        //alert(dataid);
		         var block_delete = jQuery(this).attr("data-delete");

		        swal({
				  title: "Are you sure want to delete block?",
				  text: "",
				  icon: "warning",
				  buttons: true,
			      dangerMode: true,
			      buttons: ['No', 'Yes'],
				  dangerMode: true,
				})
				.then((willDelete) =>{
				  if (willDelete){
				  	 jQuery("."+dataid).remove(); 
				  	 var get_val = jQuery("#"+block_delete+'id').val();
					  	var total_count = get_val - 1;
					  	jQuery("#"+block_delete+'id').val(total_count);
		        	 x--;
				  }
				});
				});
		        setTimeout(function(){
				    jQuery('#'+id).val('');
				},1000);
		       
		    });
		  	});

			jQuery('.save_post_html').click(function(){
				var post_id = jQuery(this).attr('data-post_id');

				var htmlContent = $('.page-content-area').html();
				 var jsonData = htmlContent;
				 $.ajax({
			    	method: "POST",
			    	dataType: "json",
			        url:'/wp-admin/admin-ajax.php', // Replace with the server-side script URL
			      	data: {
			      		action: 'save_post_content_block_function',
			      		post_id:post_id,
			      		encodedData:jsonData},
			      success: function(response) {
			      	console.log(response);
			      	if(response.status == '200'){
			      		swal({
						  title: "Success!",
						  text: "Successfully Save!",
						  icon: "success",
						  button: "Ok!",
						}).then((reloadpage) =>{
			      			setTimeout(function() { 
						        location.reload();
						    }, 1000);
			      		});
						
			      	}
			    },
			    error: function(xhr, status, error) {
			    	console.error("Error saving data: " + error);
			        // Handle any error scenarios or display error message
			    }
			});
			});

			jQuery('textarea').on('keyup', function() {
			    var textareaValue = jQuery(this).val();
			    	jQuery(this).text(textareaValue);
			    
			  });
		});
</script>