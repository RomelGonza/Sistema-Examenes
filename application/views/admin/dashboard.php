<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Romel and Alessandro">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Desarrollo e implementación de Login con middleware">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo site_url();?>assets/all.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/toast/toast.min.css">
    <script src="<?php echo site_url();?>assets/toast/jqm.js"></script>
    <script src="<?php echo site_url();?>assets/toast/toast.js"></script>
</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="<?php echo site_url();?>assets/logo.jpg" alt="logo" width="100">
                    </div>

                    <div class="card text-white bg-danger">
                      <div class="card-body">
                        <h4 class="card-title">Panel de Administrador</h4>
                        <p class="card-text">Bienvenido Administrador</p>
                        <div class="mt-3">
                            <h5>Acciones Disponibles:</h5>
                            <ul class="list-unstyled">
                                <li>✓ Gestión de Usuarios</li>
                                <li>✓ Configuración del Sistema</li>
                                <li>✓ Reportes Administrativos</li>
                                <li>✓ Control Total del Sistema</li>
                            </ul>
                        </div>
                        
                        <div class="mt-4">
                            <h5>Agregar Usuario:</h5>
                            <form action="<?php echo site_url('admin/add_user'); ?>" method="post">
                                <div class="mb-3">
                                    <label for="usuario">Usuario:</label>
                                    <input id="usuario" type="text" class="form-control" name="usuario" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Contraseña:</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nombres">Nombres:</label>
                                    <input id="nombres" type="text" class="form-control" name="nombres" required>
                                </div>
                                <div class="mb-3">
                                    <label for="apellidos">Apellidos:</label>
                                    <input id="apellidos" type="text" class="form-control" name="apellidos" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Correo Electrónico:</label>
                                    <input id="email" type="email" class="form-control" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo_usuario">Tipo de Usuario:</label>
                                    <select id="tipo_usuario" class="form-control" name="tipo_usuario" required>
                                        <option value="0">Usuario</option>
                                        <option value="1">Administrador</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                            </form>
                        </div>

                        <div class="mt-4">
                            <h5>Ver Todos los Usuarios:</h5>
                            <a href="<?php echo site_url('admin/view_users'); ?>" class="btn btn-primary">Ver Usuarios</a>
                        </div>

                      </div>
                    </div>

                    <div class="text-center mt-5 text-muted">
                        Copyright &copy; 2024-2030 &mdash; BADBOYS FINESI
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        <?php if($this->session->flashdata('suc')){ ?>
            toastr.success("<?php echo $this->session->flashdata('suc'); ?>");
        <?php }else if($this->session->flashdata('worng')){  ?>
            toastr.error("<?php echo $this->session->flashdata('worng'); ?>");
        <?php }else if($this->session->flashdata('warning')){  ?>
            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
        <?php }else if($this->session->flashdata('info')){  ?>
            toastr.info("<?php echo $this->session->flashdata('info'); ?>");
        <?php } ?>
        <?php $this->session->unset_userdata('suc'); ?>
        <?php $this->session->unset_userdata('worng'); ?>
    </script>
</body>
</html>
