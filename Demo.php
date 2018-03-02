<?php
include_once("XlsExport.class.php");
date_default_timezone_set("Asia/Shanghai");

//标题行
$title = array('奖金会员','购买会员','订单编号 ','差价金额');

//内容
$data = array(
    array(1,2,3,4),
    array(1,2,3,4),
    array(1,2,3,4),
);

$xls = new XlsExport();
$xls->title = $title;
$xls->data = $data;
$xls->filename = "导出数据".date('dHis').".xls";
$xls->export_xls();