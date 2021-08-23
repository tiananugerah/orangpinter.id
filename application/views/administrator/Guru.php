<section class="content">
<div class="box">
  <div class="box-header">
    <a href="" class="btn btn-sm btn-primary"><i class="fa fa-plus"> Tambah Data Guru</i></a>
  </div>
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>nip</th>
          <th>nama depan</th>
          <th>nama belakang</th>
          <th>aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td colspan="3">
            <?php echo anchor('', '<div class="btn btn-sm btn-success"><i class="fa fa-eye"></i></div>') ?>
            <?php echo anchor('', '<div class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></div>') ?>
            <?php echo anchor('', '<div class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></div>') ?>
          </td>
        </tr>
      </tbody>
    </table>
</div>
</section>