<?php
pc_base::load_sys_class('BaseModel');

class MyModel extends BaseModel
{
	public function getItemById($id) {
        return $this->where(array('id'=>$id))->find();
    }
	
    public function getLists($filter, $page = 1, $page_size)
    {
	
        $where = '1 and a.is_del = 0 ';
        if (isset($filter['pack_id']) && $filter['pack_id'] != '') {
            $where .= " and a.pack_id like '%" . $filter['pack_id'] . "%'";
        }
      
        if (isset($filter['identity']) && $filter['identity'] != '') {
            $where .= " and a.identity like '%" . $filter['identity'] . "%'";
        }
		if (isset($filter['phone']) && $filter['phone'] != '') {
            $where .= " and a.phone like '%" . $filter['phone'] . "%'";
        }
       
        $limit = ($page - 1) * $page_size . ',' . $page_size;
        $sql = "select * from smjd_my a where $where limit " . $limit;
        $rs = $this->query($sql);
        return $rs;
    }

    
}
