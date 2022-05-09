<?php
  ####### Autoloader ########
  /// Autoloader automaticky načítá soubory s definicemi tříd, když je přída volána
  /// např. $a = new A() -> Budeme hledat A.php
  function autoladClass($className) {
    // Zjsití, zda jde o kontroler nebo model
    if (preg_match("/Controller/", $className))
      //kontroler
      require("controller/$className.php");
    else
      //model
      require("model/$className.php");
  }
  //registrace autoloaderu
  spl_autoload_register("autoladClass");

 ?>
