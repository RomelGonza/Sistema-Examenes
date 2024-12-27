<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Consulta RUC - ExamTrack</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/style1.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/form.css'); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo site_url();?>assets/toast/toast.min.css">
    <script src="<?php echo site_url();?>assets/toast/jqm.js"></script>
    <script src="<?php echo site_url();?>assets/toast/toast.js"></script>
    <style>
        .table-custom {
            width: 100%;
            margin-top: 1rem;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .table-custom th,
        .table-custom td {
            padding: 0.75rem;
            text-align: left;
            border: 1px solid #e2e8f0;
        }

        .table-custom th {
            background-color: #f8f9fa;
            color: #1e293b;
            font-weight: 600;
        }

        .input-custom {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            color: #1e293b;
        }

        .input-custom:focus {
            outline: none;
            border-color: #00abf0;
            box-shadow: 0 0 0 3px rgba(0, 171, 240, 0.1);
        }

        .btn-custom {
            padding: 0.75rem 1.5rem;
            background: #00abf0;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: #0096d1;
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .container-custom h1 {
            color: #1e293b;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .text-muted {
            color: #6c757d;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="<?= site_url('user') ?>" class="logo">ExamTrack</a>
        <nav class="navbar">
            <a href="<?= base_url('user/dashboard'); ?>">Inicio</a>
            <a href="<?= base_url('about'); ?>">Acerca de</a>
            <a href="<?= base_url('chat'); ?>">Chat</a>
            <a href="<?= site_url('resultado') ?>">Consultas</a>
            <a href="<?= site_url('request') ?>">Apis</a>
        </nav>
    </header>

    <section class="home">
        <div class="container">
            <h2>Consulta RUC</h2>
            
            <?php echo form_open('ruc/consultar'); ?>
                <div class="form-group">
                    <label class="mb-2" for="ruc">Número de RUC</label>
                    <input id="ruc" type="text" class="input-custom" name="ruc" 
                           pattern="[0-9]{11}" maxlength="11" 
                           title="Ingrese un RUC válido de 11 dígitos"
                           required autofocus>
                </div>
                <div style="text-align: center; margin-top: 1.5rem;">
                    <button type="submit" class="btn-custom">
                        Consultar
                    </button>
                </div>
            <?php echo form_close(); ?>

            <div id="resultado" style="margin-top: 2rem;">
                <?php if($this->session->userdata('datos_ruc')): ?>
                    <?php $datos = $this->session->userdata('datos_ruc'); ?>
                    <div class="table-responsive">
                        <table class="table-custom">
                            <tbody>
                                <tr>
                                    <th style="width: 40%">RUC</th>
                                    <td><?php echo isset($datos->ruc) ? $datos->ruc : ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Razón Social</th>
                                    <td><?php echo isset($datos->razonSocial) ? $datos->razonSocial : ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Dirección</th>
                                    <td><?php echo isset($datos->direccion) ? $datos->direccion : ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Departamento</th>
                                    <td><?php echo isset($datos->departamento) ? $datos->departamento : ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td><?php echo isset($datos->estado) ? $datos->estado : ''; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="text-align: center; margin-top: 1.5rem;">
                            <button type="button" class="btn-custom btn-secondary" onclick="window.print()">
                                Imprimir
                            </button>
                            <button type="button" class="btn-custom" onclick="window.location.reload()" style="margin-left: 0.5rem;">
                                Nueva Consulta
                            </button>
                        </div>
                    </div>
                    <?php $this->session->unset_userdata('datos_ruc'); ?>
                <?php endif; ?>
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
