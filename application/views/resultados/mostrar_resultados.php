<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Resultados de Admisión - ExamTrack</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/style1.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/rest.css'); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CSS -->

</head>
<body>
    <header class="header">
        <a href="#" class="logo">ExamTrack</a>
        <nav class="navbar">
            <a href="<?= base_url('user/dashboard'); ?>" class="active">Inicio</a>
            <a href="<?= base_url('about'); ?>">Acerca de</a>
            <a href="<?= base_url('chat'); ?>">Chat</a>
            <a href="<?= site_url('resultado'); ?>">Consultas</a>
            <a href="<?= site_url('request'); ?>">Apis</a>
        </nav>
    </header>

    <section class="home">
        <div class="container">
            <h2>Resultados de Admisión</h2>
            <?php if (!empty($resultados)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>DNI</th>
                            <th>Apellidos y Nombres</th>
                            <th>Puntaje</th>
                            <th>Carrera</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $resultado): ?>
                            <tr>
                                <td><?= $resultado->puesto; ?></td> 
                                <td><?= $resultado->dni; ?></td> 
                                <td><?= $resultado->apellidos_nombres; ?></td> 
                                <td><?= $resultado->puntaje; ?></td> 
                                <td><?= $resultado->carrera; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No se encontraron resultados para el DNI proporcionado.</p>
            <?php endif; ?>
            <a href="<?= site_url('resultado') ?>">Volver a Consultar</a>
        </div>
    </section>
</body>
</html>
