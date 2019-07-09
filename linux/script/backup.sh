#!/bin/bash
#1.定义数据库链接,目标库信息
MY_user="root"
MY_pass="mysql"
MY_host="127.0.0.1"
MY_conn="-u $MY_user -p$MY_pass -h $MY_host"
MY_db1="mpcave"
MY_db2="art"
MY_db3="mpshanhai"
MY_db4="museum"
MY_db5="shopnc"
MY_db6="tjtcy"
#MY_db2="yyyy"
#2.定义备份目录，工具，时间，文件名
BF_dir="/root/mysqlbackup/"
BF_cmd="/usr/bin/mysqldump"
BF_time=$(date +%Y%m%d%H%M%S)
name_1="$BF_time-$MY_db1"
name_2="$BF_time-$MY_db2"
name_3="$BF_time-$MY_db3"
name_4="$BF_time-$MY_db4"
name_5="$BF_time-$MY_db5"
name_6="$BF_time-$MY_db6"
#name_2="$MY_db2-$Bf_time"
#3先导出为.sql脚本，然后再进行压缩（打包后删除源文件）
$BF_cmd $MY_conn --databases $MY_db1 > $BF_dir$name_1.sql
echo $name_1;
$BF_cmd $MY_conn --databases $MY_db2 > $BF_dir$name_2.sql
echo $name_2
$BF_cmd $MY_conn --databases $MY_db3 > $BF_dir$name_3.sql
echo $name_3
$BF_cmd $MY_conn --databases $MY_db4 > $BF_dir$name_4.sql
echo $name_4
$BF_cmd $MY_conn --databases $MY_db5 > $BF_dir$name_5.sql
echo $name_5
$BF_cmd $MY_conn --databases $MY_db6 > $BF_dir$name_6.sql
echo $name_6
#/bin/tar zcf $name_1.tar.gz $name_1.sql --remove &> /dev/null
#/bin/tar zcf $name_2.tar.gz $name_2.sql --remove &> /dev/null
