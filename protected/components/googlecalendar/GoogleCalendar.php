<?php
// creates a display for a particular month to be embedded in a full view
require_once("html.php");
// require_once(dirname(__FILE__)."/includes/html.php");
class GoogleCalendar
{
	public $week_start=1;
	
	public static function month_view($month, $year,$wim,$first_day,$from_stamp,$last_day,$to_stamp,$result_events)
	{
		$month = empty($month) ? date('m',time()) : $month;
		$year = empty($year) ? date('Y',time()) : $year;
	
		$month_navbar = self::month_navbar($month, $year);
		$month_table = self::create_month($month, $year,$wim,$first_day,$from_stamp,$last_day,$to_stamp,$result_events);
		return array('month_table'=>$month_table->toString(),'month_navbar'=>$month_navbar->toString());
	}
	public static function get_short_month_name($month)
	{
		return self::short_month_name($month);
	}
	public static function get_month_name($month)
	{
		return self::month_name($month);
	}
	public static function create_month($month, $year,$wim,$first_day,$from_stamp,$last_day,$to_stamp,$result_events)
	{
/* 		$wim = self::weeks_in_month($month, $year);
	
		$first_day = 1 - self::day_of_week($month, 1, $year);
		$from_stamp = mktime(0, 0, 0, $month, $first_day, $year);
	
		$last_day = $wim * 7 - self::day_of_week($month, 1, $year);
		$to_stamp = mktime(0, 0, 0, $month, $last_day, $year); */
	
		/******Begin:get events*****/
// 	 	$results = $phpcdb->get_occurrences_by_date_range($phpcid, $from_stamp,$to_stamp);
 		$days_events = array();
		 foreach($result_events as $event) {
			$end_stamp = mktime(0, 0, 0, date('n', $event['end_ts']),date('j', $event['end_ts']), date('Y', $event['end_ts']));
			$start_stamp = mktime(0, 0, 0, date('n', $event['start_ts']),date('j', $event['start_ts']),date('Y', $event['start_ts']));
			$diff = $from_stamp - $start_stamp;
			if($diff > 0)
				$add_days = floor($diff / 86400);
			else
				$add_days = 0;
			// put the event in every day until the end
			for(; ; $add_days++) {
				$stamp = mktime(0, 0, 0, date('n', $event['start_ts']),date('j', $event['start_ts']) + $add_days,date('Y', $event['start_ts']));
				if($stamp > $end_stamp || $stamp > $to_stamp)
					break;
				$key = date('Y-m-d', $stamp);
				if(!isset($days_events[$key]))
					$days_events[$key] = array();
				$days_events[$key][] = $event;
			}
		}
		
		$month_table = tag('tbody');
		for($week_of_month = 1; $week_of_month <= $wim; $week_of_month++) {
// 			echo '<pre>';print_r($days_events);echo '</pre>';
			$month_table->add(self::create_week($week_of_month, $month, $year,$days_events));
		}
		/******End:get events*******/
		
		return $month_table;
	}
	//takes a day number of the week, returns a name (0 for the beginning)
	public static function day_name($day)
	{
		global $day_names;
	
		$day = $day % 7;
	
		return $day_names[$day];
	}
	
	public static function short_month_name($month)
	{
		global $short_month_names;
	
		$short_month_names = array(
			1 => 'Jan',
			2 => 'Feb',
			3 => 'Mar',
			4 => 'Apr',
			5 => 'May',
			6 => 'Jun',
			7 => 'Jul',
			8 => 'Aug',
			9 => 'Sep',
			10 => 'Oct',
			11 => 'Nov',
			12 => 'Dec',
		);
		
		$month = ($month - 1) % 12 + 1;
		return $short_month_names[$month];
	}
	// takes a number of the month, returns the name
	public static function month_name($month)
	{
		$month_names = array(
			1 => 'January',
			2 => 'February',
			3 => 'March',
			4 => 'April',
			5 => 'May',
			6 => 'June',
			7 => 'July',
			8 => 'August',
			9 => 'September',
			10 => 'October',
			11 => 'November',
			12 => 'December',
		);
		$month = ($month - 1) % 12 + 1;
		return $month_names[$month];
	}
	// creates a menu to navigate the month/year
	// returns XHTML data for the menu
	public static function month_navbar($month, $year)
	{
		$html = tag('div', attributes('class="phpc-month-nav"'));
		$prev_month = $month - 1;
		$prev_year = $year;
		if($prev_month < 1) {
			$prev_month += 12;
			$prev_year--;
		}
		;
		self::menu_item_append_with_date($html,'previous year', 'display_month',$year - 1, $month);
		self::menu_item_append_with_date($html, 'previous month', 'display_month',$prev_year, $prev_month);
		
		/* for($i = 1; $i <= 12; $i++) {
			if($i < $month)
				$attribs = 'class="phpc-past"';
			elseif($i == $month)
				$attribs = 'class="phpc-present"';
			else
				$attribs = 'class="phpc-future"';
			self::menu_item_append_with_date($html, self::short_month_name($i),'display_month', $year, $i, true, $attribs);
		} */
	    for($i = 1; $i <= 12; $i++) {
		 if($i < $month)
			$attribs = 'style="width:20px;float:left;border:1px solid red;"';
		elseif($i == $month)
			$attribs = 'style="width:20px;float:left;border:1px solid red;"';
		else
			$attribs = 'style="width:20px;float:left;border:1px solid red;"';
		self::menu_item_append_with_date($html, self::short_month_name($i),'display_top_month', $year, $i, true, $attribs);
		} 
		
		$next_month = $month + 1;
		$next_year = $year;
		if($next_month > 12) {
			$next_month -= 12;
			$next_year++;
		}
		self::menu_item_append_with_date($html, 'next month', 'display_month',
		$next_year, $next_month);
		self::menu_item_append_with_date($html, 'next year', 'display_month',
		$year + 1, $month);
	
		return $html;
	}
	// takes a menu $html and appends an entry with the date
	public static function menu_item_append_with_date(&$html, $name, $action, $year = false,
			$month = false, $day = false, $attribs = false)
	{
		if(!is_object($html)) {
			self::soft_error('Html is not a valid Html class.');
		}
		$html->add(self::create_action_link_with_date($name, $action, $year, $month,$day, $attribs));
		$html->add("\n");
	}
	public static function day_of_week_start()
	{
		$week_start = 0;
		return $week_start;
	}
	
	// returns the number of days in the week before the 
	//  taking into account whether we start on sunday or monday
	public static function day_of_week($month, $day, $year)
	{
		return self::day_of_week_ts(mktime(0, 0, 0, $month, $day, $year));
	}
	
	// returns the number of days in the week before the 
	//  taking into account whether we start on sunday or monday
	public static function day_of_week_ts($timestamp)
	{
		$days = date('w', $timestamp);
	
		return ($days + 7 - self::day_of_week_start()) % 7;
	}
	
	// returns the number of days in $month
	public static function days_in_month($month, $year)
	{
		return date('t', mktime(0, 0, 0, $month, 1, $year));
	}
	
	//returns the number of weeks in $month
	public static function weeks_in_month($month, $year)
	{
		$days = self::days_in_month($month, $year);
	
		// days not in this month in the partial weeks
		$days_before_month = self::day_of_week($month, 1, $year);
		$days_after_month = 6 - self::day_of_week($month, $days, $year);
	
		// add up the days in the month and the outliers in the partial weeks
		// divide by 7 for the weeks in the month
		return ($days_before_month + $days + $days_after_month) / 7;
	}
	
	// return the week number corresponding to the $day.
	public static function week_of_year($month, $day, $year)
	{
		global $week_start;
		
		$timestamp = mktime(0, 0, 0, $month, $day, $year);
	
		// week_start = 1 uses ISO 8601 and contains the Jan 4th,
		//   Most other places the first week contains Jan 1st
		//   There are a few outliers that start weeks on Monday and use
		//   Jan 1st for the first week. We'll ignore them for now.
		if($week_start == 1) {
			$year_contains = 4;
			// if the week is in December and contains Jan 4th, it's a week
			// from next year
			if($month == 12 && $day - 24 >= $year_contains) {
				$year++;
				$month = 1;
				$day -= 31;
			}
		} else {
			$year_contains = 1;
		}
		
		// $day is the first day of the week relative to the current month,
		// so it can be negative. If it's in the previous year, we want to use
		// that negative value, unless the week is also in the previous year,
		// then we want to switch to using that year.
		if($day < 1 && $month == 1 && $day > $year_contains - 7) {
			$day_of_year = $day - 1;
		} else {
			$day_of_year = date('z', $timestamp);
			$year = date('Y', $timestamp);
		}
	
		/* Days in the week before Jan 1. */
		$days_before_year = self::day_of_week(1, $year_contains, $year);
	
		// Days left in the week
		$days_left = 8 - self::day_of_week_ts($timestamp) - $year_contains;
	
		/* find the number of weeks by adding the days in the week before
		 * the start of the year, days up to $day, and the days left in
		 * this week, then divide by 7 */
		return ($days_before_year + $day_of_year + $days_left) / 7;
	}
	
	// creates a display for a particular week to be embedded in a month table
	public static function create_week($week_of_month, $month, $year, $days_events)
	{
		$start_day = 1 + ($week_of_month - 1) * 7 - self::day_of_week($month, 1, $year);
		$week_of_year = self::week_of_year($month, $start_day, $year);
	
		$week_html = tag('tr', tag('th', $week_of_year));
	
		for($day_of_week = 0; $day_of_week < 7; $day_of_week++) {
			$day = $start_day + $day_of_week;
			$week_html->add(self::create_day($month, $day, $year, $days_events));
		}
	
		return $week_html;
	}
	
	// displays the day of the week and the following days of the week
	public static function create_day($month, $day, $year, $days_events)
	{
		if($day <= 0) {
			$month--;
			if($month < 1) {
				$month = 12;
				$year--;
			}
			$day += self::days_in_month($month, $year);
			$current_era = 'none';
		} elseif($day > self::days_in_month($month, $year)) {
			$day -= self::days_in_month($month, $year);
			$month++;
			if($month > 12) {
				$month = 1;
				$year++;
			}
			$current_era = 'none';
		} else {
			$currentday = date('j');
			$currentmonth = date('n');
			$currentyear = date('Y');
	
			// set whether the date is in the past or future/present
			if($currentyear == $year && $currentmonth == $month && $currentday == $day) {
				$current_era = 'present';
			} elseif($currentyear > $year || $currentyear == $year && ($currentmonth > $month || $currentmonth == $month && $currentday > $day)) {
				$current_era = 'past';
			} else {
				$current_era = 'future';
			}
		}
	
		$date_tag = tag('div', attributes('class="phpc-date"'));
	// 	if(can_write($phpcid)) {
			$date_tag->add(self::create_action_link_with_date('+','create', $year, $month,$day, array('class="phpc-add"')));
	// 	}
		$date_tag->add(self::create_action_link_with_date($day, 'display_day', $year,$month, $day));
	
		$html_day = tag('td', attributes('valign="top"',
				"class=\"phpc-$current_era\""), $date_tag);
	
		$stamp = mktime(0, 0, 0, $month, $day, $year);
	
	// 	$can_read = can_read($phpcid);
		$key = date('Y-m-d', $stamp);
		if(!array_key_exists($key, $days_events))
			return $html_day;
	
		$results = $days_events[$key];
		if(empty($results))
			return $html_day;
	
		$html_events = tag('ul');
		$html_day->add($html_events);
	
		// Count the number of events
		$count = 0;
		foreach($results as $key => $event) {
			if($count == 8) {
				$event_html = tag('li',
						self::create_action_link_with_date("View Additional Events",
								'display_day', $year, $month,
								$day,
								array('class="phpc-date"')));
				$html_events->add($event_html);
				break;
			}
	
			$count++;
			//  - make sure we have permission to read the event
	
/* 			$subject = $event['title'];
			$event_time = $event->get_time_string();
			if(!empty($event_time))
				$title = "$event_time - $subject";
			else
				$title = $subject; */
			$id = $event['id'];
			$key = $id.'_'.$day;
			
			$start_time = $event['start_time'];
			$end_time = $event['end_time'];
			$title = $event['title'];
			$content = $event['content'];
			$detail_html='<div style="padding:5px 0"><span style="font-weight:bold;">From:</span> '.$start_time.'</div>';
			$detail_html.='<div style="padding:5px 0"><span style="font-weight:bold;">To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> '.$end_time.'</div>';
			$detail_html.='<div style="padding:5px 0"><span style="font-weight:bold;">Subject:</span> '.$title.'</div>';
			$detail_html.='<div style="padding:5px 0"><span style="font-weight:bold;">Description:</span> <br/>'.$content.'</div>';
			$detail_html.='<div style="float:right;vertical-align:bottom;margin-top:70px;"><a href="/calendar/delete?id='.$id.'">Delete</a>&nbsp;&nbsp;<a href="/calendar/update?id='.$id.'">Edit</a></div>';
			
			/* $style = "";
			if(!empty($event->text_color))
				$style .= "color: ".$event->get_text_color().";";
			if(!empty($event->bg_color))
				$style .= "background-color: ".$event->get_bg_color()
				.";"; */
			
			$event_html = tag('li',
					self::create_occurrence_link(self::truncate_utf8_string($title, 5, '...'), "display_event",'',
							//$event->get_oid(),
							array("style=\"border-bottom:1px solid red;\"","id=event_$id",
									'onmouseover="show_powerFloat('.$id.',\''.$key.'\');"')
							 ));                              
			$event_detail_html = tag('div',
					self::create_occurrence_link($detail_html, "display_event",'',
							//$event->get_oid(), 
							array("style=\"border:5px solid rgba(0,0,0,0.3);display:none;width:300px;height:200px;\"","id=event_detail_$key","class=\"shadow target_box dn\"")
					));
// 			$event_detail_html = tag('div',$content,array("style=\"border:1px solid red;\""));
			$html_events->add($event_html);
			$html_events->add($event_detail_html);
		}
	
		return $html_day;
	}
	
	public static function create_event_link($text, $action, $eid, $attribs = false)
	{
		return self::create_action_link($text, $action, array('eid' => $eid),$attribs);
	}
	
	public static function create_occurrence_link($text, $action, $oid, $attribs = false)
	{
		return self::create_action_link($text, $action, array('oid' => $oid),$attribs);
	}
	public static function create_action_link($text, $action, $args = false, $attribs = false)
	{
		$url = "href=\"/user/rcalendar?";
	// 	if(isset($vars["phpcid"]))
	// 		$url .= "phpcid=" . htmlentities($vars["phpcid"]) . "&amp;";
		$url .= "action=" . htmlentities($action);
	
		if (!empty($args)) {
			foreach ($args as $key => $value) {
				if(empty($value))
					continue;
				if (is_array($value)) {
					foreach ($value as $v) {
						$url .= "&amp;"
								. htmlentities("{$key}[]=$v");
					}
				} else
					$url .= "&amp;" . htmlentities("$key=$value");
			}
		}
		$url .= '"';
		if($action == '#' || $action == 'display_day' || $action == 'display_event' || $action == 'display_top_month')$url="";
		
		if($attribs !== false) {
			$as = attributes($url, $attribs);
		} else {
			$as = attributes($url);
		}
		if($action == 'display_top_month')
			return tag('', $as, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		elseif($action == '#' || $action == 'display_day' || $action == 'display_event')
			return tag('div', $as, $text);
		else
			return tag('a', $as, $text);
	}
	
	public static function create_action_link_with_date($text, $action, $year = false,$month = false, $day = false, $attribs = false)
	{
		$args = array();
		if($year !== false) $args["year"] = $year;
		if($month !== false) $args["month"] = $month;
		if($day !== false) $args["day"] = $day;
	
		return self::create_action_link($text, $action, $args, $attribs);
	}
	public static function truncate_utf8_string($string, $length, $etc = '...')
	{
		$result = '';
		$string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
		$strlen = strlen($string);
		for ($i = 0; (($i < $strlen) && ($length > 0)); $i++)
		{
		if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))
		{
				if ($length < 1.0)
				{
				break;
		}
		$result .= substr($string, $i, $number);
		$length -= 1.0;
		$i += $number - 1;
		}
			else
				{
					$result .= substr($string, $i, 1);
					$length -= 0.5;
		}
		}
		$result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
		if ($i < $strlen)
		{
		$result .= $etc;
		}
		return $result;
	}
}
?>