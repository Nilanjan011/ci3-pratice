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
    <script src="<?= base_url() ?>js/jquery.js"></script>
</head>
<body>
<?php

if ($this->session->flashdata('errors')){
    // print_r($this->session->flashdata('errors'));
    echo '<div class="alert alert-danger">';
    echo $this->session->flashdata('errors');
    $this->session->unset_userdata('errors');// not testing
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
    <div>
        <button id="bt1">Button 1</button> <button id="bt2">Button 2</button>
        <div id="app">

        </div> 
    </div>



    <input type="text" name="data" id="data">
    <button onclick="go()">Send</button>
    <h1 id="h1"></h1>
    <script>
       $("#bt1").click(function(){
         $.ajax({url: "http://localhost/ci/index.php/n", success: function(result){
           $("#app").html(result);
         }});
        });
        $("#bt2").click(function(){
         $.ajax({url: "http://localhost/ci/index.php/n2", success: function(result){
           $("#app").html(result);
         }});
        });

        function go() {
            fetch("http://localhost/ci/index.php/n")
            .then((data) =>{
              return data.json();
            }).then((res) =>{
                console.log(res);
            })
        }

    </script>

</body>
</html>