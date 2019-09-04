<style>
td {
    border: 1px solid #000;
}
</style>

<?php

require_once('simple_html_dom.php');

$link = array(
    'Арматура','https://www.1metallobaza.ru/catalog/armatura',
    'Балка','https://www.1metallobaza.ru/catalog/balka',
    'Катанка','https://www.1metallobaza.ru/catalog/katanka'
);
$title = array(
  'Сортамент','Длинна','Марка стали','Цена за рез',
  'Диаметр','Цена за тонну (от 1т)','Цена за тонну (от 0.5т)',
  'Цена за тонну (до 0.5т)','Цена за п/м (до 0.5т)',
  'Цена за штуку (до 0.5т)','Цена за п/м (от 0.5т)'
);
$csv = array();

$html = new simple_html_dom();

for($i = 0; $i<count($link); $i+=2) {
  $html->load_file($link[$i+1]);
  echo "<table><tbody><tr><td>".$link[$i]."</td></tr></table></tbody>";
  foreach($html->find('table.price_default') as $table) {
  echo "<table><tbody>";
  echo "<tr><td>".implode('</td><td>',$title)."</td></tr>";
    foreach($table->find('tr') as $tr) {
    echo "<tr>";
      foreach($tr->find('td.views-field-variation-custom-title a') as $td) {
          if($td->innertext) {echo "<td>".$td->innertext."</td>";
          // $csv = $td->innertext;
        } else {
          echo "<td>0</td>";
          // $csv .= "0";
        }
      }
      foreach($tr->find('td.views-field-attribute-dlina-m') as $td) {
          if($td->innertext) {echo "<td>".$td->innertext."</td>";} else {echo "<td>0</td>";}
      }
      foreach($tr->find('td.views-field-field-product-gost') as $td) {
          if($td->innertext) {echo "<td>".$td->innertext."</td>";} else {echo "<td>0</td>";}
      }
      foreach($tr->find('td.views-field-variation-cut-price') as $td) {
          if($td->innertext) {echo "<td>".$td->innertext."</td>";} else {echo "<td>0</td>";}
      }
      foreach($tr->find('td.views-field-field-product-diameter') as $td) {
          if($td->innertext) {echo "<td>".$td->innertext."</td>";} else {echo "<td>0</td>";}
      }
      foreach($tr->find('td.views-field-variation-ton-price .column_price_default') as $td) {
          if($td->innertext) {echo "<td>".$td->innertext."</td>";} else {echo "<td>0</td>";}
      }
      foreach($tr->find('td.views-field-variation-ton-price .column_price1') as $td) {
          if($td->innertext) {echo "<td>".$td->innertext."</td>";} else {echo "<td>0</td>";}
      }
      foreach($tr->find('td.views-field-variation-ton-price .column_price2') as $td) {
          if($td->innertext) {echo "<td>".$td->innertext."</td>";} else {echo "<td>0</td>";}
      }
      foreach($tr->find('td.views-field-variation-meter-price') as $td) {
          if($td->innertext) {echo "<td>".$td->innertext."</td>";} else {echo "<td>0</td>";}
      }
      foreach($tr->find('td.views-field-variation-meter-item-price .column_price_item') as $td) {
          if($td->innertext) {echo "<td>".$td->innertext."</td>";} else {echo "<td>0</td>";}
      }
      foreach($tr->find('td.views-field-variation-meter-item-price .column_price_meter') as $td) {
          if($td->innertext) {echo "<td>".$td->innertext."</td>";} else {echo "<td>0</td>";}
      }
    echo "</tr>";
  }
  echo "</table></tbody>";
  }
  // $fp = fopen('file.csv', 'w');
  // fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
  // foreach ($csv as $fields) {
  //     fputcsv($fp, $fields,',');
  // }
  // fclose($fp);
}


?>
