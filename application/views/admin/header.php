<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Admin - ExamTrack'; ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/style1.css'); ?>">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <a href="#" class="logo">ExamTrack</a>
        <nav class="navbar">
            <a href="<?= site_url('admin/dashboard') ?>">Dashboard</a>
            <a href="<?= site_url('admin/resultados') ?>">Resultados</a>
            <a href="<?= site_url('admin/view_users') ?>">Usuarios</a>
        </nav>
    </header>
    <div class="container mt-4">
