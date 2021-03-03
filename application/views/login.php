<!-- <h1>servicess page</h1> -->
<?php// $i=12;?>
<!-- <a href="<?php// echo site_url('s/'.$i) ;?>">ssssssss</a> -->
<?php
// var_dump($ii);
// if (isset($ii) && !empty($ii)) {
//     print_r($ii);
//     // var_dump($id);
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>
</head>
<body>
<?php

if ($this->session->flashdata('errors')){
    // print_r($this->session->flashdata('errors'));
    echo '<div class="alert alert-danger">';
    echo $this->session->flashdata('errors');
    echo "</div>";
}
?>
    <form action="<?php echo base_url('index.php/login_post'); ?>" method="post" >
        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        <input type="email" name="email" id="email" placeholder= "email" value="<?php echo set_value('eamil'); ?>">
        <span><?php echo form_error("email");?></span>
        <br><br>
        <input type="text" name="pass" id="pass" placeholder="pass" value="<?php echo set_value('pass'); ?>">
        <span><?php echo form_error("pass");?></span>
        <br><br>
        <input type="submit" value="submit">

    </form>
</body>
</html>