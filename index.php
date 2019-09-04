<style>
td {
    border: 1px solid #000;
}
</style>

<?php

require_once('simple_html_dom.php');

$link = array(
    'Арматура','https://www.1metallobaza.ru/catalog/armatura',//0,1
    'Балка','https://www.1metallobaza.ru/catalog/balka',//3,4
    'Катанка','https://www.1metallobaza.ru/catalog/katanka'//3,4
);
$title = array(
  'Сортамент','Длинна','Марка стали','Цена за рез',
  'Диаметр','Цена за тонну (от 1т)','Цена за тонну (от 0.5т)',
  'Цена за тонну (до 0.5т)','Цена за п/м (до 0.5т)',
  'Цена за штуку (до 0.5т)','Цена за п/м (от 0.5т)'
);

$html = new simple_html_dom();

echo count($link)/2;

print_r($link);

for($i = 0; $i<count($link); $i+=2) {
  $html->load_file($link[$i+1]);
  echo "<table><tbody><tr><td>".$link[$i]."</td></tr></table></tbody>";
  foreach($html->find('table.price_default') as $table) {
  echo "<table><tbody>";
  echo "<tr><td>".implode('</td><td>',$title)."</td></tr>";
    foreach($table->find('tr') as $tr) {
    echo "<tr>";
      foreach($tr->find('td.views-field-variation-custom-title a') as $td) {
          echo "<td>".$td->innertext."</td>";
      }
      foreach($tr->find('td.views-field-attribute-dlina-m') as $td) {
          echo "<td>".$td->innertext."</td>";
      }
        foreach($tr->find('td.views-field-field-product-gost') as $td) {
            echo "<td>".$td->innertext."</td>";
        }
      if($tr->find('td.views-field-variation-cut-price') !== null) {
        foreach($tr->find('td.views-field-variation-cut-price') as $td) {
          if(isset($td->innertext)) {
            echo "<td>".$td->innertext."</td>";
          } else {echo $td->innertext = "0";}
        }
      }else {echo $td->innertext = "0";}
      foreach($tr->find('td.views-field-field-product-diameter') as $td) {
          echo "<td>".$td->innertext."</td>";
      }
      foreach($tr->find('td.views-field-variation-ton-price .column_price_default') as $td) {
          echo "<td>".$td->innertext."</td>";
      }
      foreach($tr->find('td.views-field-variation-ton-price .column_price1') as $td) {
          echo "<td>".$td->innertext."</td>";
      }
      foreach($tr->find('td.views-field-variation-ton-price .column_price2') as $td) {
          echo "<td>".$td->innertext."</td>";
      }
      foreach($tr->find('td.views-field-variation-meter-price') as $td) {
          echo "<td>".$td->innertext."</td>";
      }
      foreach($tr->find('td.views-field-variation-meter-item-price .column_price_item') as $td) {
          echo "<td>".$td->innertext."</td>";
      }
      foreach($tr->find('td.views-field-variation-meter-item-price .column_price_meter') as $td) {
          echo "<td>".$td->innertext."</td>";
      }
    echo "</tr>";
  }
  echo "</table></tbody>";
  }
}
// $fp = fopen('file.csv', 'w');
// fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
// foreach ($html as $fields) {
//     fputcsv($fp, $fields);
// }
// fclose($fp);

?>
