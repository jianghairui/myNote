<?php
error_reporting(E_ALL & ~ E_NOTICE);
class Page{
	private $total;//总记录条数
	private $nums;//本页记录条数
	public $pages;//总页数
	public $cpage;//当前是哪一页
	private $url;//当前url
	private $listNums;//可见分页数
	public $list;

	public function __construct($total,$nums,$listnums){
		$this->total = $total;
		$this->nums = $nums;
		$this->pages = $this->getPages();
		//$this->cpage = !empty($_GET['page']) ? $_GET['page'] : 1;//获取当前页
		$this->url = $this->setUrl();
		$this->listNums = ($listnums+1)/2;
		
		if(empty($_GET['page'])){
			$this->cpage = 1;}
		elseif($_GET['page']<=$this->pages&&$_GET['page']>=1){
			$this->cpage = $_GET['page'];
		}else{
			$this->cpage = 1;
			echo "<script>alert('跳转页数超出范围');window.location.href = '{$this->setUrl()}page=1'</script>";
		}

		$this->list = $this->nums*($this->cpage - 1).','.$this->nums;
	}
//这个函数是为了去掉url中重复的page参数
	private function setUrl(){

		$url = $_SERVER['REQUEST_URI'];//获取当前url,带参数的
//判断是否有?
		if(strstr($url,'?')){
			//使用parse_url()函数将url分为path(网页路径)和query(参数)两部分
			$arr = parse_url($url);
			if(isset($arr['query'])){
				//使用parse_str()函数将参数变成一个数组$output
				parse_str($arr['query'],$output);
			}
			//删除下标为page的元素，再使用http_build_query()函数将关联数组变回原参数
			unset($output['page']);
			$url = $arr['path'].'?'.http_build_query($output).'&';
		}else{
			$url.= '?';
		}
		return $url;
	}
//得到总页数
	private function getPages(){	
		return ceil($this->total/$this->nums);
	}
//首页和上一页
	private function firstPage(){
		$previous = $this->cpage - 1;
		if($this->cpage > 1){
			return "<a href='{$this->url}page=1'>首页</a> <a href='{$this->url}page={$previous}'>上一页</a>";
		}else{
			return ''; 	
		}
	}
//可见分页数
	private function flist(){

		$list = '';
		$num = $this->listNums;

		for($i=$num-1;$i>=1;$i--){
			$page = $this->cpage - $i;
			if($page>=1){
				$list.= "<a href='{$this->url}page={$page}'>&nbsp;{$page}&nbsp;</a>";	
			}
		}

		for($i=0;$i<$num;$i++){
			$page = $this->cpage + $i;
			if($page<=$this->pages){
				if($i==0){
					$list.= "&nbsp;{$this->cpage}&nbsp;";
				}else{
					$list.= "<a href='{$this->url}page={$page}'>&nbsp;{$page}&nbsp;</a>";
				}	
			}
		}

		return $list;
	}
//下一页和尾页
	private function lastPage(){
		$next = $this->cpage + 1;
		if($this->cpage < $this->pages){
			return "<a href='{$this->url}page={$next}'>下一页</a> <a href='{$this->url}page=".$this->pages."'>尾页</a>";
		}else{
			return '';
		}	
	}
//从多少条开始
	private function start(){
		return $this->nums*($this->cpage - 1) + 1; 
	}
//从多少条结束
	private function end(){	
		return min($this->cpage*$this->nums,$this->total);
	}
//本页显示条数
	private function cnums(){
		return $this->end() - $this->start() + 1;
	}

//跳转页面
	private function skip(){
			return "<form style='margin:0px;padding:0px' method='get' action=''>
			<input style='width:35px' type='text' value='' name='page' placeholder=''>
			<input type='submit' value='跳转'>
			</form>";
	}

//分页公有方法
	public function fpage(){
		$arr = func_get_args();
		$fpage = '';
		$pages[0] = "&nbsp;总共{$this->total}条记录&nbsp;";
		$pages[1] = "&nbsp;本页{$this->cnums()}条记录&nbsp;";
		$pages[2] = "&nbsp;从第 {$this->start()} - {$this->end()} 条记录&nbsp;";
		$pages[3] = "&nbsp;当前第 {$this->cpage}/{$this->pages} 页&nbsp;";
		$pages[4] = "<br>&nbsp;{$this->firstPage()}&nbsp;";
		$pages[5] = "&nbsp;{$this->flist()}&nbsp;";
		$pages[6] = "&nbsp;{$this->lastPage()}&nbsp;";
		$pages[7] = "&nbsp;{$this->skip()}&nbsp;";

		if(count($arr)<1){
			$arr = array(0,1,2,3,4,5,6,7);
		}
		foreach($arr as $key){
			$fpage.=$pages[$key];
		}

		return $fpage;
		
	} 





}



// public function fpage(){
// 		$arr = func_get_args();
// 		$fpage = '';
// 		$pages[0] = "&nbsp;总共{$this->total}条记录&nbsp;";
// 		$pages[1] = "&nbsp;本页{$this->cnums()}条记录&nbsp;";
// 		$pages[2] = "&nbsp;从第 {$this->start()} - {$this->end()} 条记录&nbsp;";
// 		$pages[3] = "&nbsp;当前第 {$this->cpage}/{$this->pages} 页&nbsp;";
// 		$pages[4] = "<br>&nbsp;{$this->firstPage()}&nbsp;";
// 		$pages[5] = "&nbsp;{$this->flist()}&nbsp;";
// 		$pages[6] = "&nbsp;{$this->lastPage()}&nbsp;";

// 		if(count($arr)<1){
// 			$arr = array(0,1,2,3,4,5,6);
// 		}
// 		foreach($arr as $n){
// 			$fpage.=$pages[$n];
// 		}

// 		return $fpage;
		
// 	}
?>