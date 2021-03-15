<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
<?php 
    $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );


?>
<form action="<?php echo base_url('index.php/update/'.$item->id); ?>" method="post">
<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" >
    <input type="email" name="email" id="email" placeholder="email" value="<?php echo $item->name; ?>">
    <span><?php echo form_error("email");?></span>
    <br><br>
    <input type="text" name="pass" id="pass" placeholder="pass" value="<?php echo $item->pass; ?>">
    <span><?php echo form_error("pass");?></span>
    <br><br>
    <input type="submit" value="submit">

</form>
</body>
</html>