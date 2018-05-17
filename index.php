<?php
error_reporting(0);
date_default_timezone_set('Asia/Shanghai');
$url = "http://www.kuaiyilicai.com/uprate/twd.html";
$contents = file_get_contents($url);
$pattern = "#(?<=[/][ ])\d[.]\d+#";
$pattern_date = "#\d{4}年\d{2}月\d{2}日(?=<span style=)#";
preg_match_all($pattern, $contents, $matches);
preg_match($pattern_date, $contents, $match_date);
$today_rate =  number_format(floatval($matches[0][0]),4);
$last_rate = number_format(floatval($matches[0][1]),4);
$update_time = $match_date[0];
$change_rate = number_format($today_rate - $last_rate,4);
if($change_rate > 0)
	{$plus = '↑ +'.$change_rate;}
else if($change_rate < 0)
	{$plus = '↓ '.$change_rate;}
else{$plus = '不变';}
$final_str = '【今日汇率】'.date("n月j日").'人民币对新台币的银联汇率为 1:'.$today_rate.',相较昨日汇率'.$plus.'。浙江省赴台学生联谊会信息部关心您~';
$half_str = '【今日汇率】'.date("n月j日").'人民币对新台币的银联汇率为 1:'.$today_rate.',相较昨日汇率'.$plus;
if($update_time != date("Y年m月d日")){
	$final_str= $update_time."今日汇率尚未更新";
}

$ip_x_64 = number_format(35900/$today_rate,0);
$ip_x_256 = number_format(41500/$today_rate,0);
$ip_x_str = "iPhone X 64G/256G ≈ ￥".$ip_x_64."/￥".$ip_x_256;

//var_dump($result);
//print_r($result);
//print($result['cur_date']);
//print($result['exchange_rate']);
?>

<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>信息部文具盒 | 汇率</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="css/jumbotron-narrow.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<style>
	.btn-circle {  
	  width: 30px;  
	  height: 30px;  
	  text-align: center;  
	  padding: 6px 0;  
	  font-size: 12px;  
	  line-height: 1.428571429;  
	  border-radius: 15px;  
	}  
	.btn-circle.btn-lg {  
	  width: 50px;  
	  height: 50px;  
	  padding: 10px 16px;  
	  font-size: 18px;  
	  line-height: 1.33;  
	  border-radius: 25px;  
	}  
	.btn-circle.btn-xl {  
	  width: 70px;  
	  height: 70px;  
	  padding: 10px 16px;  
	  font-size: 24px;  
	  line-height: 1.33;  
	  border-radius: 40px;  
	}  
	.center {
	  width: auto;
	  display: table;
	  margin-left: auto;
	  margin-right: auto;
	}
	.text-center {
	  text-align: center;
	}
	</style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="container">
      <div class="header clearfix">
        <h3 class="text-muted">信息部文具盒</h3>
      </div>
      <!-- 成功模态框 -->
      <div class="modal fade" id="myModalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">提示</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>复制成功！快去贴~</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            </div>
          </div>
        </div>
      </div>
      <!-- 模态框 -->
      <!-- 失败模态框 -->
      <div class="modal fade" id="myModalFail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">提示</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <p>复制失败了，手动来吧~</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            </div>
          </div>
        </div>
      </div>
      <!-- 模态框 -->
      <div class="jumbotron animated fadeIn">
        <h1><i class="fa fa-line-chart" aria-hidden="true"></i> 汇率</h1>
        <p class="lead"><?php echo $final_str.'<br>汇率更新时间：'.$update_time;?></p>
        <button class="btn btn-xl btn-circle btn-success center animated flip" aria-hidden="true" data-clipboard-text=<?php echo '"'.$final_str.'"';?>><i class="fa fa-clipboard"></i></button>
    	<hr>
    	<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#demo" id='btn1'><i class="fa fa-caret-down" aria-hidden="true"></i></button>    
		<div id="demo" class="collapse in">
		    <H3><a href="EverydayApple">Everyday <i class="fa fa-apple" aria-hidden="true"></i> TW</a></H3>
    		<p><?php echo $ip_x_str?></p>
    		<button class="btn btn-xl btn-circle btn-primary center animated flip" aria-hidden="true" data-clipboard-text=<?php echo '"'.$half_str."(".$ip_x_str.')。浙江省赴台学生联谊会信息部关心您~"';?>><i class="fa fa-clipboard"></i></button>
		</div>
      </div>

    <!-- 2. Include library -->
    <script src="js/clipboard.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script>
    var clipboard = new Clipboard('.btn');
    clipboard.on('success', function(e) {
    	$('#myModalSuccess').modal('show');
      console.log(e);
    });
    clipboard.on('error', function(e) {
    	$('#myModalFail').modal('show');
      console.log(e);
    });
    </script>
	<script type="text/javascript">
	$(function () { 
		$('#demo').on('show.bs.collapse', function () {
			document.getElementById("btn1").innerHTML  = '<i class="fa fa-caret-up" aria-hidden="true"></i>';
		})
		$('#demo').on('hide.bs.collapse', function () {
			document.getElementById("btn1").innerHTML  = '<i class="fa fa-caret-down" aria-hidden="true"></i>';
		})
	});
	</script> 
    <footer class="footer">
        <p>&copy; 2017 浙江省赴台学生联谊会信息部</p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
