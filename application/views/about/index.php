<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/style1.css'); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <a href="<?= base_url() ?>" class="logo">ExamTrack</a>

        <nav class="navbar">
            <a href="<?= base_url('user/dashboard') ?>" <?= $this->uri->segment(1) == 'user/dashboard' ? 'class="active"' : '' ?>>Inicio</a>
            <a href="<?= base_url('about') ?>" <?= $this->uri->segment(1) == 'about' ? 'class="active"' : '' ?>>Acerca de</a>
            <a href="<?= base_url('chat') ?>" <?= $this->uri->segment(1) == 'chat' ? 'class="active"' : '' ?>>Chat</a>
            <a href="<?= base_url('consultas') ?>" <?= $this->uri->segment(1) == 'consultas' ? 'class="active"' : '' ?>>Consultas</a>
            <a href="<?= base_url('request') ?>" <?= $this->uri->segment(1) == 'request' ? 'class="active"' : '' ?>>Apis</a>
        </nav>
    </header>

    </body>
</html>

<section class="dashboard">
    <div class="dashboard-content">
        <h1>Acerca de ExamTrack</h1>
        <h3>Trabajo Estudiantil UNA-PUNO</h3>
        <div class="about-section">
            <p>Somos un equipo de estudiantes apasionados de la Escuela Profesional de Ingenieria de Estadistica e Informatica de la Universidad Nacional del Altiplano - Puno, comprometidos con la innovacion y el desarrollo tecnologico.</p>
                        
            <h3>Equipo de Desarrollo</h3>
            <div class="team-members">
                <p> Estudiantes de Ingenieria de Estadistica e Informatica</p>
                <p>- Alessandro</p>
		<p>- Romel</p>
            </div>
        </div>
    </div>
</section>