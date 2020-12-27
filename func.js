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
        td1.innerHTML = "<input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"id\">";
        var td2 = document.createElement("td");
        td2.innerHTML = "<input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"name\">";
        var td3 = document.createElement("td");
        td3.innerHTML = "<input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"group\">";
        var td4 = document.createElement("td");
        td4.innerHTML = "<input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"song\">";
        var td5 = document.createElement("td");
        td5.innerHTML = "<input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"score\">";
        var td6 = document.createElement("td");
        td6.innerHTML = "<td>\
                            <a class=\"btn btn-success btn-sm\" href=\"javascript:void(0);\">确定</a> &nbsp;\
                            <a class=\"btn btn-danger btn-sm\" href=\"javascript:void(0);\" onClick=\"confirmDel(<?php echo $arr['id']?>)\">取消</a>\
                        </td>";
        var ref = document.getElementById("data_info").children[0].children[1];
        console.log(ref);
        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        row.appendChild(td5);
        row.appendChild(td6);
        document.getElementById("data_info").children[0].insertBefore(row, ref);              
    }

//定义JS修改函数
function change2input(id){
  var name = $("#"+id+" td:eq(1)").text()
  var s_group = $("#"+id+" td:eq(2)").text()
  var s_song = $("#"+id+" td:eq(3)").text()
  var s_score = $("#"+id+" td:eq(4)").text()
  $("#"+id+" td:eq(1)").html("<input id=\"name2\" type=\"text\" class=\"form-control form-control-sm\" name=\"name\" onchange=\"changeValue(this)\" placeholder='"+name+"' value='"+name+"' required>");
  $("#"+id+" td:eq(2)").html("<input id=\"s_group2\" type=\"text\" class=\"form-control form-control-sm\" name=\"s_group\" onchange=\"changeValue(this)\" placeholder=\""+s_group+"\" value='"+s_group+"' required>");
  $("#"+id+" td:eq(3)").html("<input id=\"s_song2\" type=\"text\" class=\"form-control form-control-sm\" name=\"s_song\" onchange=\"changeValue(this)\" placeholder=\""+s_song+"\" value='"+s_song+"' required>");
  $("#"+id+" td:eq(4)").html("<input id=\"s_score2\" type=\"text\" class=\"form-control form-control-sm\" name=\"s_score\" onchange=\"changeValue(this)\" placeholder=\""+s_score+"\" value='"+s_score+"' required>");
  $("#"+id+" td:eq(5)").html("<button type=\"submit\" class=\"btn btn-success btn-sm\" href=\"javascript:void(0);\" onClick=\"update('"+id+"')\">确定</button> &nbsp;\
                            <a class=\"btn btn-danger btn-sm\" href=\"javascript:void(0);\" onClick=\"cancel('"+id+"','"+name+"','"+s_group+"','"+s_song+"','"+s_score+"')\">取消</a>");
}

function update(id){
  var name = document.getElementById("name2").value;
  var s_group = document.getElementById("s_group2").value;
  var s_song = document.getElementById("s_song2").value;
  var s_score = document.getElementById("s_score2").value;
  console.log(name,s_group,s_song,s_score,1)
  $.ajax({
    url: './alter.php',
    type: 'POST',
    data: {id: id, name: name, s_group: s_group, s_song: s_song, s_score: s_score},
    async: true,
    cache: false,
    success: function (returndata) {
      window.location.replace("./list.php")
    },
    error: function (returndata) {
        alert('请求发送失败');
    }
  })
}

function add(){
  var name = document.getElementById("name").value;
  var s_group = document.getElementById("s_group").value;
  var s_song = document.getElementById("s_song").value;
  var s_score = document.getElementById("s_score").value;

  var name_l = name.length;
  var group_l = s_group.length;
  var song_l = s_song.length;
  var re = /^[0-9]+.?[0-9]*/;//判断字符串是否为数字//判断正整数/[1−9]+[0−9]∗]∗/
  if (name_l==0){
    alert("请填写姓名")
    return
  }
  else if (name_l>10){
    alert("姓名过长")
    return
  }
  else if(group_l==0){
    alert("请填写组别")
    return
  }
  else if(group_l>5){
    alert("组别过长")
    return
  }
  else if(song_l==0){
    alert("请填写歌名")
    return
  }
  else if(song_l>20){
    alert("歌名过长")
    return
  }
　else if(!re.test(s_score)) {
　　alert("请输入正整数");
    return
　}

  $.ajax({
    url: './add.php',
    type: 'POST',
    data: {name: name, s_group: s_group, s_song: s_song, s_score: s_score},
    async: true,
    cache: false,
    success: function (returndata) {
      window.location.replace("./list.php")
    },
    error: function (returndata) {
        alert('请求发送失败');
    }
  })
}

function cancel(id, name,s_group,s_song,s_score){
  $("#"+id+" td:eq(1)").text(name)
  $("#"+id+" td:eq(2)").text(s_group)
  $("#"+id+" td:eq(3)").text(s_song)
  $("#"+id+" td:eq(4)").text(s_score)
}

function changeValue(obj){
  $(obj).attr("value",$(obj).val());
}

function clear1(){
  $("#add_data td input").val("")
}

function changePage(page,query_para,...param){
  if(page==-1){
    if(param[0]==1){
      return
    }
    else{
      page=parseInt(param[0])-1;
    }
  }
  else if(page==-2){
    if(param[0]==param[1]){
      return
    }
    else{
      page=parseInt(param[0])+1;
    }
  }
  if(query_para && query_para.indexOf("page")!=-1){
    query_para = "&"+query_para.replace(/page=\d+&*/g, "")
  }
  else if(query_para){
    query_para = "&"+query_para
  }
  if(query_para.length==1){
    query_para=""
  }
  window.location.replace("./list.php?page="+page+query_para)
}

function selectByScore(){
  var s = document.getElementById("start1").value
  var e = document.getElementById("end1").value

  if(s.length!=0 && e.length!=0){
    window.location.replace("./list.php?s="+s+"&e="+e)
  }
  else if(e.length==0){
    window.location.replace("./list.php?s="+s)
  }
  else if(s.length==0){
    window.location.replace("./list.php?e="+e)
  }
  else{
    //清除value
    return 
  }

}

function selectByGroup(){
  var g = document.getElementById("selected_group").value
  if(g.length!=0){
    window.location.replace("./list.php?g="+g)
  }
}

function goHome(){
  window.location.replace("./list.php")
}