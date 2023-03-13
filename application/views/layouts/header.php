<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning - <?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/datatable.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/select2.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>

    <div id="loading">
        <img id="loading-image" src="<?= base_url('assets/img/loader.gif'); ?>" alt="Loading..." />
    </div>

    <div class="layout-wrapper">
        <!-- Sidebar -->
        <div class="sidebar-wrapper">
            <div class="sidebar-brand-box">
                <div class="sidebar-brand">
                    <div class="brand-img">
                        <img src="<?= base_url('assets/img/brand.png') ?>" alt="Brand">
                    </div>
                    <div class="brand-title">
                        <span>E-Learning</span>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu-box">
                <div class="sidebar-menu">
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <div class="menu-header">Menu Utama</div>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $this->config->item('routes')['dashboard']; ?>" <?= $this->uri->segment(1) == "dashboard" || $this->uri->segment(1) == "" ? 'class="active"' : '' ?>>
                                <i class="bx bxs-rocket"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $this->config->item('routes')['siswa-list']; ?>">
                                <i class="bx bxs-user-account"></i>
                                <span>Daftar Siswa</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#">
                                <i class="bx bxs-user-account"></i>
                                <span>Daftar Guru</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="menu-header">Pengaturan</div>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="menu-collapse">
                                <i class="bx bxs-shield"></i>
                                <span>Accounts</span>
                            </a>
                            <div class="menu-dropdown">
                                <ul>
                                    <li class="nav-item">
                                        <a href="#">User</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#">Admin</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $this->config->item('routes')['logout']; ?>" onclick="return confirm('Anda yakin ingin keluar?');">
                                <i class="bx bx-log-out"></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <div class="navbar-wrapper">
            <div class="navbar-main">
                <div class="navbar-left">
                    <div class="navbar-animate">
                        <i class="bx bx-menu-alt-left"></i>
                    </div>
                </div>
                <div class="navbar-right">
                    <div class="navbar-notification">
                        <i class="bx bx-bell"></i>
                    </div>
                    <div class="navbar-profile">
                        <img src="<?= base_url('assets/img/profile.jpg') ?>" alt="Profile">
                        <div class="profile-info">
                            <span class="profile-title"><?= $session->username; ?></span>
                            <span class="profile-subtitle"><?= $session->email; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>