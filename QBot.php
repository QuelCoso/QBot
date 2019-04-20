<?php 
class QBot {
        public $Name;

public function __construct($param) {
    $this->token = $param;
    $this->endpoint = "https://api.telegram.org/bot".$this->token."/";
  }

  public function inline_kb($args) {
      //echo json_encode($args);
      
      $kb = $args;    
      return json_encode($kb);
      unset($args);
      unset ($kb);
  }
        public function __call($function, $args) {
            
            if(isset($this->token) and $function != 'inline_kb')
            {
                if(isset($args) and is_array($args) and isset($args[0]))
                {
                    $args = $args[0];
                  if(isset($args['reply_markup']['inline_keyboard'])) 
                  {
                      
                      $tast = json_encode(['inline_keyboard' => $args['reply_markup']['inline_keyboard']]);
                      unset($args['reply_markup']['inline_keyboard']);
                      $args['reply_markup'] = $tast;
                  }
                try
                {
                    
                    $da_array = http_build_query($args);
                    $telegram = $this->endpoint. "$function?$da_array"; 
                    return json_decode(file_get_contents("$telegram"), true);
                    
                }catch(Exception $e)
                {
                    try
                    {
                        $telegram = $this->endpoint. "$function"; 
                    return json_decode(file_get_contents("$telegram"), true);
                        
                    }
                    catch(Exception $e)
                    {
                    return $e->getMessage();
                    echo $e->getMessage();
                    }
                }
                }else
                {
                    try
                    {
                        $telegram = $this->endpoint. "$function"; 
                        return json_decode(file_get_contents("$telegram"), true);
                    }catch(Exception $e)
                    {
                        return $e->getMessage();
                    }
                }
            echo json_encode($args);
            }
        }
    }
