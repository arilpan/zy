<?php
	header("Content-type: text/html; charset=utf-8");    

		$openid="";
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>查询报告状态</title>
    <link rel="stylesheet" href="./css/weui.css"/>
    <link rel="stylesheet" href="./css/example.css"/>
</head>
<body ontouchstart>

    <div class="container js_container">
        <div class="page">
            <div class="hd">
                <h1 class="page_title">查询报告状态</h1>
            </div>
			
			<form action="queryStateresult.php" id="form" name ="form">
				<div class="bd">
					<div class="weui_cells_title">请输入委托人(父亲或者母亲)身份证号</div>
						<div class="weui_cells weui_cells_form">
							<div class="weui_cell">
								<div class="weui_cell_hd"><label class="weui_label">身份证</label></div>
								<div class="weui_cell_bd weui_cell_primary">
									<input class="weui_input"  name="text1"  id = "text1" placeholder="请输入身份证号"/>
								</div>
							</div>
						</div>
				
					<div class="weui_btn_area">
						<a class="weui_btn weui_btn_primary" href="javascript:" id="check" type="submit">确定</a>
					</div>	
					
					
					
					<div class="weui_dialog_alert" id="dialog2" style="display: none;">
						<div class="weui_mask"></div>
						<div class="weui_dialog">
							<div class="weui_dialog_hd"><strong class="weui_dialog_title">温馨提示</strong></div>
							<div class="weui_dialog_bd">身份证号位18位，手机号为11位，请输入合法的身份证号和手机号，谢谢！ </div> 
							 
							<div class="weui_dialog_ft">
								<a href="javascript:;" class="weui_btn_dialog primary">确定</a>
							</div>
						</div>
					</div>

					<div class="weui_dialog_alert" id="dialog1" style="display: none;">
						<div class="weui_mask"></div>
						<div class="weui_dialog">
							<div class="weui_dialog_hd"><strong class="weui_dialog_title">温馨提示</strong></div>
							<div class="weui_dialog_bd">案例编号为11位，谢谢！ </div> 
							 
							<div class="weui_dialog_ft">
								<a href="javascript:;" class="weui_btn_dialog primary">确定</a>
							</div>
						</div>
					</div>
				
				</div>	  
			</form>
		</div>

	</div>

    <script src="./js/zepto.min.js"></script>
    <script src="./js/example.js"></script>
</body>
</html>