<?php
header("content-type:text/html;charset=utf-8");
//包含连接数据库的公共文件
require_once("./conn.php");

//每页显示的记录数
$dis_num = 10;
//获取记录数
$sql = "SELECT * FROM singer";

@list("s"=>$s, "e"=>$e, "g"=>$g)=$_GET;
if(!isset($s) && !isset($e)){
}
elseif(!isset($s)){
  $sql .= " WHERE s_score<= $e";
}
elseif(!isset($e)){
  $sql .= " WHERE s_score>= $s";
}
else{
  $sql .= " WHERE s_score>= $s and s_score<= $e";
}
if(isset($g)){
  $sql .= " WHERE s_group='$g'";
}
$records = $db->rowCount($sql);
//总页数
$total_pages = ceil($records/$dis_num);
//获取当前页数
$cur_page = isset($_GET["page"])?$_GET["page"]:1;
//起始记录
$start = ((int)$cur_page-1)*$dis_num;

$sql .= " ORDER BY id DESC LIMIT $start, $dis_num";
$arrs = $db->fetchAll($sql, 3);

$query_para = $_SERVER["QUERY_STRING"];
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>我们的歌第二季</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="./func.js"></script>
</head>

<body>
    <div style="text-align:center;padding-bottom:10px;">
        <h2>我们的歌第二季</h2>
        共<font color="red"><?php echo $records;?></font>个歌手
    </div>

    <div class="container">
      <div class="row justify-content-md-center">
        <button type="button" class="btn btn-outline-secondary btn-lg" onClick="goHome()">回到首页</button>
      </div>
    </div>
    <br>
    
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="form-inline">
          <form class="form-inline">
            <div class="form-group  mb-2">
              <label>GROUP</label>
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <input type="text" class="form-control" id="selected_group" placeholder="Group" onchange="changeValue(this)">
            </div>
            <button type="button" class="btn btn-primary mb-2" onClick="selectByGroup()" value="">SELECT</button>
          </form>
        </div>
      </div>


      <div class="row justify-content-md-center">
        <form class="form-inline offset-md-1">
          <div class="form-group  mb-2">
            <label>SCORE</label>
          </div>
          <div class="form-group mx-sm-3 mb-2">
            <span class="input-group-text">>=</span>
            <input type="text" class="form-control" id="start1" placeholder="Lower limit" onchange="changeValue(this)">
          </div>
          <div class="form-group mx-sm-3 mb-2">
            <span class="input-group-text"><=</span>
            <input type="text" class="form-control" id="end1" placeholder="Upper limit" onchange="changeValue(this)">
          </div>
          <button type="button" class="btn btn-primary mb-2" onClick="selectByScore()">SELECT</button>
        </form>
      </div>
    </div>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <table class="table table-striped" id="data_info">
                    <tr align="center">
                        <th scope="col">id</th>
                        <th scope="col">姓名</th>
                        <th scope="col">组别</th>
                        <th scope="col">作品</th>
                        <th scope="col">得分</th>
                        <th scope="col">操作</th>
                    </tr>
                    <tr align="center" id="add_data">
                        <td><input id="id" type="text" class="form-control form-control-sm" placeholder="AUTO_INCREMENT" name="id" onchange="changeValue(this)" disabled></td>
                        <td><input id="name" type="text" class="form-control form-control-sm" placeholder="name" name="name" onchange="changeValue(this)" required></td>
                        <td><input id="s_group" type="text" class="form-control form-control-sm" placeholder="group" name="s_group" onchange="changeValue(this)" required></td>
                        <td><input id="s_song" type="text" class="form-control form-control-sm" placeholder="song" name="s_song" onchange="changeValue(this)" required></td>
                        <td><input id="s_score" type="text" class="form-control form-control-sm" placeholder="score" name="s_score" onchange="changeValue(this)" required></td>
                        <td>
                            <button type="submit" class="btn btn-success btn-sm" href="javascript:void(0);" onClick="add()">添加</button> &nbsp;
                            <button class="btn btn-danger btn-sm" href="javascript:void(0);" onClick="clear1()">清除</button>
                        </td>

                    </tr>
                    <?php
                    foreach($arrs as $arr){
                    ?>  
                    <tr align="center" id=<?php echo $arr["id"];?>>
                        <td><?php echo $arr["id"];?></td>
                        <td><?php echo $arr["name"];?></td>
                        <td><?php echo $arr["s_group"];?></td>
                        <td><?php echo $arr["s_song"];?></td>
                        <td><?php echo $arr["s_score"];?></td>
                        <td>
                            <a class="btn btn-success btn-sm" href="javascript:void(0);" onClick="change2input(<?php echo $arr['id']?>)">修改</a> &nbsp;
                            <a class="btn btn-danger btn-sm" href="javascript:void(0);" onClick="confirmDel(<?php echo $arr['id']?>)">删除</a>
                        </td>

                    </tr>
                    <?php }?>


                    
                </table>
            </div>
        </div>

      <!-- 分页 -->
      <div class="row justify-content-md-center">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(-1, '<?php echo $query_para;?>', <?php echo $cur_page;?>, <?php echo $total_pages;?>)">Previous</a></li>
            <?php if($total_pages<7): ?>
                    <?php for($i=0; $i<$total_pages; $i++): ?>
                      <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')"><?php echo $i+1;?></a></li>
                    <?php endfor; ?>
                    
            <?php else: ?>
              <?php if($cur_page<=3):?>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')">2</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')">3</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')">...</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')"><?php echo $total_pages;?></a></li>
              <?php elseif($cur_page<=$total_pages-3):?>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')">...</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')"><?php echo $cur_page-1;?></a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')"><?php echo $cur_page;?></a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')"><?php echo $cur_page+1;?></a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')">...</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')"><?php echo $total_pages;?></a></li>
              <?php else:?>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')">...</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')"><?php echo $total_pages-2;?></a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')"><?php echo $total_pages-1;?></a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(<?php echo $i+1;?>, '<?php echo $query_para;?>')"><?php echo $total_pages;?></a></li>
              <?php endif; ?>
            <?php endif; ?>
            <li class="page-item"><a class="page-link" href="javascript:void(0);" onClick="changePage(-2, '<?php echo $query_para;?>', <?php echo $cur_page;?>, <?php echo $total_pages;?>)">Next</a></li>
          </ul>
        </nav>
      </div>

    </div>


</body>

</html>

