<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class mindex_holiday extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */
	function holiday_view($holiday_per_page=0,$holiday_row=0,$holiday_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select top $holiday_per_page * from vwholiday where row between $holiday_row and $holiday_total and deleted =0"); 	
  		return $query->result();		
	}
	function count_holiday()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select count(hday_id) as holiday_count from vwholiday where deleted =0");
		return $query->row();
	}
	
	function holiday_view_search($holiday_per_page=0,$holiday_search="",$holiday_row=0,$holiday_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top $holiday_per_page  * from fnSearchholiday('$holiday_search') where holidayrow between $holiday_row and $holiday_total");
		return $query->result();
	}
	function count_holiday_search($holiday_search="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select COUNT(*) as holiday_count from fnSearchholiday('$holiday_search')");
		return $query->row();
	}
	function holiday_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from [rows per page] order by numrows asc");
		return $query->result();
	}
	function active_holiday_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from [rows per page] where active =1 ");
		return $query->row();
	}
	function update_holiday_num_rows($holiday_per_page=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [rows per page] set Active = 0 ");
		$query = $this->dbAll->query("update [rows per page] set Active = 1  where numrows = $holiday_per_page");
	}
	function get_holiday_type()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select [holiday type] as hday_type, [holiday name] as hday_name from [holiday type]");
		return $query->result();
	}
	function add_holiday($holiday_type=0 ,$holiday_date ='' ,$holiday_name='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
	 	$query =  $this->dbAll->query("insert into [holiday] ([date],[holiday type] ,[holiday date], [Remarks])
				Values('$holiday_date','$holiday_type' ,'$holiday_date' ,'$holiday_name')");

	}
	function get_holiday_info()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top 1  * from [vwholiday] order by hday_id desc");
		return $query->row();
	}

	function get_holiday_update($holiday_id =0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vwholiday where hday_id = $holiday_id ");
		return $query->row();
	}
	function update_holiday($holiday_date="",$holiday_type=0,$holiday_name="",$holiday_id=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		echo $query = $this->dbAll->query("update [holiday] set [Date]='$holiday_date', [holiday date]='$holiday_date',
				[holiday type]='$holiday_type' ,[remarks] = '$holiday_name' ,[Changed Date] = getdate() where [holiday ID] = $holiday_id");
	}
	function get_update_holiday($holiday_id=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vwholiday where hday_id = $holiday_id");
	}
	function delete_holiday($holiday_id= 0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [holiday] set [deleted] = 1, [changed date] = getdate() where [holiday ID] = $holiday_id");
	
	}
}