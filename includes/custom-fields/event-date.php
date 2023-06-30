<div class="hcf_box">
    <style scoped>
        .hcf_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .hcf_field{
            display: contents;
        }
    </style>
<div class="event-date">
    <div class="event-date-col">
        <?php $monts_select = esc_attr( get_post_meta( $post->ID, 'month', true ) ); 
        //echo "<pre>";print_r($post->ID);
        ?>
    <select id="month" name="month">
    <option value="">Select Month</option>

<?php
    $selected_month = date('m'); //current month
    for ($i_month = 1; $i_month <= 12; $i_month++) { 
        //$selected = $selected_month == $i_month ? ' selected' : ''; // If select current month
        $selected = $monts_select == $i_month ? ' selected' : '';
        echo '<option value="'.$i_month.'"'.$selected.'>'. date('F', mktime(0,0,0,$i_month)).'</option>'."\n";
    }
?>
</select>
</div>
<div class="event-date-col">
<select id="day" name="day">
    <option value="">Select Day</option>
<?php
    $day_select = esc_attr( get_post_meta( $post->ID, 'day', true ) ); 
    $selected_day = date('d'); //current day
    for ($i_day = 1; $i_day <= 31; $i_day++) { 
        $selected = $day_select == $i_day ? ' selected' : '';
        echo '<option value="'.$i_day.'"'.$selected.'>'.$i_day.'</option>'."\n";
    }
?>
</select>
</div>

<div class="event-date-col">
<select id="year" name="year">
    <option value="">Select Year</option>
<?php 
    $year_start  = date('Y');
    $year_end = date('Y')+30; // current Year
    $selected_year = 2023; // user date of birth year
    $year_select = esc_attr( get_post_meta( $post->ID, 'year', true ) ); 
    for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
        $selected = $year_select == $i_year ? ' selected' : '';
        echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
    }
?>
</select>
</div>
<?php $nodate = esc_attr( get_post_meta( $post->ID, 'nodate', true ) ); 
    $checked = ($nodate == 1) ? 'checked' : '';
?>
<div class="event-date-col">
      <input type="checkbox" id="nodate" name="nodate" value="1" <?php echo $checked;?>>
      <label for="nodate"> No Date</label>
</div>
</div>
</div>