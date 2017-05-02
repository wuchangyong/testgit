<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title>用户列表</title>
		<link type="text/css" rel="stylesheet" href="<?php echo ($BASEPATH); ?>Public/bootstrap/css/bootstrap.min.css">
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		//type等于-1表示翻上一页 type等于0表示翻下一页，type大于0表示翻到指定页码
		function trunPage(pageNo, pageSize, type){
			if(type == -1){
				pageNo = pageNo - 1;
			}else if(type == 0){
				pageNo = pageNo + 1;
			}else{ 
				pageNo = type;
			}
			location.href = "<?php echo ($BASEPATH); ?>index.php/Home/User/loadUserListByPage?pageNo="+pageNo+"&pageSize="+pageSize;
		}
		function openWin(type){
			//新增时打开窗口，将uid设置为-1
			if(type == 1){
				$("#uid").val("-1");
				$("#myModal").modal("toggle");
			}else{
				var uids = $("input[name=uids]:checked");
				if(uids.length != 1){
					alert("对不起，您只能选择一行数据进行编辑！");
					return;
				}
				var uid = uids.eq(0).val();
				$.post("<?php echo ($BASEPATH); ?>index.php/Home/User/loadUserById",{uid:uid},function(data){
					$("#uid").val(uid);
					$("#userName").val(data.username);
					$("#userPass").val(data.userpass);
					$("#trueName").val(data.truename);
				},"json");
				//编辑时打开窗口，表单回填
				$("#myModal").modal("toggle");
			}
		}
		</script>
	</head>
	<body> 
		<div style="width:98%;margin:1%;">
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick="openWin(1);"><span class="glyphicon glyphicon-plus"></span>新增</button>
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick="openWin(2);"><span class="glyphicon glyphicon-pencil"></span>编辑</button>
			<button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-remove"></span>删除</button>
			<button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-share-alt"></span>导出Excel</button>
		</div>
		<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
		    <div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">新增/编辑用户</h4>
			        </div>
			        <form id="ff" action="<?php echo ($BASEPATH); ?>index.php/Home/User/saveOrUpdateUser2" method="post">
			        	<div class="modal-body">
							<input type="hidden" name="uid" id="uid" value="">
							<div class="form-group">
								<label>手机：</label>
								<input type="text" class="form-control" id="userName" name="userName" placeholder="输入手机号">
							</div>
							<div class="form-group">
								<label>密码：</label>
								<input type="password" class="form-control" id="userPass" name="userPass" placeholder="输入密码">
							</div>
							<div class="form-group">
								<label>姓名：</label>
								<input type="text" class="form-control" id="trueName" name="trueName" placeholder="输入姓名">
							</div>
			        	</div>
				        <div class="modal-footer">
					        <button type="reset" class="btn btn-default">取消</button>
					        <button type="submit" class="btn btn-primary">确认</button>
				        </div>
			        </form>
			    </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div>
		<table class="table table-striped table-bordered table-condensed" style="width:98%;margin:1%;">
			<tr>
				<th><input type="checkbox" name=""/></th>
				<th>编号</th>
				<th>手机</th>
				<th>密码</th>
				<th>姓名</th>
				<th>头像</th>
			</tr>
			<?php if(is_array($page["rows"])): foreach($page["rows"] as $key=>$u): ?><tr>
					<td><input type="checkbox" name="uids" value="<?php echo ($u["uid"]); ?>"/></td>
					<td><?php echo ($u["uid"]); ?></td>
					<td><?php echo ($u["username"]); ?></td>
					<td><?php echo ($u["userpass"]); ?></td>
					<td><?php echo ($u["truename"]); ?></td>
					<td><?php echo ($u["picture"]); ?></td>
				</tr><?php endforeach; endif; ?>
		</table>
		<nav aria-label="Page navigation" class="text-center">
  			<ul class="pagination pagination-sm">
  				<li><a href="javascript:void(0);">当前显示第<b style="color:red;font-style:italic;"><?php echo ($page["pageNo"]); ?></b>页</a></li>
			    <li>
			      	<a href="javascript:trunPage(<?php echo ($page["pageNo"]); ?>,10,-1);" aria-label="Previous">
			        	<span aria-hidden="true">&laquo;</span>
			      	</a>
			    </li>
			    <li><a href="javascript:trunPage(<?php echo ($page["pageNo"]); ?>,10,1);">1</a></li>
			    <li><a href="javascript:trunPage(<?php echo ($page["pageNo"]); ?>,10,2);">2</a></li>
			    <li><a href="javascript:trunPage(<?php echo ($page["pageNo"]); ?>,10,3);">3</a></li>
			    <li><a href="javascript:trunPage(<?php echo ($page["pageNo"]); ?>,10,4);">4</a></li>
			    <li><a href="javascript:trunPage(<?php echo ($page["pageNo"]); ?>,10,5);">5</a></li>
			    <li>
			      	<a href="javascript:trunPage(<?php echo ($page["pageNo"]); ?>,10,0);" aria-label="Next">
			        	<span aria-hidden="true">&raquo;</span>
			      	</a>
			    </li>
			    <li><a href="javascript:void(0);">共<b style="color:red;font-style:italic;"><?php echo ($page["total"]); ?></b>条数据</a></li>
			</ul>
		</nav>
	</body>
</html>