<?php
pc_base::load_sys_class('BaseModel');

class UserModel extends BaseModel
{
	public function getLists($filter, $page=1, $page_size) {
	    $where = '1';
	    if (isset($filter['user_name']) && $filter['user_name'] != '') {
	    	$where .= " and a.user_name like '%".$filter['user_name']."%'";
	    }
	    if (isset($filter['phone']) && $filter['phone'] != '') {
	        $where .= " and a.phone like '%".$filter['phone']."%'";
	    }
	    if (isset($filter['idcard']) && $filter['idcard'] != '') {
	        $where .= " and a.idcard like '%".$filter['idcard']."%'";
	    }
		 if (isset($filter['com']) && $filter['com'] != '') {
	        $where .= " and a.company like '%".$filter['com']."%'";
	    }
	    if (isset($filter['area']) && $filter['area'] != '') {
	        $where .= " and a.area like '%".$filter['area']."%'";
	    }
	   
	    $limit = ($page - 1) * $page_size . ',' . $page_size;
	    $sql = "
	        select * from smjd_user a where $where $order limit " . $limit;
	    $rs = $this->query($sql);
	    return $rs;
	}
	
	
	public function getCounts($filter) {
	    $where = '1';
	    if (isset($filter['user_name']) && $filter['user_name'] != '') {
	        $where .= " and a.user_name like '%".$filter['user_name']."%'";
	    }
	    if (isset($filter['phone']) && $filter['phone'] != '') {
	        $where .= " and a.phone like '%".$filter['phone']."%'";
	    }
	    if (isset($filter['name']) && $filter['name'] != '') {
	        $where .= " and a.name like '%".$filter['name']."%'";
	    }
	    $sql = "
	        select count(1) as num from smjd_user a where $where 
	        ";
	    $rs = $this->query($sql);
	    return $rs[0]['num'];
	}
}
