<?php

/**
 * Description of SysApplicationModel
 *
 * @author ekoaprianto
 */
class SysApplicationModel extends My_model
{

    public function __construct()
    {
        parent::__construct();
        parent::set_databases();
    }

    public function get_total_rows()
    {
        $sql = "SELECT  COUNT(*)'total'
                FROM sys_application
                ";
        $query = $this->db_rbac->query($sql);
        if ($query->num_rows() > 0)
        {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else
        {
            return 0;
        }
    }

    public function get_all()
    {
        $sql = "SELECT * FROM (
                    SELECT app_id,app_code,app_name,app_version,app_title,app_desc,app_url,app_is_active,app_release_date,meta_desc,meta_keyword,cdb,cdd,mdb,mdd,guid
                    FROM sys_application
                )result
                WHERE 1=1
                ";
        $query = $this->db_rbac->query($sql);
        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else
        {
            return array();
        }
    }

    public function get_data_by_id($params)
    {
        $sql = "SELECT * FROM sys_application WHERE app_id = ?";
        $query = $this->db_rbac->query($sql, $params);
        if ($query->num_rows() > 0)
        {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else
        {
            return array();
        }
    }

    public function get_list()
    {
        $sql = "SELECT * FROM sys_application";
        $query = $this->db_rbac->query($sql);
        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else
        {
            return array();
        }
    }

    public function insert($params)
    {
        $sql = "INSERT INTO sys_application
                (app_id, app_code,app_name, app_version, app_title, app_desc, app_url, app_is_active, app_release_date, meta_desc, meta_keyword, cdb, cdd, guid)
                VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), UUID())";
        return $this->db_rbac->query($sql, $params);
    }

    public function update($params)
    {
        $sql = "UPDATE sys_application
                SET app_id=?, app_code=?, app_name=?, app_version=?, app_title=?, app_desc=?, app_url=?, app_is_active=?, app_release_date=?, meta_desc=?, meta_keyword=?, mdb=?, mdd == NOW()";
        return $this->db_rbac->query($sql, $params);
    }

    public function delete($params)
    {
        $sql = "DELETE FROM sys_application WHERE app_id = ?";
        return $this->db_rbac->query($sql, $params);
    }

}
