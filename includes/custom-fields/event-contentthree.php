<?php 
//die('dfgd');
//echo "<pre>";print_r($save_program);die;
$i = 1;
foreach ($save_program as $key => $value) {
						$keys= substr($key, 0, -1);
						$keynum = $key[strlen($key)-1];
						if($keys == 'text_block'){
							?>
							<div class="page-content-repeater-col classprogramremove<?php echo $i; ?>" data-lastdivid="<?php echo $keynum; ?>">
									<div class="page-content-repeater-col-box">
										<div class="count-number"></div>
									</div>
									<div class="page-content-repeater-col-box">
										<div class="block-name"><h3>Text Block</h3></div>
									</div>
									<div class="page-content-repeater-col-box">
										<div class="text-block">
											<textarea name="program[<?php echo $key; ?>]"><?php echo esc_attr($value);?></textarea>
										</div>
									</div>
									<div class="page-content-repeater-col-box">
										<div class="add-remove-btn">

											<a $save_program class="remove-text-block remove-block" data-id="classprogramremove<?php echo $i; ?>"><img src="/wp-content/uploads/2023/05/minus.png"></a>
										</div>
									</div>
								</div>
							<?php 
						}
						if($keys == 'block_photo'){
							?>
							<div class="page-content-repeater-col classprogramremove<?php echo $i; ?>" data-lastdivid="<?php echo $keynum; ?>">
								<div class="page-content-repeater-col-box">
									<div class="count-number"></div>
								</div>
								<div class="page-content-repeater-col-box">
									<div class="block-name"><h3>Photo Block</h3></div>
								</div>
								<div class="page-content-repeater-col-box">
									<div class="upload-image-block">
										<div class="upload-image-btn">
											<a $save_program id="img-upload" class="img-upload-class">
												<span id='insert_image'>
													<img src="">
												</span>
												<span>Upload</span></a>
												<a $save_program class="img-upload-Skift">Skift</a>
												<?php //$block_photo = esc_attr( get_post_meta( $post->ID, 'block_photo', true ) );?>
												<input type="hidden" name="program[<?php echo $key; ?>]" id="block_photo" value="<?php echo $value;?>">
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

											<a $save_program class="remove-photo-block remove-block" data-id="classprogramremove<?php echo $i; ?>"><img src="/wp-content/uploads/2023/05/minus.png"></a>
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
							<div class="page-content-repeater-col classprogramremove<?php echo $i; ?>" data-lastdivid="<?php echo $keynum; ?>">
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
							//foreach ($ticket_blocks->ticket_block->ticketmonth as $keyticketmonth => $valueticketmonth){
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
											<input type="text" name="program[tickettitle<?php echo $keynum; ?>]" value="<?php echo $save_program->$tickettitle;?>">
											</div>
											<div class="ticket-block-content-col">
												<label>Ticket Date and time</label>
												<div class="date-col event-date" id="ticket-event-choose">
													<select id="ticketmonth" name="program[ticketmonth<?php echo $keynum; ?>]">
													<!--  <option value="">Select Month</option> -->

													<?php
													//$ticket_blocks->ticket_block->ticketmonth[$keyticketmonth];
													$selected_month = 'ticketmonth'.$keynum; //current month
													for ($i_month = 1; $i_month <= 12; $i_month++) { 
													$selected = $save_program->$selected_month == $i_month ? ' selected' : ''; // If select current month
													//$selected = $monts_select == $i_month ? ' selected' : '';
													echo '<option value="'.$i_month.'" '.$selected .'>'. date('F', mktime(0,0,0,$i_month)).'</option>'."\n";
													}
													?>
													</select>
													<select id="ticketday" name="program[ticketday<?php echo $keynum; ?>]">
													<!-- <option value="">Select Day</option> -->
													<?php
													$selected_day = 'ticketday'.$keynum;
													//$selected_day = date('d'); //current day
													for ($i_day = 1; $i_day <= 31; $i_day++) { 
													$selected = $save_program->$selected_day == $i_day ? ' selected' : '';
													echo '<option value="'.$i_day.'"'.$selected.'>'.$i_day.'</option>'."\n";
													}
													?>
													</select>
													<select id="ticketyear" name="program[ticketyear<?php echo $keynum; ?>]">
													<!-- <option value="">Select Year</option> -->
													<?php 
													$year_start  = date('Y');
													$year_end = date('Y')+30; // current Year
													$selected_year = 'ticketyear'.$keynum;// user date of birth year
													// $year_select = esc_attr( get_post_meta( $post->ID, 'year', true ) ); 
													for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
													$selected = $save_program->$selected_year == $i_year ? ' selected' : '';
													echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
													}
													?>
													</select>
													<select id="tickethours" name="program[tickethours<?php echo $keynum; ?>]">
													<?php 
													$selected_d = 'tickethours'.$keynum;
													for ($i_day = 1; $i_day <= 24; $i_day++) { 
													$selected = $save_program->$selected_d == $i_day ? ' selected' : '';
													if($i_day <= 9 ){
													echo '<option value="'.$i_day.'" '.$selected.'>0'.$i_day.'</option>'."\n";
													}else{
													echo '<option value="'.$i_day.'" '.$selected.'>'.$i_day.'</option>'."\n";
													}
													}
													?>
													</select>
													<select id="ticketminutes" name="program[ticketminutes<?php echo $keynum; ?>]">
													<?php 
													$selected_t = 'ticketminutes'.$keynum;
													for ($i_day = 0; $i_day <= 60; $i_day++) { 
													$selected = $save_program->$selected_t == $i_day ? ' selected' : '';
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
													$checked = ($save_program->$checkdata == 1) ? 'checked' : '';
													?>
													<div class="event-date-col">
														<input type="checkbox" id="ticketnodate" name="program[ticketnodatenodate<?php echo $keynum; ?>]" value="1" <?php echo $checked;?>>
														<label for="nodate"> No Date</label>
													</div>

												</div>
											</div> 
											<div class="ticket-block-content-col">
											<label>LifePeaks Link:</label>
											<input type="text" name="program[ticketlink<?php echo $keynum; ?>]" value="<?php echo $save_program->$ticketlink;?>">
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

						<a $save_program class="remove-block remove-ticket-block" data-id="classprogramremove<?php echo $i; ?>"><img src="/wp-content/uploads/2023/05/minus.png"></a>
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
				<div class="page-content-repeater-col classprogramremove<?php echo $i; ?>" data-lastdivid="<?php echo $keynum; ?>">
					<div class="page-content-repeater-col-box">
						<div class="count-number">
							<?php 
								if($i == 1){
									echo '4';
								}
								?>
						</div>
					</div>
					<div class="page-content-repeater-col-box">
						<div class="block-name"><h3>Program Block</h3></div>
					</div>
					<div class="page-content-repeater-col-box">
						<div class="top-heading-title">
							<label>Block Title</label>
							<input type="text" name="program_block_title" value="<?php echo get_post_meta( $post->ID, 'program_block_title', true );?>">
						</div>
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
									//$selectdays = $blocks_days[0]->day;
								}else{
									//$selectdays = '';
								}
								$selectedblock_day = 'block_day'.$keynum;
								$selectdays = $save_program->$selectedblock_day;
								?>
								<div class="ticket-block">
									<div class="program-block-left">
										<div class="count-number">1</div>
									</div>

									<div class="ticket-block-right">
										<div class="ticket-block-content">
											<div class="ticket-block-content-col">
												<label>Choose Day</label>
												<select class="choose-day" name="program[block_day<?php echo $keynum; ?>]">
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
												<div class="time-frame" id="program_<?php echo $keynum;?>">
													<?php $programs_block = json_decode(get_post_meta( $post->ID, 'programs_block', true ));
				//echo "<pre>";print_r($blocks_days);
													$program_num = 1;
													//foreach ($blocks_days[0]->{0} as $keyprogram => $valueprogram) {
													//echo "<pre>";print_r($save_program->$timehours);
													foreach ($save_program->$timehours as $keyprogram => $valueprogram) {
														//echo $valueprogram;
														?>
														<div class="time-frame-repeater time_remove_c_<?php echo $keynum;?>_<?php echo $keyprogram;?>">
															<div class="time-frame-col-left">
																<label>Time Frames</label>
																<div class="event-date" id="ticket-time">
																	<select id="timehours" name="program[timehours<?php echo $keynum; ?>][<?php echo $keyprogram;?>]">
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

																	<select id="timeminutes" name="program[timeminutes<?php echo $keynum; ?>][<?php echo $keyprogram;?>]">
																		<?php 
$times_minutes = 'timeminutes'.$keynum;
																		for ($i_day = 0; $i_day <= 60; $i_day++) { 
																			$selectedday = $save_program->$timeminutes->$keyprogram == $i_day ? ' selected' : '';
																			if($i_day <= 9 ){
																				echo '<option value="'.$i_day.'" '.$selectedday.'>0'.$i_day.'</option>'."\n";
																			}else{
																				echo '<option value="'.$i_day.'" '.$selectedday.'>'.$i_day.'</option>'."\n";
																			}
																		}
																		$desctime = 'ticket_description'.$keynum;
																		?>
																	</select>
																</div>
															</div>
															
															<div class="time-frame-col-right">
																<label>Description</label>
																<input type="text" name="program[ticket_description<?php echo $keynum; ?>][<?php echo $keyprogram;?>]" value="<?php echo $save_program->$ticket_description->$keyprogram;?>">
															</div>
															
															<div class="delete-time-frame">
																<a class="time_frame_remove" data-id="time_remove_c_<?php echo $keynum;?>_<?php echo $keyprogram;?>"><img src="/wp-content/uploads/2023/05/delete12_1.png"></a>
															</div>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>
										<div class="add-time">
											<a class="add-times" data-num="<?php echo $keynum;?>" data-block="program" data-id="program_<?php echo $keynum;?>" datanum="1">Add Time</a>
										</div>
									</div>
								</div>
							<?php //} ?>
						</div>
						<!-- <div class="add-more add-day">
							<a class="add_dayID">Add Day</a>
						</div> -->
					</div>
					<div class="page-content-repeater-col-box">
						<div class="add-remove-btn">
							<a $save_program class="remove-block add_remove_program" data-id="classprogramremove<?php echo $i; ?>"><img src="/wp-content/uploads/2023/05/minus.png"></a>
						</div>
					</div>
				</div>
			<?php 
		}
		//echo "<pre>";print_r($key);
		$i++;
	}
					
					?>