<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class mindex_daily_task extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */
	function get_daily_task($dt_emp_no = 0,$dt_from = '',$dt_to = '')
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select * from vwdailytask where dt_emp_no = '$dt_emp_no' and dt_date between '$dt_from' and '$dt_to' and dt_deleted = 0 order by dt_date,dt_in asc");
    	return $query->result();	
    } 
    function get_emp_info()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select * from vwemployee");
    	return $query->result();
    }
    function add_daily_task($dt_emp_no=0 ,$dt_date='' ,$dt_time_in='' ,$dt_time_out='' ,$dt_remarks='')
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("insert into [daily task] ([emp no],[date],[time in],[time out], [remarks])
    			values('$dt_emp_no', '$dt_date','$dt_time_in','$dt_time_out','$dt_remarks')");
    }
    function update_daily_task($dt_emp_no=0 ,$dt_date='' ,$dt_time_in='' ,$dt_time_out='' ,$dt_remarks='',$dt_id=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("update [daily task] set [emp no] ='$dt_emp_no',[date] = '$dt_date',[time in] = '$dt_time_in',
    			[time out] = '$dt_time_out', [remarks] ='$dt_remarks' where id = $dt_id");
    }
    function delete_daily_task($dt_id=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("update [daily task] set [deleted] = 1 where id = $dt_id");
    }
    function get_dt_info()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select top 1 * from vwDailyTask order by dt_id desc");
    	return $query->row();
    }
    function get_dt_update_info($dt_id=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select * from vwDailyTask where dt_id = $dt_id");
    	return $query->row();
    }
    function get_emp_name($dt_emp_no = 0)
    {
    	$this-> dbAll = $this-> load->database( 'default', TRUE );
    	$query = $this-> dbAll->query( "select (emp_first_name+' ' +emp_last_name) as dt_emp_name,
    			  emp_first_name as dt_first_name, emp_last_name as dt_last_name from vwEmployee where emp_no ='$dt_emp_no'");
    	return $query->row();
    }
    function get_first_emp_no()
    {
    	$this-> dbAll = $this-> load->database( 'default', TRUE );
    	$query = $this-> dbAll->query( "select top 1 * from vwemployee order by emp_last_name asc");
    	return $query->row();
    }
    function get_dt_totalhours($dt_emp_no= '', $dt_date_from = 0, $dt_date_to = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query =  $this->dbAll->query("spGetDailyTaskTotalHours @emp_no='$dt_emp_no', @date_from='$dt_date_from', @date_to='$dt_date_to'");
    	return $query->row();
    }
    function get_dt_totalhours_per_day($dt_emp_no= '', $dt_date = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query =  $this->dbAll->query("spGetDailyTaskTotalHoursPerDay @emp_no='$dt_emp_no', @date='$dt_date'");
    	return $query->row();
    }
    function getCurrentWeekNo()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query =  $this->dbAll->query("select WeekNr as weeknum from [WeekNumber] where YEAR = 2018 and GETDATE() between StartDate and EndDate");
    	return $query->row();
    }
    function getWeekNumbers()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query =  $this->dbAll->query("select distinct(WeekNr) as weekyear from WeekNumber order by WeekNr");
    	return $query->result();
    }
    function getWeekNumberCurrent($dt_week=0,$dt_year=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query =  $this->dbAll->query("select * from WeekNumber where WeekNr = $dt_week and YEAR = $dt_year");
    	return $query->row();
    }
    function getWeekNumberview($dt_year=0,$dt_date=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query =  $this->dbAll->query("select * from weeknumber where year = $dt_year and '$dt_date' between startdate and enddate");
    	return $query->row();
    }
    
}
