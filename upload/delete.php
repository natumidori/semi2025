<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>show</title>
</head>
<body>
<div class="upload_text">
<?php
   
    $delete_file =$_POST['delete'];
    $filepath='./uploaded/'.$delete_file;
    //unlink('./uploaded/af1a607a.pdf');

    $csvfile = 'file.csv';//現在のファイル
    $csvfile_tmp = 'file_tmp.csv';
    //$tempfile = 'data_temp.csv';//新しいファイル
    //$deletecsv = $delete_file;//削除ファイル名

    $file_csv=fopen($csvfile,"r");//読み込み
    $filetmp_csv=fopen($csvfile_tmp,"w");

    $csv_data=[];
    
    if(unlink($filepath)){
        echo "ファイル削除に成功しました。";
        while(($line = fgetcsv($file_csv,1024))!==FALSE){
            $name = $line[0];
            $summary = $line[1];
            if($delete_file != $name){
                fputcsv($filetmp_csv, [$name, $summary]);//削除ファイル以外の時
            }
        }
        fclose($file_csv);
        fclose($filetmp_csv);

        copy($csvfile_tmp, $csvfile);
        $filetmp_csv=fopen($csvfile_tmp,"w");
        fclose($filetmp_csv);
        
    }else{
        echo "削除に失敗しました。";
    }

    echo '<br><a href="./show.php">一覧へ</a> ';
    ?>
</div>
    </body>
</head>
</html>