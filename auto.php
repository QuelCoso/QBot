<?php
echo "Avviato.\n";
try
{
file_put_contents("bot.php", file_get_contents("https://raw.githubusercontent.com/QuelCoso/QBot/master/example.php"));
file_put_contents("start.php", file_get_contents("https://raw.githubusercontent.com/QuelCoso/QBot/master/start.php"));
file_put_contents("QBot.php", file_get_contents("https://raw.githubusercontent.com/QuelCoso/QBot/master/QBot.php"));

echo "\nFatto.";
exit();
}catch(Exception $e){
echo 'Errore: '.$e->getMessage();
exit();
}
