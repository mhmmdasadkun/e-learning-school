<?php

class Siswa extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'siswa';
    var $column_order = ['sw_nama', 'sw_email', 'sw_nisn'];
    var $column_search = ['sw_nama', 'sw_email', 'sw_nisn'];
    var $order = ['id' => 'DESC'];

    public function rules()
    {
        return [
            ['field' => 'sw_nama', 'label' => 'Nama Lengkap', 'rules' => 'required|trim'],
            ['field' => 'sw_email', 'label' => 'Email', 'rules' => 'required|trim|valid_email|is_unique[siswa.sw_email]'],
            ['field' => 'sw_nisn', 'label' => 'NISN', 'rules' => 'required|trim|numeric|is_unique[siswa.sw_nisn]'],
            ['field' => 'sw_nis', 'label' => 'NIS', 'rules' => 'required|trim|numeric|is_unique[siswa.sw_nis]'],
            ['field' => 'sw_tmpt_lahir', 'label' => 'Tempat Lahir', 'rules' => 'required|trim'],
            ['field' => 'sw_tgl_lahir', 'label' => 'Tanggal Lahir', 'rules' => 'required|trim'],
            ['field' => 'sw_gender', 'label' => 'Gender', 'rules' => 'required|trim'],
            ['field' => 'sw_notelp', 'label' => 'Nomor Telepon', 'rules' => 'required|trim|numeric|is_unique[siswa.sw_notelp]'],
        ];
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

    public function checking($data)
    {
        return $this->db->get_where('siswa', $data);
    }
    public function create($data)
    {
        return $this->db->insert('siswa', $data);
    }
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('siswa', $data);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('siswa');
    }
}
