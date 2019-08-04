<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
$filename = "msg.txt";
$msgs = [];
//$string="";
if(file_exists($filename)){
	$string = file_get_contents($filename);
	if(strlen($string)>0){
		$msgs = unserialize($string);

	}
}

if(isset($_POST['submit'])){
		$username = $_POST['name'];
		$age = $_POST['age'];
		$gender = $_POST['sex'];
		$time = time();
		$data = compact('username','age','gender','time');
		array_push($msgs,$data);
		$msgs = serialize($msgs);
		if (file_put_contents($filename,$msgs)) {
			echo "<script>alert('success');location.href='msg.php'</script>";
		}

}
var_dump($msgs);
//$msg = 索引加关联数组
//file_get_contents($filename):得到文件中的内容，返回的是字符串
//file_put_coomtents($filename,$data):向指定文件写内容，如果文件不存在文件会创建
//serialize($str);序列化字符串
//unserialize($str);反序列化
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<?php if(is_array($msgs)&&count($msgs)>0):?>
			<table>
				<thead>
					<tr>
						<th>
							编号
						</th>
						<th>
							name
						</th>
						<th>
							age
						</th>
						<th>
							gender
						</th>
						<th>
							time
						</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;foreach($msgs as $val):?>
					<tr>
						<td>
							<?php echo $i;?>
						</td>
						<td>
							<?php echo $val['username'];?>
						</td>
						<td>
							<?php echo $val['age'];?>
						</td>
						<td>
							<?php echo $val['gender'];?>
						</td>
						<td>
							<?php echo date("m/d/y,m:i:s"),$val['time'];?>
						</td>
					</tr>	
				</tbody>
				<?php endforeach; ?>
				</tbody>
			</table>
	<?php endif; ?>
<form action="#" method="post">
	Name<input type="text" name="name" required><br><br>
	Age<input type="text" name="age" required><br><br>
	gender<input type="text" name="sex" required><br><br>
	<input type="submit" name="submit">

</form>


</body>
</html>