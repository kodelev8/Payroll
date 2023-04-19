$(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
     
      $(document).ready(function() {
          $('.btn-block').on('click', function() {
              var btn = $(this).attr('id');
              var option = '';
              var option_name = '';
              var btn_name = '';
              if (btn == 'btn_login') {
                  option = '1';
                  option_name = 'Log - IN';
                  btn_name = 'Log-in';
              } else if (btn == 'btn_lunchout') {
                  option = '3';
                  option_name = 'Lunch Break - OUT';
                  btn_name = 'Lunch Break-out';
              } else if (btn == 'btn_lunchin') {
                  option = '4';
                  option_name = 'Lunch Break - IN';
                  btn_name = 'Lunch Break-in';
              } else if (btn == 'btn_logout') {
                  option = '2';
                  option_name = 'Log - OUT';
                  btn_name = 'Log-out';
              }
              $('.txt_option').val(option);
              $('.txt_option_name').val(option_name);
              $('#lbl_option').html(btn_name);
              $(this).addClass('btn_color');
              $('#emp_id').removeAttr('disabled');
              $('#emp_id').val('');
              $('#btn_id').removeAttr('disabled');
              $('#btn_ok').removeAttr('disabled');
              $('#emp_id').focus();
              return false;
          });
      });
      $(document).ready(function() {
          $("#emp_id").keydown(function(event) {
              if ($.inArray(event.keyCode, [46, 8, 9, 27, 13]) !== -1 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
                  return;
              } else {
                  if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                      event.preventDefault();
                  }
              }
          });
      });

      function date() {
          var m = "AM";
          var gd = new Date();
          var secs = gd.getSeconds();
          var minutes = gd.getMinutes();
          var hours = gd.getHours();
          var day = gd.getDay();
          var month = gd.getMonth();
          var date = gd.getDate();
          var year = gd.getUTCFullYear();
          if (secs < 10) {
              secs = "0" + secs;
          }
          if (minutes < 10) {
              minutes = "0" + minutes;
          }
          if (hours < 10) {
              hours = "0" + hours;
          }
          var montharray = new Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
          var fulldate =  montharray[month]+"/"+ date+"/" + year +" "+hours + ":" + minutes + ":" + secs  ;
          $("#date").html(fulldate);
          setTimeout("date()", 1000);
      }
      date();   
