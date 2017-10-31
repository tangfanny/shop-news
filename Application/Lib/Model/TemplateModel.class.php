<?php

class TemplateModel  extends Model {


	/**
	 * getList 基础模版-获取列表
	 * @author lishuang
	 * @version C1.0
	 */
    public function getList($C){
    	$TableName=C("DB_PREFIX").$C["M"];
    	$field=$C["field"];
    	if(!empty($field)){
	 	   $field="FROM_UNIXTIME(".$TableName.".createtime,'%Y-%m-%d') as create_time";
	    }else{
	    	$field="*,FROM_UNIXTIME(".$TableName.".createtime,'%Y-%m-%d') as create_time";
	    }
	    
   		foreach($C["where"] as $k=>$v){
   			if($k=="_logic" || $k=="_string"){
   		   		    $where[$k] =$v;		
   			}else{
   		  	  $where[$TableName.".".$k] =$v;
   		    }
   		}
   
	   	foreach($C['join'] as $k=>$v){
			$joinTable=C("DB_PREFIX").$k;
			$on=$v["on"];
			$joinStr="";
			$num=0;
			foreach($on as $onk=>$onv){
				if($num>0){$joinStr.=" and ";}
				if (is_numeric($onk)){
					$joinStr.=$joinTable." on ".$joinTable.".".$onv."=".$TableName.".".$onv;
				}else{
					$joinStr.=$joinTable." on ".$joinTable.".".$onk."=".$TableName.".".$onv;		
				}
				$num++;			
			}
			$this->join($joinStr);	
			
			foreach($v["field"] as $f){
				$field.=",".$joinTable.".".$f." as ".$f;
			}
			foreach($v["where"] as $name=>$value){
				$where[$joinTable.".".$name] =$value;
			}
		}
		
		foreach($C['field'] as $v){
			$field.=",".$TableName.".".$v." as ".$v;	
		}
		
		
		$order				=$C["order"];
   		$limit				=$C["limit"];
   		
   		if(!empty($order)){
	 	   $this->order($order);
	    }
	    if(!empty($limit)){
	    	$this->limit($limit);
	    }
	    if(!empty($field)){
	    	$this->field($field);
	    }
	   	$this->table($TableName);
	   	
	    $list		=$this->where($where)->select();
	    
		if(!empty($C["child"])){
			foreach($list as $k=>$v){
				$where=array();
				
				$i=0;
			    foreach($C["child"]["where"] as $k2=>$v2){		   
			    	if($i==0){
		   		 		 $where[$k2] =$v[$v2];
		   		 		 $i=1;
		   		 	}else{
		   		 		$where[$k2] =$v2;
		   		 	}
		   		}

		   		
		   		
		   		$CH["M"]=$C["child"]["M"];
		   		$CH["where"]=$where;
		   		$CH["order"]=$C["child"]["order"];
				$list[$k][$C["child"]["M"]]=self::getList($CH);
			}	
		}
		//echo $this->getLastSql()."<br>";
	    return $list;
	}
	


	


}