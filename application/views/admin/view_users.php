<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="<?php echo site_url();?>assets/all.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Usuarios</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Tipo de Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user['id_usuarios']; ?></td>
                    <td><?php echo $user['usuario']; ?></td>
                    <td><?php echo $user['nombres']; ?></td>
                    <td><?php echo $user['apellidos']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['tipo_usuario'] == 1 ? 'Administrador' : 'Usuario'; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-primary">Volver al Dashboard</a>
    </div>
</body>
</html>
