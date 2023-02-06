<h1><?= $session->username; ?></h1>
<a href="<?= $this->config->item('routes')['logout']; ?>" onclick="return confirm('Anda yakin ingin logout?');">Logout</a>