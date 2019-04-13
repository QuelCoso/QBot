<?php
if($msg == '/start')
{
    $ik = ['inline_keyboard' => [[['text' => 'ciao', 'url' => 't.me/quelcoso'], ['text' => 'ciao', 'url' => 't.me/quelcoso']]]];
    
    $ik = $QBot->inline_kb($ik);
    
    $QBot->sendMessage(['chat_id' => $chatID, 'text' => 'Ciao '.$name.' !', 'reply_to_message_id' => $msgID, 'reply_markup' => $ik]);
    
}
