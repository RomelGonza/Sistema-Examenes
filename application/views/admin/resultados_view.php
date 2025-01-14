<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Resultados de Admisión - ExamTrack</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/admin.css'); ?>">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <a href="#" class="logo">ExamTrack</a>

        <nav class="navbar">
            <a href="<?= base_url('user/dashboard'); ?>" class="active">Inicio</a>
            <a href="<?= base_url('about'); ?>">Acerca de</a>
            <a href="<?= base_url('chat'); ?>">Chat</a>
            <a href="<?= base_url('resultado'); ?>">Consultas</a>
            <a href="<?= site_url('request')?>">Apis</a> 
        </nav>
    </header>

    <section class="content-wrapper">
        <section class="content-header">
            <h1>
                Resultados de Admisión
                <small>Gestión de resultados</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Lista de Resultados</h3>
                            <div class="box-tools">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalImportar">
                                    <i class="fa fa-upload"></i> Importar Resultados
                                </button>
                            </div>
                        </div>
                        
                        <div class="box-body">
                            <?php if($this->session->flashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <select class="form-control" id="filtroAno">
                                        <option value="">Todos los años</option>
                                        <!-- Añadir opciones de año dinámicamente -->
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="filtroSemestre">
                                        <option value="">Todos los semestres</option>
                                        <option value="1">Primer Semestre</option>
                                        <option value="2">Segundo Semestre</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="filtroCarrera">
                                        <option value="">Todas las carreras</option>
                                        <?php foreach($carreras as $c): ?>
                                            <option value="<?php echo $c->carrera; ?>"><?php echo $c->carrera; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="busqueda" placeholder="Buscar por nombre o DNI">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Puesto</th>
                                            <th>DNI</th>
                                            <th>Apellidos y Nombres</th>
                                            <th>Puntaje</th>
                                            <th>Carrera</th>
                                            <th>Año</th>
                                            <th>Semestre</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaResultados">
                                        <?php foreach($resultados as $r): ?>
                                            <tr>
                                                <td><?php echo $r->puesto; ?></td>
                                                <td><?php echo $r->dni; ?></td>
                                                <td><?php echo $r->apellidos_nombres; ?></td>
                                                <td><?php echo $r->puntaje; ?></td>
                                                <td><?php echo $r->carrera; ?></td>
                                                <td><?php echo $r->anio; ?></td>
                                                <td><?php echo $r->semestre; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- Modal Importar -->
    <div class="modal fade" id="modalImportar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Importar Resultados</h4>
                </div>
                <form action="<?php echo site_url('admin/importar_resultados'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Archivo de Resultados (.txt)</label>
                            <input type="file" class="form-control" name="archivo" accept=".txt" required>
                        </div>
                        <div class="form-group">
                            <label>Año</label>
                            <input type="number" class="form-control" name="anio" required>
                        </div>
                        <div class="form-group">
                            <label>Semestre</label>
                            <select class="form-control" name="semestre" required>
                                <option value="1">Primer Semestre</option>
                                <option value="2">Segundo Semestre</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Importar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        function filtrarResultados() {
            $.get('<?php echo site_url("admin/buscar_resultados"); ?>', {
                q: $('#busqueda').val(),
                carrera: $('#filtroCarrera').val(),
                anio: $('#filtroAno').val(),
                semestre: $('#filtroSemestre').val()
            }, function(data) {
                $('#tablaResultados').empty();
                data.forEach(function(r) {
                    $('#tablaResultados').append(`
                        <tr>
                            <td>${r.puesto}</td>
                            <td>${r.dni}</td>
                            <td>${r.apellidos_nombres}</td>
                            <td>${r.puntaje}</td>
                            <td>${r.carrera}</td>
                            <td>${r.anio}</td>
                            <td>${r.semestre}</td>
                        </tr>
                    `);
                });
            });
        }

        $('#filtroCarrera, #busqueda, #filtroAno, #filtroSemestre').on('change keyup', function() {
            filtrarResultados();
        });
    });
    </script>
</body>
</html>
