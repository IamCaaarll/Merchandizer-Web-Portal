<option></option>
<?php foreach ($dataManager as $row): ?>
    <option value="<?php echo $row->id; ?>" ><?php echo $row->last_name.', '. $row->first_name; ?></option>
<?php endforeach; ?>