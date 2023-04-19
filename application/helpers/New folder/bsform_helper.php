<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This file is used to create bootstrap style form blocks
 *
 * @example $this->load->helper('bsform');
 *<form class="form-horizontal" role="form">
  <div class="form-group has-error">
    <label class="control-label col-sm-2" for="inputError3">Input with success</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" for="inputError3" id="adsasd">  
      <label class="help-inline" id="warning">The hfsiahfasihfi RFfdhjfhjds</label>
    </div>
  </div>
</form>
 */
function bs_inputfield($display_name, $fieldname, $defaultvalue, $mandatory = false, $printlabel = true, $input_style = '')
{
	$for="";
    $error = form_error($fieldname, '<span class="help-inline" id="warning">', '</span>');
    if ($error != '')
    {
    	$for = "inputError3";
        echo "<div class=\"form-group has-error\">";
    }
    else
        echo "<div class=\"form-group\">";
    
    if ($printlabel == true) {
	    echo "<label class=\"control-label col-sm-2\" for=\"$for\">";
	    echo $display_name;
	    if ($mandatory)
	        echo lang('txt_asterisk');
	    echo "</label>";
    }
    
    echo "<div class=\"col-sm-3 \">";
    echo "<input type=\"text\"  class=\"form-control\" for=\"$for\" id=\"$fieldname\" name=\"$fieldname\" value=\"".set_value($fieldname, $defaultvalue)."\" $input_style />";
    echo $error;
    echo "</div></div>";
}
function bs_inputfield_name($display_name,$placeholder,$placeholder2,$placeholder3, $fieldname,$fieldname2,$fieldname3, $defaultvalue, $mandatory = false, $printlabel = true, $input_style = '')
{
	$for="";
	$error = form_error($fieldname, '<span class="help-inline" id="warning">', '</span>');
	$error2 = form_error($fieldname2, '<span class="help-inline" id="warning">', '</span>');
	$error3 = form_error($fieldname3, '<span class="help-inline" id="warning">', '</span>');
	if ($error != '')
	{
		$for = "inputError3";
		echo "<div class=\"form-group has-error\">";
	}
	else
		echo "<div class=\"form-group\">";


	if ($printlabel == true) {
		echo "<label class=\"control-label col-sm-2\" for=\"$for\">";
		echo $display_name;
		if ($mandatory)
			echo lang('txt_asterisk');
	    echo "</label>";
	}

    echo "<div class=\"row\">";
    echo "<div class=\"col-sm-2 \">";
    echo "<input type=\"text\"  class=\"form-control\" for=\"$for\" id=\"$fieldname\" name=\"$fieldname\" value=\"".set_value($fieldname, $defaultvalue)."\" placeholder=\"$placeholder\" $input_style />";
    echo $error;
    echo "</div>";
    echo "<div class=\"col-sm-2 \">";
    echo "<input type=\"text\"  class=\"form-control\" for=\"$for\" id=\"$fieldname2\" name=\"$fieldname2\" value=\"".set_value($fieldname2, $defaultvalue)."\" placeholder=\"$placeholder2\" $input_style />";
    echo $error2;
    echo "</div>";
    echo "<div class=\"col-sm-2 \">";
    echo "<input type=\"text\"  class=\"form-control\" for=\"$for\" id=\"$fieldname3\" name=\"$fieldname3\" value=\"".set_value($fieldname3, $defaultvalue)."\" placeholder=\"$placeholder3\" $input_style />";
    echo $error3;
    echo "</div></div></div>";
}

function bs_inputfield2($display_name, $fieldname, $defaultvalue, $mandatory = false, $printlabel = true, $input_style = '')
{

    $error = form_error($fieldname, '<span class="help-inline">', '</span>');
    if ($error != '')
        echo "<div class=\"control-group error\">";
    else
        echo "<div class=\"control-group\">";
    
    if ($printlabel == true) {
	    echo "<label class=\"control-label\">";
	    echo $display_name;
	    if ($mandatory)
	        echo lang('txt_asterisk');
	    echo "</label>";
    }
    
    echo "<div class=\"controls\">";
    echo "<input type=\"text\" id=\"$fieldname\" name=\"$fieldname\" value=\"".set_value($fieldname, $defaultvalue)."\" $input_style />";
//    echo "<br/><br/><label style='text-align: justify; margin-left: 50px'>".lang('present_address_details')."</label>";
    echo "<br/><br/><span class=\"help-block\" style='margin-left: 50px'>".lang('present_address_details')."</span>";
    echo $error;
    echo "</div>";
    
    echo "</div>";
}

function bs_inputfield_hidden($fieldname, $defaultvalue)
{
	echo "<input type=\"hidden\" id=\"$fieldname\" name=\"$fieldname\" value=\"$defaultvalue\" />";
}

function bs_inputfield_password($display_name, $fieldname, $defaultvalue, $mandatory = false, $printlabel = true, $input_style = '')
{
	$for="";
	$error = form_error($fieldname, '<span class="help-inline" id="warning">', '</span>');
	if ($error != '')
	{
		$for = "inputError3";
		echo "<div class=\"form-group has-error\">";
	}
	else
		echo "<div class=\"form-group\">";
	
	if ($printlabel == true) {
		echo "<label class=\"control-label col-sm-2\" for=\"$for\">";
		echo $display_name;
		if ($mandatory)
			echo lang('txt_asterisk');
			echo "</label>";
	}
	
	echo "<div class=\"col-sm-3 \">";
	echo "<input type=\"password\"  class=\"form-control\" for=\"$for\" id=\"$fieldname\" name=\"$fieldname\" value=\"".set_value($fieldname, $defaultvalue)."\" $input_style />";
	echo $error;
	echo "</div></div>";
}

function bs_inputfield_group($display_name, $items = array(), $mandatory = false, $printlabel = true)
{

    $error = form_error($fieldname, '<span class="help-inline">', '</span>');
    if ($error != '')
        echo "<div class=\"control-group error\">";
    else
        echo "<div class=\"control-group\">";
    
	if ($printlabel == true) {
	    echo "<label class=\"control-label\">";
	    echo $display_name;
	    if ($mandatory)
	        echo lang('txt_asterisk');
	    echo "</label>";
	}
	
    echo "<div class=\"controls\">";
    echo "<input type=\"text\" id=\"$fieldname\" name=\"$fieldname\" value=\"".set_value($fieldname, $defaultvalue)."\"/>";
    echo $error;
    echo "</div></div>";
}

function bs_inputfield_upload($display_name, $fieldname, $mandatory = false, $command_browse, $command_replace, $printlabel = true)
{
	echo "<div class=\"control-group\">";
    
		if ($printlabel == true) {
		    echo "<label class=\"control-label\">";
		    echo $display_name;
		    if ($mandatory)
		        echo lang('txt_asterisk');
		    echo "</label>";
		}
		
	    echo "<div class=\"controls\">";
			echo '<div class="fileinputs">';
			echo '<input id="'.$fieldname.'" name="'.$fieldname.'" type="file" class="file" />';
				echo '<div class="fakefile">';
					echo '<input id="faketext" name="faketext" value="" />';
					echo '<div style="top: -30px;">';
						echo '<a id="btnbrowse" class="btn btn-small btn-success" style="margin-left: 0px;">'.$command_browse.'</a>';
						echo '&nbsp';
						echo '<a id="btnUpload" class="btn btn-small btn-success">'.$command_replace.'</a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';    		
	   echo "</div>";
   	echo "</div>";	
}

function bs_inputfield_color($display_name = '', $color_items = array(), $mandatory = false, $others = '', $printlabel = true)
{
	if (count($color_items) > 0) {
		$error = '';
		
		foreach ($color_items as $item)
		{
			$error = form_error($item[0], '<span class="help-inline">', '</span>');
			if ($error != '') break;
		}
	
		if ($error != '')
        	echo "<div class=\"control-group error\">";
    	else
        	echo "<div class=\"control-group\">";
	
        if ($printlabel == true) {
	        echo "<label class=\"control-label\">";	
	        echo $display_name;
	        if ($mandatory) {
	        	echo lang('txt_asterisk');
	        }
	        echo "</label>";
		}
        
        echo "<div class=\"controls\">";
		foreach ($color_items as $item)
		{
			echo "<input $others type=\"text\" id=\"$item[0]\" name=\"$item[0]\" value=\"".set_value($item[0], $item[1])."\"/>&nbsp;&nbsp;&nbsp;";
		}
		echo $error;
		echo "</div></div>";
	}
}

function bs_textarea($display_name, $fieldname, $defaultvalue, $rows, $mandatory = false, $printlabel = true)
{
    
    $error = form_error($fieldname, '<span class="help-inline">', '</span>');
    if ($error != '')
        echo "<div class=\"control-group error\">";
    else
        echo "<div class=\"control-group\">";
    
    if ($printlabel == true) {
	    echo "<label class=\"control-label\">";
	    echo $display_name;
	    if ($mandatory)
	        echo lang('txt_asterisk');
	    
	    echo "</label>";
    }
    
    echo "<div class=\"controls\">";
    echo "<textarea id=\"$fieldname\" name=\"$fieldname\" rows=\"$rows\">".html_entity_decode(set_value($fieldname, $defaultvalue))."</textarea>";
    echo $error;
    echo "</div></div>";
}



function bs_text_remarks ($label = '', $text = '', $printlabel = true)
{
	echo "<div class=\"control-group\">";
	
	if ($printlabel == true) {
    	echo "<label class=\"control-label\">";
    	echo $label;
    	echo "</label>";
	}
	
    echo "<div class=\"controls\">";
    echo "$text";
    echo "</div></div>";
}

function bs_checkbox_dropdown($label_name, $display_name, $checkbox_name, $checkbox_value, $dropdown_name, $dropdown_items = array(), $checkbox_selected = false, $mandatory_label = false, $printlabel = true)
{
	echo "<div class=\"control-group\">";
	
	if ($printlabel == true) {
		echo "<label class=\"control-label\">";
		echo $label_name;
		if ($mandatory_label)
			echo lang('txt_asterisk');
		echo "</label>";
	}
	
	echo "<div class=\"controls\">";
	$selected_str = "";
    if ($checkbox_selected == true) {
    	$selected_str = "checked='checked'";
    }
    
    echo "<input type='checkbox' id=\"$checkbox_name\" name=\"$checkbox_name\" value=\"$checkbox_value\" ".$selected_str." style='vertical-align: top;' /> ".$display_name;
    
    echo "<select name=\"$dropdown_name\" id=\"$dropdown_name\">";
	if (count($dropdown_items) > 0) {
		foreach ($dropdown_items as $item)
		{
			echo "<option value=\"$item[0]\" >".$item[1]."</option>";
		}
	}
    echo "</select>";
    
	echo "</div></div>";
}

function bs_checkbox_button($label_name, $display_name, $fieldname, $fieldid, $defaultvalue, $selected = false, $mandatory = false, $printlabel = true)
{
    $error = form_error($fieldname, '<span class="help-inline">', '</span>');
    if ($error != '')
        echo "<div class=\"control-group error\">";
    else
        echo "<div class=\"control-group\">";
    
	if ($printlabel == true) {
	    echo "<label class=\"control-label\">";
	    echo $label_name;
	    if ($mandatory)
	        echo lang('txt_asterisk');
	    echo "</label>";
    }
    
    echo "<div class=\"controls\">";
    $selected_str = "";
    if ($selected == true) {
    	$selected_str = "checked='checked'";
    }
    echo "<input type='checkbox' id=\"$fieldid\" name=\"$fieldname\" value=\"$defaultvalue\" ".$selected_str." style='vertical-align: top;' /> ".$display_name;
    echo $error;
    echo "</div></div>";
}

function bs_radio_button($label_name, $display_name, $fieldname, $defaultvalue, $selected = false, $mandatory = false, $printlabel = true)
{
    $error = form_error($fieldname, '<span class="help-inline">', '</span>');
    if ($error != '')
        echo "<div class=\"control-group error\">";
    else
        echo "<div class=\"control-group\">";
    
	if ($printlabel == true) {
	    echo "<label class=\"control-label\">";
	    echo $label_name;
	    if ($mandatory)
	        echo lang('txt_asterisk');	    
	    echo "</label>";
    }
    
    echo "<div class=\"controls\">";
    $selected_str = "";
    if ($selected == true) {
    	$selected_str = "checked='checked'";
    }
    echo "<input type='radio' id=\"$fieldname\" name=\"$fieldname\" value=\"$defaultvalue\" ".$selected_str." style='vertical-align: top;' /> ".$display_name;
    echo $error;
    echo "</div></div>";
}

function bs_radio_button_group($display_name, $fieldname, $items = array(), $mandatory = false, $printlabel = true)
{
	$error = form_error($fieldname, '<span class="help-inline">', '</span>');
    if ($error != '')
        echo "<div class=\"control-group error\">";
    else
        echo "<div class=\"control-group\">";
	
    if ($printlabel == true) {
	    echo "<label class=\"control-label\">";
	    echo $display_name;
	    if ($mandatory)
	        echo lang('txt_asterisk');
	    echo "</label>";
    }
    
	echo "<div class=\"controls\" style='vertical-align: bottom; padding-top: 5px;'>";
	
		if (count($items) > 0) {
			foreach ($items as $item)
			{
			$selected_str = "";
			    if ($item[2] == true) {
			    	$selected_str = "checked='checked'";
			    }
				echo "<input type='radio' id=\"$fieldname\" name=\"$fieldname\" value=\"$item[1]\" ".$selected_str." style='vertical-align: top;' /> ".$item[0]."&nbsp;";
			}
		}
	echo $error;
	echo "</div></div>";
}


function bs_inputfield_3($display_name, $fieldname1, $fieldname2, $fieldname3, $defaultvalue1, $defaultvalue2, $defaultvalue3, $mandatory = false, $printlabel = true, $input_style = '')
{
	$error = '';
    $error .= form_error($fieldname1, '<span class="help-inline">', '</span>');
    $error .= form_error($fieldname2, '<span class="help-inline">', '</span>');
    $error .= form_error($fieldname3, '<span class="help-inline">', '</span>');
    
    if ($error != '')
        echo "<div class=\"control-group error\">";
    else
        echo "<div class=\"control-group\">";
    
    if ($printlabel == true) {
	    echo "<label class=\"control-label\">";
	    echo $display_name;
	    if ($mandatory)
	        echo lang('txt_asterisk');
	    echo "</label>";
    }
    
    echo "<div class=\"controls\">";
    echo '<input type="text" id="'.$fieldname1.'" name="'.$fieldname1.'" value="'.set_value($fieldname1, $defaultvalue1).'" class="input-small" style="margin-right:4px;" />';
	echo '<input type="text" id="'.$fieldname2.'" name="'.$fieldname2.'" value="'.set_value($fieldname2, $defaultvalue2).'" class="input-small" style="margin-right:4px;" />';
	echo '<input type="text" id="'.$fieldname3.'" name="'.$fieldname3.'" value="'.set_value($fieldname3, $defaultvalue3).'" class="input-medium" />';
	if($error != '')
    	
    	echo '<span class="help-inline" style="padding-left: 8px;">The '.$display_name.' field is required.</span>';
    else
   		echo '';
    echo "</div></div>";
}


function bs_inputfield_4($display_name, $fieldname1, $fieldname2, $fieldname3,$fieldname4, $defaultvalue1, $defaultvalue2, $defaultvalue3,$defaultvalue4, $mandatory = false, $printlabel = true, $input_style = '')
{
	$error = '';
    $error .= form_error($fieldname1, '<span class="help-inline">', '</span>');
    $error .= form_error($fieldname2, '<span class="help-inline">', '</span>');
    $error .= form_error($fieldname3, '<span class="help-inline">', '</span>');
    $error .= form_error($fieldname4, '<span class="help-inline">', '</span>');
    
    if ($error != '')
        echo "<div class=\"control-group error\">";
    else
        echo "<div class=\"control-group\">";
    
    if ($printlabel == true) {
	    echo "<label class=\"control-label\">";
	    echo $display_name;
	    if ($mandatory)
	        echo lang('txt_asterisk');
	    echo "</label>";
    }
    
    echo "<div class=\"controls\">";
    echo '<input type="text" id="'.$fieldname1.'" name="'.$fieldname1.'" value="'.set_value($fieldname1, $defaultvalue1).'" class="input-small" style="margin-right:4px;" />';
	echo '<input type="text" id="'.$fieldname2.'" name="'.$fieldname2.'" value="'.set_value($fieldname2, $defaultvalue2).'" class="input-small" style="margin-right:4px;" />';
	echo '<input type="text" id="'.$fieldname3.'" name="'.$fieldname3.'" value="'.set_value($fieldname3, $defaultvalue3).'" class="input-medium" style="margin-right:4px;" />';
	echo '<input type="text" id="'.$fieldname4.'" name="'.$fieldname4.'" value="'.set_value($fieldname4, $defaultvalue4).'" class="input-mini"/>';
	if($error != '')
    	
    	echo '<span class="help-inline" style="padding-left: 8px;">The '.$display_name.' field is required.</span>';
    else
   		echo '';
    echo "</div></div>";
}
function bs_dropdown( $label_name,$dropdown_name, $dropdown_items = array(), $mandatory_label = false, $printlabel = true)
{
	echo "<div class=\"control-group\">";
		echo $label_name;
    echo "<select name=\"$dropdown_name\" id=\"$dropdown_name\">";
	if (count($dropdown_items) > 0) {
		foreach ($dropdown_items as $item)
		{
			echo "<option value=\"$item[0]\" >".$item[1]."</option>";
		}
	}
    echo "</select>";
    
	echo "</div>";
}

function bs_submit($btn_class,$btn_value)
{
	echo '<div class="form-group">';
	echo '<div class="col-sm-offset-2 col-sm-10">';
	echo '<button type="submit" class="btn btn-default">'.$btn_value.'</button>';
	echo '</div>';
	echo '</div>';
}
function month_dropdown($month="month", $top_month='' ) {

	$months = array(
			"choose"=>"Month",
			"01"=>"Jan",
			"02"=>"Feb",
			"03"=>"Mar",
			"04"=>"Apr",
			"05"=>"May",
			"06"=>"Jun",
			"07"=>"Jul",
			"08"=>"Aug",
			"09"=>"Sep",
			"10"=>"Oct",
			"11"=>"Nov",
			"12"=>"Dec"
	);

	$html = "<select name='{$month}' id=\"$month\">";

	foreach($months as $key => $month){

		$selected = "";
		//this will match for selected value and set the selected attribute
		if( $key == $top_month ) {
			$selected = "selected='selected'";
		}
		$html .="<option value='{$key}' $selected>{$month}</option>";
	}
	$html .="</select>";
	return $html;

}

function day_dropdown($day="day", $top_days="") {
	$days = array(
			"choose"=>"Day",
			"01"=>"01",
			"02"=>"02",
			"03"=>"03",
			"04"=>"04",
			"05"=>"05",
			"06"=>"06",
			"07"=>"07",
			"08"=>"08",
			"09"=>"09",
			"10"=>"10",
			"11"=>"11",
			"12"=>"12",
			"13"=>"13",
			"14"=>"14",
			"15"=>"15",
			"16"=>"16",
			"17"=>"17",
			"18"=>"18",
			"19"=>"19",
			"20"=>"20",
			"21"=>"21",
			"22"=>"22",
			"23"=>"23",
			"24"=>"24",
			"25"=>"25",
			"26"=>"26",
			"27"=>"27",
			"28"=>"28",
			"29"=>"29",
			"30"=>"30",
			"31"=>"31"
	);

	$html = "<select name='{$day}' id='{$day}'>";

	foreach($days as $key => $day){
		$selected = "";
		if( $key == $top_days ) {
			$selected = "selected='selected'";
		}

		$html .="<option value='{$key}' $selected >{$day}</option>";
	}
	$html .="</select>";
	return $html;

}

function year_dropdown($year="year", $top_years='') {
	$years = array(
			"choose"=>"Year",
			"1997"=>"1997",
			"1996"=>"1996",
			"1995"=>"1995",
			"1994"=>"1994",
			"1993"=>"1993",
			"1992"=>"1992",
			"1991"=>"1991",
			"1990"=>"1990",
			"1989"=>"1989",
			"1988"=>"1988",
			"1987"=>"1987",
			"1986"=>"1986",
			"1985"=>"1985",
			"1984"=>"1984",
			"1983"=>"1983",
			"1982"=>"1982",
			"1981"=>"1981",
			"1980"=>"1980",
			"1979"=>"1979",
			"1978"=>"1978",
			"1977"=>"1977",
			"1976"=>"1976",
			"1975"=>"1975",
			"1974"=>"1974",
			"1973"=>"1973",
			"1972"=>"1972",
			"1971"=>"1971",
			"1970"=>"1970",
			"1969"=>"1969",
			"1968"=>"1968",
			"1967"=>"1967",
			"1966"=>"1966",
			"1965"=>"1965",
			"1964"=>"1964",
			"1963"=>"1963",
			"1962"=>"1962",
			"1961"=>"1961",
			"1960"=>"1960",
			"1959"=>"1959",
			"1959"=>"1959",
			"1958"=>"1958",
			"1957"=>"1957",
			"1956"=>"1956",
			"1955"=>"1955",
			"1954"=>"1954",
			"1953"=>"1953",
			"1953"=>"1953",
			"1952"=>"1952",
			"1951"=>"1951",
			"1950"=>"1950",
			"1949"=>"1949",
			"1948"=>"1948",
			"1947"=>"1947",
			"1946"=>"1946",
			"1945"=>"1945",
			"1944"=>"1944",
			"1943"=>"1943",
			"1942"=>"1942",
			"1941"=>"1941",
			"1940"=>"1940",
			"1939"=>"1939",
			"1938"=>"1938",
			"1937"=>"1937",
			"1936"=>"1936",
			"1935"=>"1935",
			"1934"=>"1934",
			"1933"=>"1933",
			"1932"=>"1932",
			"1931"=>"1931",
			"1930"=>"1930"

	);

	$html = "<select name='{$year}' id='{$year}'>";

	foreach($years as $key => $year){

		$selected = "";
		if( $key == $top_years ) {
			$selected = "selected='selected'";
		}

		$html .="<option value='{$key}' $selected >{$year}</option>";
	}
	$html .="</select>";
	return $html;

}
