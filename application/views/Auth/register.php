
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Romel and Alessandro">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="Desarrollo e implementación de Login con middleware">
	<title>Register</title>
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
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
                            <?php echo form_open('Auth/registration_form'); ?>
                                
								<div class="mb-3">
									<label class="mb-2 text-muted" for="usuario">Usuario</label>
									<input id="usuario" name="usuario" type="text" class="form-control" required autofocus>
								</div>

                                <div class="mb-3">
									<label class="mb-2 text-muted" for="nombre">Nombre</label>
									<input id="nombre" name="nombre" type="text" class="form-control" required>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="apellido">Apellido</label>
									<input id="apellido" name="apellido" type="text" class="form-control" required>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail</label>
									<input id="email" name="email" type="email" class="form-control" required>
								</div>

								<div class="mb-3">
                                    <label class="mb-2 text-muted" for="password">Contraseña</label>
									<input id="password" name="password" type="password" class="form-control" required>
								</div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="con_password">Confirmar Contraseña</label>
									<input id="con_password" name="con_password" type="password" class="form-control" required>
								</div>

								<div class="d-flex align-items-center">
									<button type="submit" class="btn btn-primary">
										Registro
									</button>
								</div>
							<?php echo form_close(); ?>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Tienes una cuenta? <a href="<?php echo site_url();?>Auth" class="text-dark">Login</a>
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
        <?php if ($this->session->flashdata('suc')) { ?>
            toastr.success("<?php echo $this->session->flashdata('suc'); ?>");
        <?php } else if ($this->session->flashdata('worng')) { ?>
            toastr.error("<?php echo $this->session->flashdata('worng'); ?>");
        <?php } else if ($this->session->flashdata('warning')) { ?>
            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
        <?php } else if ($this->session->flashdata('info')) { ?>
            toastr.info("<?php echo $this->session->flashdata('info'); ?>");
        <?php } ?>
        <?php $this->session->unset_userdata('suc'); ?>
        <?php $this->session->unset_userdata('worng'); ?>
    </script>
</body>
</html>
