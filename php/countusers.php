<?php
if(file_exists("count.dat"))
{
  $exist_file = fopen("count.dat", "r");
  $new_count = fgets($exist_file, 255);
  $new_count++;
  fclose($exist_file);
  // 
  $exist_count = fopen("count.dat", "w");
  fputs($exist_count, $new_count);
  fclose($exist_count);
}
else
{
$new_file = fopen("count.dat", "w");
fputs($new_file, "1");
fclose($new_file);
}
echo $new_count

?>
