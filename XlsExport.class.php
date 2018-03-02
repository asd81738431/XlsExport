<?php
//xls导出类

//定义关闭脚本时停止导出工作
Ignore_User_Abort(False);

class XlsExport
{
	public $title;
	public $data;
	public $filename;
	
	/** 
	* 导出Xls
	* @name export_xls
	* @retu string
	*/
	public function export_xls(){
		$title = implode("\t",$this->iconvData($this->title)) . "\n";
		$data = $this->iconvData($this->data);
		array_walk($data,function(&$val){$val = (implode("\t",$val))."\n";});
		$data = implode("",$data);
		
		$this->headerSet();
		echo $title.$data;
	}
	
	/** 
	* 字符转码
	* @name iconvData
	* @param array $data 转码数据
	* @retu array
	*/
	public function iconvData($data){
		array_walk($data,function(&$val){
			if(is_array($val)){
				array_walk($val,function(&$val2){$val2 = iconv('utf-8','gbk',$val2);});
			}else{
				$val = iconv('utf-8','gbk',$val);
			}
		});
		
		return $data;
	}
	
	/** 
	* 设置header头
	* @name headerSet
	* @retu string
	*/
	public function headerSet(){
		header("Pragma:public");
		header("Expires:0");
		header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
		header("Content-Type:application/force-download");
		header("Content-Type:application/vnd.ms-execl");
		header("Content-Type:application/octet-stream");
		header("Content-Type:application/download");
		header("Content-Disposition:attachment;filename='".$this->filename."'");
		header("Content-Type:Transfer-Encoding:binary");
	}
}