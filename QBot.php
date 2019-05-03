<?php 
class QBot {
        public $Name;
public function __construct($param) {
    $this->token = $param;
    $this->endpoint = "https://api.telegram.org/bot".$this->token."/";
  }

        public function __call($function, $args) {
            
            if(isset($this->token))
            {
                if(isset($args) and is_array($args) and isset($args[0]))
                {
                    $args = $args[0];
                  if(isset($args['reply_markup'])) 
                  {
                      
                  $args['reply_markup'] = json_encode($args['reply_markup']);
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
                    throw new Exception($e);
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
                        throw new Exception($e);
                        return $e->getMessage();
                    }
                }
            echo json_encode($args);
            }
        }
    }
