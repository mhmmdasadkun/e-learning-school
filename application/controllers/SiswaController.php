<?php

class SiswaController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('siswa');
        $this->load->model('datatables');
    }

    public function index()
    {
        $data['title'] = "Daftar Siswa";
        $data['session'] = $this->session;

        $this->load->view('layouts/header', $data);
        $this->load->view('siswa/list');
    }

    public function siswaList()
    {
        $list = $this->datatables->getDatatables();
        $data = [];
        $no = $this->input->post('start');

        foreach ($list as $siswa) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $siswa->sw_nama;
            $row[] = $siswa->sw_email;
            $row[] = $siswa->sw_nisn;

            $row[] = '<button class="btn btn-sm btn-warning" title="Ubah" onclick="edit(' . $siswa->id . ')">Ubah</button>
            <button class="btn btn-sm btn-danger" title="Hapus" onclick="hapus(' . $siswa->id . ')">Hapus</button>';

            $data[] = $row;
        }

        $output = [
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->datatables->countAll(),
            "recordsFiltered" => $this->datatables->countFiltered(),
            "data" => $data
        ];
        //output to json format
        echo json_encode($output);
    }

    public function create()
    {
        $this->form_validation->set_rules($this->siswa->rules());

        if ($this->form_validation->run()) {
            $data = [
                'sw_nama' => $this->input->post('sw_nama'),
                'sw_email' => $this->input->post('sw_email'),
                'sw_nisn' => $this->input->post('sw_nisn'),
                'sw_nis' => $this->input->post('sw_nis'),
                'sw_tmpt_lahir' => $this->input->post('sw_tmpt_lahir'),
                'sw_tgl_lahir' => $this->input->post('sw_tgl_lahir'),
                'sw_gender' => $this->input->post('sw_gender'),
                'sw_notelp' => $this->input->post('sw_notelp'),
                'sw_updated' => NULL
            ];

            $this->siswa->create($data);
            echo json_encode(['success' => true, 'msg' => 'Data berhasil ditambahkan!',  'code' => 200]);
        } else {
            echo json_encode(['err' => $this->form_validation->error_array(), 'code' => 400]);
        }
    }

    public function edit($id)
    {
        $data = $this->siswa->checking(['id' => $id])->row();
        echo json_encode($data);
    }


    public function update()
    {
        $siswa = $this->siswa->checking(['id' => $this->input->post('id')])->row();

        $rule_email = ($this->input->post('sw_email') == $siswa->sw_email ? 'required|valid_email|trim' : 'required|trim|valid_email|is_unique[siswa.sw_email]');
        $rule_nisn = ($this->input->post('sw_nisn') == $siswa->sw_nisn ? 'required|numeric|trim' : 'required|trim|numeric|is_unique[siswa.sw_nisn]');
        $rule_nis = ($this->input->post('sw_nis') == $siswa->sw_nis ? 'required|numeric|trim' : 'required|trim|numeric|is_unique[siswa.sw_nis]');
        $rule_notelp = ($this->input->post('sw_notelp') == $siswa->sw_notelp ? 'required|numeric|trim' : 'required|trim|numeric|is_unique[siswa.sw_notelp]');

        $this->form_validation->set_rules('sw_nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('sw_email', 'Email', $rule_email);
        $this->form_validation->set_rules('sw_nisn', 'NISN', $rule_nisn);
        $this->form_validation->set_rules('sw_nis', 'NIS', $rule_nis);
        $this->form_validation->set_rules('sw_tmpt_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('sw_tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('sw_gender', 'Gender', 'required|trim');
        $this->form_validation->set_rules('sw_notelp', 'Nomor Telepon', $rule_notelp);


        if ($this->form_validation->run()) {
            $data = [
                'sw_nama' => $this->input->post('sw_nama'),
                'sw_email' => $this->input->post('sw_email'),
                'sw_nisn' => $this->input->post('sw_nisn'),
                'sw_nis' => $this->input->post('sw_nis'),
                'sw_tmpt_lahir' => $this->input->post('sw_tmpt_lahir'),
                'sw_tgl_lahir' => $this->input->post('sw_tgl_lahir'),
                'sw_gender' => $this->input->post('sw_gender'),
                'sw_notelp' => $this->input->post('sw_notelp')
            ];

            $this->siswa->update($siswa->id, $data);
            echo json_encode(['success' => true, 'msg' => 'Data berhasil diubah!',  'code' => 200]);
        } else {
            echo json_encode(['err' => $this->form_validation->error_array(), 'code' => 400]);
        }
    }

    public function delete($id)
    {
        $this->siswa->delete($id);
        echo json_encode(['success' => true, 'msg' => 'Data berhasil diubah!',  'code' => 200]);
    }
}
