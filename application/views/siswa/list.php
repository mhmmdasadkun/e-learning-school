<div class="content-wrapper">
    <div class="content-main">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="content-title-breadcrumb d-sm-flex align-items-center justify-content-between">
                        <h4>Daftar Siswa</h4>
                        <div class="breadcrumb-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Daftar Siswa</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-sm-12 col-md-6">
                                    <h4>Data Siswa</h4>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <button class="btn btn-primary fs-15 btn-sm float-end" id="handleAdd">Tambah Data</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body fs-15">
                            <table class="table table-striped align-middle border-top" id="siswaTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama</th>
                                        <th>NISN</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="siswaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="siswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="siswaModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <div>
                        <input type="hidden" name="id" id="id">
                    </div>
                    <div class="mb-3">
                        <label for="sw_nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="sw_nama" class="form-control" id="sw_nama" placeholder="Masukan nama lengkap">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label for="sw_nisn" class="form-label">NISN</label>
                                <input type="number" name="sw_nisn" class="form-control" id="sw_nisn" placeholder="Masukan NISN">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label for="sw_nis" class="form-label">NIS</label>
                                <input type="number" name="sw_nis" class="form-control" id="sw_nis" placeholder="Masukan NIS">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sw_email" class="form-label">Email Address</label>
                        <input type="email" name="sw_email" class="form-control" id="sw_email" placeholder="Masukan email address">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="sw_notelp" class="form-label">Nomor Telepon</label>
                        <input type="number" name="sw_notelp" class="form-control" id="sw_notelp" placeholder="Masukan nomor telepon">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="sw_gender" class="form-label">Gender</label>
                        <select name="sw_gender" id="sw_gender" class="form-select">
                            <option value="0" selected disabled>Pilih</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label for="sw_tmpt_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="sw_tmpt_lahir" class="form-control" id="sw_tmpt_lahir" placeholder="Masukan tempat lahir">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label for="sw_tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="sw_tgl_lahir" class="form-control" id="sw_tgl_lahir" placeholder="Masukan tanggal lahir">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="handleSubmit">Simpan</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>

<script>
    var method;
    var siswaTable;

    siswaTable = $('#siswaTable').DataTable({
        processing: true,
        serverside: true,
        orderable: false,
        ajax: {
            url: '<?= $this->config->item('routes')['siswa-data']; ?>',
            type: 'POST'
        },
        columnDefs: [{
            width: "10%",
            targets: 0,
            orderable: false,
        }],
    });


    $("input").change(function() {
        $(this).removeClass('is-invalid');
        $(this).next().empty();
    });
    $("select").change(function() {
        $(this).removeClass('is-invalid');
        $(this).next().empty();
    });

    $("#handleAdd").on("click", function() {
        method = "add";
        $("#form")[0].reset();
        $("#siswaModal").modal('show');
        $("#siswaModalLabel").text("Tambah Siswa");

        $("input").removeClass('is-invalid');
        $("input").next().empty();
        $("select").removeClass('is-invalid');
        $("select").next().empty();
    });

    function edit(id) {
        method = "update";
        $("#form")[0].reset();
        $("#siswaModal").modal('show');
        $("#siswaModalLabel").text("Ubah Siswa");

        $("input").removeClass('is-invalid');
        $("input").next().empty();
        $("select").removeClass('is-invalid');
        $("select").next().empty();

        $.ajax({
            url: '<?= site_url('siswa/edit/'); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(res) {
                $("input[name='id']").val(res.id);
                $("input[name='sw_nama']").val(res.sw_nama);
                $("input[name='sw_nisn']").val(res.sw_nisn);
                $("input[name='sw_nis']").val(res.sw_nis);
                $("input[name='sw_email']").val(res.sw_email);
                $("input[name='sw_notelp']").val(res.sw_notelp);
                $("select[name='sw_gender']").val(res.sw_gender);
                $("input[name='sw_tmpt_lahir']").val(res.sw_tmpt_lahir);
                $("input[name='sw_tgl_lahir']").val(res.sw_tgl_lahir);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function hapus(id) {
        if (confirm("Anda yakin ingin menghapus data?")) {
            $.ajax({
                url: '<?= site_url('siswa/delete/'); ?>' + id,
                type: 'POST',
                dataType: 'JSON',
                success: function(res) {
                    //if success reload ajax table
                    $("#siswaModal").modal('hide');
                    siswaTable.ajax.reload(null, false);

                    toastr.options = {
                        "preventDuplicates": true
                    }
                    toastr.danger(res.msg);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error delete data from ajax');
                }
            });
        }
    }


    $("#handleSubmit").on("click", function() {
        $("#handleSubmit").attr('disabled', true);

        // Condition Action URL Form
        var url;
        (method == "add" ? url = '<?= $this->config->item('routes')['siswa-create']; ?>' : url = '<?= $this->config->item('routes')['siswa-update']; ?>');

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: $('#form').serialize(),
            success: function(res) {
                if (res.code == 200) {
                    $("#handleSubmit").attr('disabled', false);
                    $("#siswaModal").modal('hide');
                    toastr.options = {
                        "preventDuplicates": true
                    }
                    toastr.success(res.msg);
                    siswaTable.ajax.reload(null, false);
                } else {
                    let response = res.err;
                    for (let error in response) {
                        let errors = response[error];
                        $("input[name='" + error + "']").addClass('is-invalid');
                        $("select[name='" + error + "']").addClass('is-invalid');
                        $("input[name='" + error + "']").next().text(errors);
                        $("select[name='" + error + "']").next().text(errors);
                    }
                }

                $("#handleSubmit").attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('error');
                $("#handleSubmit").attr('disabled', false);
            }
        });
    });
</script>