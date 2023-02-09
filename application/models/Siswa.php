<?php

class Siswa extends CI_Model
{
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
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('siswa');
    }
}
