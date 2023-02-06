<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>
    <h1>Login</h1>
    <form method="post" action="<?= $this->config->item('routes')['authenticate']; ?>" autocomplete="off">
        <input type="email" name="ad_email" id="ad_email" placeholder="Masukan email" value="<?= set_value('email'); ?>">
        <?= form_error('ad_email', '<small>', '</small>'); ?>
        <input type="password" name="ad_password" id="ad_password" placeholder="Masukan password">
        <?= form_error('ad_password', '<small>', '</small>'); ?>
        <button type="submit">Login</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>