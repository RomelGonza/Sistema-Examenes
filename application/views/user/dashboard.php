<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ExamTrack - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/style1.css'); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <a href="#" class="logo">ExamTrack</a>

        <nav class="navbar">
            <a href="<?= base_url('user/dashboard'); ?>" class="active">Inicio</a>
            <a href="<?= base_url('about'); ?>">Acerca de</a>
            <a href="<?= base_url('chat'); ?>">Chat</a>
            <a href="<?= site_url('resultado') ?>">Consultas</a>
            <a href="<?= site_url('request') ?>">Apis</a>
        </nav>
    </header>
    <section class="dashboard">
        <div class="dashboard-content">
            <h1>¡Bienvenido a ExamTrack!</h1>
            <h3>Universidad Nacional del Altiplano</h3>
            <p>Consulta y gestiona tus resultados de exámenes de manera sencilla y rápida. Accede a tus resultados, participa en el chat con administradores y obtén soporte en tiempo real.</p>
            <div class="btn-box">
                <a href="<?= site_url('resultado') ?>">Resultados</a>
                <a href="<?= base_url('chat'); ?>">Soporte</a>
            </div>
        </div>
        <div class="dashboard-sci">
            <a href="#"><i class="bx bxl-facebook"></i></a>
            <a href="#"><i class="bx bxl-twitter"></i></a>
            <a href="#"><i class="bx bxl-linkedin"></i></a>
        </div>
    </section>
</body>
</html>
