<?php
  /// inicializační script
  require_once("init.php");

  /**
   * Průběh života requestu
   * 1) Na Server příjde reqest
   * 2) Vytvoří se instance RouterControlleru, který podle adresy, na jakou byl request zaslán
   *    vybere příslušný kontroler, kterému předá řízení
   *    ---> matejelias.cz/{controller}/{[parametry]}
   * 3) podle typu requestu se vstoupí do příslušné metody POST -> post(), GET -> get() atd.
   */

   /// Užitečné odkazy
   /// MVC - https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller
   /// TableDataGateway - https://www.martinfowler.com/eaaCatalog/tableDataGateway.html
   /// REST - https://restfulapi.net/
   /// StatusCodes - https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
   /// OOP - https://en.wikipedia.org/wiki/Object-oriented_programming
   /// Abstraktní třída - https://www.theserverside.com/definition/abstract-class
   /// Statické metody - https://www.techopedia.com/definition/24034/static-method-java

  /// Vytvoření routeru a zadané url předání url
  $router = new RouterController();
  $router->get(array($_SERVER["REQUEST_URI"]));
 ?>
