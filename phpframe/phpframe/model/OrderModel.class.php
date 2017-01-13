<?php
pc_base::load_sys_class('BaseModel');

class OrderModel extends BaseModel
{
	public function getItemById($id) {
        return $this->where(array('order_id'=>$id))->find();
    }
    public function getLists($filter, $page = 1, $page_size)
    {
        $where = '1';
        if (isset($filter['order_sn']) && $filter['order_sn'] != '') {
            $where .= " and a.order_sn like '%" . $filter['order_sn'] . "%'";
        }
      
        if (isset($filter['order_type']) && $filter['order_type'] != '') {
            $where .= " and b.order_type like '%" . $filter['order_type'] . "%'";
        }
		if (isset($filter['user_id']) && $filter['user_id'] != '') {
            $where .= " and a.user_id like '%" . $filter['user_id'] . "%'";
        }
        if (isset($filter['phone']) && $filter['phone'] != '') {
            $where .= " and a.phone like '%" . $filter['phone'] . "%'";
        }
		if (isset($filter['idcard']) && $filter['idcard'] != '') {
            $where .= " and a.idcard like '%" . $filter['idcard'] . "%'";
        }
        if (isset($filter['add_time']) && $filter['add_time'] != '') { // 记录时间
            $where .= " and a.add_time >= '" . strtotime($filter['add_time']) . "'";
        }
		
       
        // 排序条件
        if (isset($filter['order']) && $filter['order'] != '') {
            $order = " ORDER BY a." . $filter['order'] . " DESC ";
        } else {
            $order = ' ORDER BY a.order_id DESC ';
        }
        $limit = ($page - 1) * $page_size . ',' . $page_size;
        $sql = "select a.*, b.real_name, b.company,b.area from smjd_order_".date("Ymd")." a left join smjd_user b on a.user_id = b.user_id where $where $order limit " . $limit;
        $rs = $this->query($sql);
        return $rs;
    }

    public function getCounts($filter)
    {
        $where = '1';
        if (isset($filter['order_sn']) && $filter['order_sn'] != '') {
            $where .= " and a.order_sn like '%" . $filter['order_sn'] . "%'";
        }
      
        if (isset($filter['order_type']) && $filter['order_type'] != '') {
            $where .= " and b.order_type like '%" . $filter['order_type'] . "%'";
        }
		if (isset($filter['user_id']) && $filter['user_id'] != '') {
            $where .= " and a.user_id like '%" . $filter['user_id'] . "%'";
        }
        if (isset($filter['phone']) && $filter['phone'] != '') {
            $where .= " and a.phone like '%" . $filter['phone'] . "%'";
        }
		if (isset($filter['idcard']) && $filter['idcard'] != '') {
            $where .= " and a.idcard like '%" . $filter['idcard'] . "%'";
        }
        if (isset($filter['add_time']) && $filter['add_time'] != '') { // 记录时间
            $where .= " and a.add_time >= '" . strtotime($filter['add_time']) . "'";
        }
		
        $sql = "select count(1) as num from smjd_order_".date("Ymd")."  a left join smjd_user b on a.user_id = b.user_id where $where";
        $rs = $this->query($sql);
        return $rs[0]['num'];
    }
}
