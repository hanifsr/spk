<?php
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$dbname = "spk";

	$koneksi = mysqli_connect($hostname, $username, $password, $dbname) or die(mysqli_error());

	function get_kriteria() {
		global $koneksi;
		$sql = "SELECT * FROM kriteria";
		$query = mysqli_query($koneksi, $sql);

		if(mysqli_num_rows($query) == 0) {
			echo "Belum ada kriteria";
		} else {
?>
			<table class="table table-striped">
				<tr>
					<th>No</th>
					<th>Nama Kriteria</th>
					<th>Bobot Kriteria</th>
					<th>Jenis</th>
					<th>Aksi</th>
				</tr>
<?php
			$no = 1;
			while($row = mysqli_fetch_assoc($query)) {
?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['nama']; ?></td>
					<td><?php echo $row['bobot']; ?></td>
					<td><?php echo $row['jenis']; ?></td>
					<td>
						<a class="btn btn-warning btn-xs" data-toggle="modal" data-placement="right" data-target="#modal_ubah_kriteria_<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i> Ubah</a>
						<a class="btn btn-danger btn-xs" data-toggle="modal" data-placement="right" data-target="#modal_hapus_kriteria_<?php echo $row['id']; ?>"><i class="fa fa-trash-o"></i> Hapus</a>
						<a href="subkriteria.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-tags"></i> Subkriteria</a>

						<div id="modal_ubah_kriteria_<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button class="close" data-dismiss="modal"><span aria-hidden="true">x</span></button>
										<h4 class="modal-title">Ubah Data Kriteria</h4>
									</div>
									<form method="post" action="ubah_kriteria.php" data-parsley-validate class="form-horizontal form-label-left">
										<div class="modal-body">
											<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kriteria <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="nama" class="form-control col-md-7 col-xs-12" value="<?php echo $row['nama']; ?>" required />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Bobot Kriteria <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="bobot" class="form-control col-md-7 col-xs-12" value="<?php echo $row['bobot']; ?>" required />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kriteria <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<select name="jenis" class="form-control col-md-7 col-xs-12">
														<option value="Biaya" <?php if($row['jenis'] == "Biaya") { echo 'selected="selected"'; } ?>>Biaya</option>
														<option value="Keuntungan" <?php if($row['jenis'] == "Keuntungan") { echo 'selected="selected"'; } ?>>Keuntungan</option>
													</select>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>

						<div id="modal_hapus_kriteria_<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button class="close" data-dismiss="modal"><span aria-hidden="true">x</span></button>
										<h4 class="modal-title">Apakah anda yakin akan menghapus kriteria berikut:</h4>
									</div>
									<form method="post" action="hapus_kriteria.php" data-parsley-validate class="form-horizontal form-label-left">
										<div class="modal-body">
											<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kriteria</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="nama" class="form-control col-md-7 col-xs-12" value="<?php echo $row['nama']; ?>" readonly />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Bobot Kriteria</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="bobot" class="form-control col-md-7 col-xs-12" value="<?php echo $row['bobot']; ?>" readonly />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kriteria <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" name="jenis" class="form-control col-md-7 col-xs-12" value="<?php echo $row['jenis']; ?>" readonly />
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-primary" name="hapus">Hapus</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</td>
				</tr>
<?php
				$no++;
			}
?>
			</table>
<?php
		}
	}
?>