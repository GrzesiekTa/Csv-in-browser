<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

<div class="container">
	<h3>Attach a csv file to display its contents</h3>
	<form action="index.php" method="post" enctype="multipart/form-data">
		<label for="csvfile">Csv file</label>
		<input type="file" name="csvfile" accept=".csv" required>
		<input type="submit" value="Display" name="submit" class="btn btn-block btn-success">
	</form>
</div>

<?php

if ($_FILES) {

	$csvFile = file($_FILES["csvfile"]["tmp_name"]);

	$keys = str_getcsv(array_shift($csvFile), '|');

	foreach ($csvFile as $key => $csvRecord) {
		$csv[] = array_combine($keys, str_getcsv($csvRecord, '|'));
	}
}

?>

<?php if ($_FILES): ?>
<div class="container">
	<h3>Data from csv file</h3>
	<table class="table table-dark">
		<thead>
			<tr>
				<?php foreach ($keys as $keyValue): ?>
				<th scope="col"><?php echo $keyValue; ?></th>
				<?php endforeach?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($csv as $csvData): ?>
			<tr>
				<?php foreach ($keys as $keyValue): ?>
				<td><?php echo $csvData[$keyValue] ?></td>
				<?php endforeach?>
			</tr>
			<?php endforeach?>
		</tbody>
	</table>
</div>
<?php endif?>

</body>
</html>