<?php
header("content-type:text/html;charset=utf-8");
//包含连接数据库的公共文件
require_once("./conn.php");
//获取记录数
$sql = "SELECT * FROM student";
$records = $db->rowCount($sql);
//获取多行数据
$sql .= " ORDER BY id DESC";
$arrs = $db->fetchAll($sql, 3);
// print_r($arrs);

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>数据中心</title>
<script type="text/javascript">
//定义JS删除函数
function confirmDel(id){
    //询问是否要删除
    if(window.confirm("你真的要删除吗？")){
        //如果单击“确定”，则跳转到delete.php页面
        location.href = "./delete.php?id="+id;
    }
}

function addRow1(){
        var userInfo = document.getElementById("data_info");
        var row = document.createElement("tr");
        var td1 = document.createElement("td");
        td1.innerHTML = "<input type=\"text\" name=\"name\" placeholder=\"1\">";
        var td2 = document.createElement("td");
        td2.innerHTML = "<input type=\"text\" name=\"s_code\">";
        var td3 = document.createElement("td");
        td3.innerHTML = "<input type=\"text\" name=\"s_group\">";
        var td4 = document.createElement("td");
        td4.innerHTML = "<input type=\"text\" name=\"s_score\">";
        var td5 = document.createElement("td");
        td5.innerHTML = "<input type=\"text\" name=\"id\">";
        var td6 = document.createElement("td");
        td6.innerHTML = "<input type=\"text\" name=\"id\">";
        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        row.appendChild(td5);
        userInfo.appendChild(row);              
    }


</script>
</head>

<body>
    <div style="text-align:center;padding-bottom:10px;">
        <h2>数据中心</h2>
        <a href="javascript:void(0);" onClick="addRow1()">添加数据</a>
        共<font color="red"><?php echo $records;?></font>个学生
    </div>
    <table id="data_info" width="600" border="1" bordercolor="#ccc" rules="all" align="center" cellpadding="3">
        <tr bgcolor="#f0f0f0">
            <th>姓名</th>
            <th>学号</th>
            <th>组别</th>
            <th>分数</th>
            <th>id</th>
            <th>操作</th>
        </tr>
        <?php
        foreach($arrs as $arr){
        ?>
        <tr align="center">
            <td><?php echo $arr["name"];?></td>
            <td><?php echo $arr["s_code"];?></td>
            <td><?php echo $arr["s_group"];?></td>
            <td><?php echo $arr["s_score"];?></td>
            <td><?php echo $arr["id"];?></td>
            <td>
                <a href="javascript:void(0);">修改</a> |
                <a href="javascript:void(0);" onClick="confirmDel(<?php echo $arr['id']?>)">删除</a>
            </td>

        </tr>
        <?php }?>
    </table>
</body>

</html>