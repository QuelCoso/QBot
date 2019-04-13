<?php
if($msg == '/start')
{
    $QBot->sendMessage(['chat_id' => $chatID, 'text' => 'Ciao '.$name.' !', 'reply_to_message_id' => $msgID]);
}
