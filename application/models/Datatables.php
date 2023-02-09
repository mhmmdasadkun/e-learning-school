<?php

class Datatables extends CI_Model
{
    var $table = 'siswa';
    var $column_order = ['sw_nama', 'sw_email', 'sw_nisn'];
    var $column_search = ['sw_nama', 'sw_email', 'sw_nisn'];
    var $order = ['id' => 'DESC'];

    public function __construct()
    {
        parent::__construct();
    }

    private function getTableQuery()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) {
            if (isset($_POST['search']['value'])) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function getDatatables()
    {
        $this->getTableQuery();
        // if (isset($_POST['length']) != -1) {
        //     $this->db->limit($_POST['length'], $_POST['start']);
        // }
        $query = $this->db->get();
        return $query->result();
    }

    function countFiltered()
    {
        $this->getTableQuery();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function countAll()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getById($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }
}
