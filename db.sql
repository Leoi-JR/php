create database itcast charset utf8;

use itcast;
create table student(
    id int primary key auto_increment not null,
    name char(10),
    s_code char(5),
    s_group int(2),
    s_score int(3)
);

insert into student values
(default, "张三","Y1001",1,84),
(default, "李四","Y1002",6,83),
(default, "范冰冰","Y1003",1,86),
(default, "薛之谦","Y1004",3,90),
(default, "李克勤","Y1005",6,94),
(default, "周深","Y1006",5,97),
(default, "周杰伦","Y1007",6,87),
(default, "邓紫棋","Y1008",1,80),
(default, "孙楠","Y1009",3,75),
(default, "张信哲","Y1010",4,72),
(default, "太一","Y1011",1,88),
(default, "容祖儿","Y1011",2,99),
(default, "希林娜依高","Y1012",6,100),
(default, "李玟","Y1013",1,90),
(default, "陈小春","Y1014",3,91),
(default, "GAI","Y1015",6,81),
(default, "小鬼","Y1016",3,82);