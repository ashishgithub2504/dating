<?php use Cake\Core\Configure; 
$this->layout = false;
?>
<!DOCTYPE html>
<html>
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bgimg {
  background-image: url('img/manufacture.jpg');
  height: 100%;
  background-position: center;
  background-size: cover;
  position: relative;
  color: white;
  font-family: "Courier New", Courier, monospace;
  font-size: 25px;
}a

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
}

.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

hr {
  margin: auto;
  width: 40%;
}
</style>
<body>

<div class="bgimg">
  <div class="topleft">
    <p><?php
                echo $this->Html->image(Configure::read("Setting.MAIN_LOGO"), ["class" => "logo-default", "alt" => Configure::read("Setting.TITLE"), "height" => 245]);

                ?></p>
  </div>
  <div class="middle">
    <h1 style="font-weight: bold;
    font-family: sans-serif;
    color: lightcoral;
    text-shadow: 2px 2px;
    font-size: 55px;">Ajay & Co. <br/> COMING SOON</h1>
    <hr>
    <p>Few days left</p>
  </div>
</div>

</body>
</html>
