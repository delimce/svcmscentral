class prueba {
          var $text;
          function __construct($number) {
                       echo "Empezo la clase: ".$number."";
         }
         function cambiarWord($nuevotexto) {
                      echo "El texto ".$this->text." ha sido remplazado por: ";
                      $this->text = $nuevotexto;
                      echo $this->text;
                      echo "<br/>";
         }
}