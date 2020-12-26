create database itcast charset utf8;

use itcast;
create table singer(
    id int primary key auto_increment not null,
    name char(10),
    s_group char(5),
    s_song char(20),
    s_score int(3)
);

insert into singer values
(default, "孙楠","B1","《风往北吹》",84),
(default, "张云龙","B1","《All I Ask of You》",83),
(default, "李玟","B2","《刀马旦》",86),
(default, "王凯琳","B2","《过完冬季》",90),
(default, "常石磊","B3","《我我》",94),
(default, "王源","B3","《可乐》",97),
(default, "陈小春","B4","《没那种命个》",87),
(default, "GAI","B4","《神啊 救救我》",80),
(default, "张信哲","A1","《太想爱你》",75),
(default, "太一","A1","《难以抗拒你容颜》",72),
(default, "容祖儿","A2","《挥着翅膀的女孩》",88),
(default, "希莉娜依高","A2","《不如跳舞》",99),
(default, "钟镇涛","A3","《只要你过得比我好》",100),
(default, "冯提莫","A3","《后会有期》",90),
(default, "黄绮珊","A4","《是否爱过我》",91),
(default, "张碧晨","A4","《光辉岁月》",81),
(default, "李克勤","C1","《富士山下》",100),
(default, "周深","C1","《富士山下》",100);