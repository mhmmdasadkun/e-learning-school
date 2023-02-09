<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning - Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/master.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="bg-light">
    <div class="card-container w-50">
        <div class="card border-0 shadow-sm">
            <h5 class="card-header fw-bold">E-Learning Login</h5>
            <div class="card-body">
                <form autocomplete="off">
                    <div class="mb-3">
                        <label for="ad_email" class="form-label">Email</label>
                        <input type="email" name="ad_email" class="form-control" id="ad_email" placeholder="Masukan email" value="<?= set_value('ad_email'); ?>">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="ad_password" class="form-label">Password</label>
                        <input type="password" name="ad_password" class="form-control" id="ad_password" placeholder="Masukan password">
                        <div class="invalid-feedback"></div>
                    </div>
                    <button class="w-100 btn btn-primary" type="submit" id="handleSubmit">Masuk</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $("input").change(function() {
            $(this).removeClass('is-invalid');
            $(this).next().empty();
        });

        $("#handleSubmit").click(function(e) {
            e.preventDefault();

            let ad_email = $("input[name='ad_email']").val();
            let ad_password = $("input[name='ad_password']").val();

            $.ajax({
                url: '<?= $this->config->item('routes')['authenticate']; ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    ad_email: ad_email,
                    ad_password: ad_password
                },
                success: function(res) {
                    if ($.isEmptyObject(res.err)) {
                        if (res.code == 200) {
                            window.location.href = "<?= $this->config->item('routes')['dashboard'] ?>";
                            return false;
                        }
                        toastr.options = {
                            "preventDuplicates": true
                        }
                        toastr.error(res.msg);
                    } else {
                        let response = res.err;
                        for (let error in response) {
                            let errors = response[error];
                            $("input[name='" + error + "']").addClass('is-invalid');
                            $("input[name='" + error + "']").next().text(errors);
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });
        });
    </script>
</body>

</html>