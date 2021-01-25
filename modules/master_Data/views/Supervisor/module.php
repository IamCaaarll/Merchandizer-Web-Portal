<?php foreach ($moduleData as $row): ?>
    <option value="<?php echo $row->id; ?>"  <?php if ($row->status == 1) {echo "Selected";} ?> ><?php echo $row->module; ?></option>
<?php endforeach; ?>