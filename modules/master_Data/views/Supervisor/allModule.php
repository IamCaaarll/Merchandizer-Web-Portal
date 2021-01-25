<?php foreach ($moduleData as $row): ?>
    <option value="<?php echo $row->id; ?>"><?php echo $row->module; ?></option>
<?php endforeach; ?>