<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>APIs Disponibles - ExamTrack</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/style1.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/form.css'); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <a href="<?= site_url('user') ?>" class="logo">ExamTrack</a>

        <nav class="navbar">
            <a href="<?= base_url('user/dashboard'); ?>" class="active">Inicio</a>
            <a href="<?= base_url('about'); ?>">Acerca de</a>
            <a href="<?= base_url('chat'); ?>">Chat</a>
            <a href="<?= site_url('resultado') ?>">Consultas</a>
            <a href="<?= site_url('request') ?>">Apis</a>
        </nav>
    </header>
    <section class="home">
        <div class="container">
            <h2>APIs Disponibles</h2>
            <div class="api-buttons">
                <button type="submit" onclick="location.href='<?= base_url('consulta'); ?>'" style="margin-right: 10px;">Consultar DNI</button>
                <button type="submit" onclick="location.href='<?= base_url('ruc_consulta'); ?>'">Consultar RUC</button>
            </div>
        </div>
    </section>
</body>
</html>
