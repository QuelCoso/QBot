<?php
require_once 'QBot.php';
if(file_exists("settings.json"))
{
    $settings = json_decode(file_get_contents("settings.json"), true);
     //$settings = get_object_vars($settings);
    if(isset($settings['bot file'])) $file = $settings['bot file'];
    
    if(isset($settings['token']))
    {
        $token = $settings['token'];
        if($token == 'YOURBOTTOKEN')
        {
           
           $token = readline('Inserisci qui il token del bot:'. "\n");
             $QBot = new QBot($token);
           
            a:
            try
            {
                $me = $QBot->getMe();
                 $settings['token'] = $token;
                 echo "\nBot avviato\n";
            }catch(Exception $e)
            {
                echo "Token non valido";
                goto a;
            }
            file_put_contents("settings.json", json_encode($settings));
        }else
        {
            b:
            try
            {
               $QBot = new QBot($settings['token']);   
                 $me = $QBot->getMe();
                 $settings['token'] = $token;
                echo "\nBot avviato\n";
            }
            catch(Exception $e)
            {
                echo "\nErrore.\n";
                goto b;
            }
             file_put_contents("settings.json", json_encode($settings));
        }
        
    }
}else
{
    file_put_contents("settings.json", json_encode(['token' => "YOURBOTTOKEN", 'bot file' => 'bot.php']), JSON_PRETTY_PRINT);
    exit();
}

$offset = 0;
 if(!isset($file) or !file_exists($file))
            {
                file_put_contents("bot.php", file_get_contents("https://raw.githubusercontent.com/QuelCoso/QBot/master/example.php"));
                $file = 'bot.php';
            }

while(true)
{
   
        $updates = $QBot->getUpdates(['offset' => $offset]);
        foreach($updates['result'] as $update)
        {
          
            $offset = $update['update_id'] + 1;
            $update['update'] = $update;
if(isset($update['update']['message']['text'])) $msg = $update['update']['message']['text']; else $msg = '';
if(isset($update['update']['message']['chat']['id'])) $chatID = $update['update']['message']['chat']['id']; else $chatID = ''; 
if(isset($update['update']['message']['chat']['title'])) $title = $update['update']['message']['chat']['title']; else $title = '';
if(isset($update['update']['message']['from']['first_name'])) $name=$update['update']['message']['from']['first_name'];else $name = '';
if(isset($update['update']['message']['from']['id'])) $userID=$update['update']['message']['from']['id'];else $userID = '';
if(isset($update['update']['message']['from']['username'])) $username=$update['update']['message']['from']['username'];else $username = '';
if(isset($update['update']['message']['message_id'])) $msgID=$update['update']['message']['message_id'];else $msgID = '';
            
        

           
            include $file;
            

            
        }
    
}
