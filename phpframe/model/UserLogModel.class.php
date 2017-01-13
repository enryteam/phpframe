<?php
pc_base::load_sys_class('BaseModel');

class UserLogModel extends BaseModel
{

    public function getLists($filter, $page = 1, $page_size)
    {
        $where = '1';
        if (isset($filter['user_name']) && $filter['user_name'] != '') {
            $where .= " and a.user_name like '%" . $filter['user_name'] . "%'";
        }
        if (isset($filter['phone']) && $filter['phone'] != '') {
            $where .= " and a.phone like '%" . $filter['phone'] . "%'";
        }
        if (isset($filter['name']) && $filter['name'] != '') {
            $where .= " and a.name like '%" . $filter['name'] . "%'";
        }
        if (isset($filter['type']) && $filter['type'] != '') {
            $where .= " and b.type = " . $filter['type'];
        }
        $order = ' ORDER BY b.log_id DESC ';
        $limit = ($page - 1) * $page_size . ',' . $page_size;
        $sql = "
            select 
                b.log_id, b.type, b.order_id, b.type, b.old_money, b.money, b.remark, b.time,
                a.user_id, a.user_name, a.phone, a.name
            from 
                smjd_user_log b 
            left join smjd_user a 
            on b.user_id = a.user_id 
            where $where $order limit " . $limit;
        $rs = $this->query($sql);
        return $rs;
    }

    public function getCounts($filter)
    {
        $where = '1';
        if (isset($filter['user_name']) && $filter['user_name'] != '') {
            $where .= " and a.user_name like '%" . $filter['user_name'] . "%'";
        }
        if (isset($filter['phone']) && $filter['phone'] != '') {
            $where .= " and a.phone like '%" . $filter['phone'] . "%'";
        }
        if (isset($filter['name']) && $filter['name'] != '') {
            $where .= " and a.name like '%" . $filter['name'] . "%'";
        }
        if (isset($filter['type']) && $filter['type'] != '') {
            $where .= " and b.type = " . $filter['type'];
        }
        $sql = "select count(1) as num from smjd_user_log b left join smjd_user a on b.user_id = a.user_id where $where";
        $rs = $this->query($sql);
        return $rs[0]['num'];
    }
}
