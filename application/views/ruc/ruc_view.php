<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Romel and Alessandro">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Consulta de ruc usando API">
    <title>Consulta ruc</title>
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
                            <h1 class="fs-4 card-title fw-bold mb-4">Consulta ruc</h1>
                            <?php echo form_open('ruc/consultar'); ?>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="ruc">numero de ruc</label>
                                    <input id="ruc" type="text" class="form-control" name="ruc" 
                                           pattern="[0-9]{11}" maxlength="11" 
                                           title="Ingrese un ruc valido de 11 digitos"
                                           required autofocus>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary ms-auto">
                                        Consultar
                                    </button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                        <div id="resultado" class="card-footer py-3 border-0">
                            <div class="text-center">
                                Los datos se mostraran aqui­
                            </div>
                        </div>
                    </div>

                    <div id="resultado" class="card-footer py-3 border-0">
                        <div class="text-center">
                            <?php if($this->session->userdata('datos_ruc')): ?>
                                <?php $datos = $this->session->userdata('datos_ruc'); ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-3">
                                        <tbody>
                                            <tr>
                                                <th class="bg-light" style="width: 40%">ruc</th>
                                                <td><?php echo isset($datos->ruc) ? $datos->ruc : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">Razon social</th>
                                                <td><?php echo isset($datos->razonSocial) ? $datos->razonSocial : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">Direccion</th>
                                                <td><?php echo isset($datos->direccion) ? $datos->direccion : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">departamento</th>
                                                <td><?php echo isset($datos->departamento) ? $datos->departamento : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">Estado</th>
                                                <td><?php echo isset($datos->estado) ? $datos->estado : ''; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="window.print()">
                                            Imprimir
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="window.location.reload()">
                                            Nueva Consulta
                                        </button>
                                    </div>
                                </div>
                                <?php $this->session->unset_userdata('datos_ruc'); ?>
                            <?php else: ?>
                                <div class="text-muted">
                                    Ingrese un numero de ruc para consultar los datos
                                </div>
                            <?php endif; ?>
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
        <?php
            $this->session->unset_userdata('suc');
            $this->session->unset_userdata('worng');
        ?>
    </script>
</body>
</html>