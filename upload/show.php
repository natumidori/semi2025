<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>show</title>
</head>
<body>
 
      
<?php



//use function PHPSTORM_META\type;

   echo '<div class="Mcontainer">';
   $filePath_csv='./file.csv';
   $file_csv = fopen($filePath_csv, "r");
   $csv_data = [];
   // CSVをすべて読み込み、配列に格納（キー: ファイル名, 値: サマリー）
   while ($line = fgets($file_csv)) {
        
        $parts = explode(",", trim($line));
        $csv_data[$parts[0]] = $parts[1];
        
        
    }
    
   $count = 0;
   $filePath='./uploaded';
   $file = glob("./uploaded/*.pdf");
   $files=count($file); 
   while($count < $files){
    echo '<div class="Scontainer">';
       $file_name = basename($file[$count]);
       
       
       if(isset($csv_data[$file_name])){
        $file_summary = $csv_data[$file_name];
        echo $file_summary.'<br>';
        echo '<a href = "./uploaded/'.$file_name.'"  download="'.$file_summary.'">ダウンロード</a>';
       
       }else{
        echo "説明なし".'<br>';
        echo '<a href = "./uploaded/'.$file_name.'"  download="未名称">ダウンロード</a>';
       
     }

      
     
       echo '<form action="delete.php"  method="post" >';
       echo '<input type="hidden" name="delete" value="'.$file_name.'">';
       echo '<button type="submit" onclick="return confirm(\''.$file_summary.'のファイルを本当に削除しますか？\')">削除</button>';
       echo'</form>';
       
       $count++ ;
       echo'</div>';
   }
   
   
   echo'</div>';

?>

    
<div class="list_btn">
<a href="./form.html">アップロードフォームへ</a>
</div>
</body>
</html>