<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg">

                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <?= $this->session->flashdata('message'); ?>
                <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-toggle="modal" data-target="#newPegawaiModal"> Add Pegawai </a>
                <br>


                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">ِAkad ke</th>
                            <th scope="col">Status</th>
                            <th scope="col">ِAction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pegawai as $p) : ?>
                            <tr>

                                <th scope="row"><?= $i; ?></th>
                                <td><?= $p['nip']; ?></td>
                                <td><?= $p['nama']; ?></td>
                                <td><?= $p['jabatan']; ?></td>
                                <td><?= $p['divisi']; ?></td>
                                <td><?= $p['tgl_lahir']; ?></td>
                                <td><?= $p['akad_ke']; ?></td>
                                <td><?= $p['status']; ?></td>
                                <td>

                                    <a href="<?= base_url('admin/detail/') . $p['id']; ?>" class="badge badge-success"> detail </a>
                                    <a href="<?= base_url('admin/edit/') . $p['id']; ?>" class="badge badge-warning"> edit </a>
                                    <a href="<?= base_url('admin/delete/') . $p['id']; ?>" class="badge badge-danger"> delete </a>

                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newPegawaiModal" tabindex="-1" aria-labelledby="newPegawaiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPegawaiLabel">Add Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/pegawai'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id " class="form-control">
                            <option value=""> Jabatan </option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?> "><?= $m['menu']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id " class="form-control">
                            <option value=""> Divisi </option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?> "><?= $m['menu']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Lahir">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="akad" name="akad" placeholder="Akad ke">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id " class="form-control">
                            <option value=""> Status </option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?> "><?= $m['menu']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
        </form>
    </div>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->