<?php

class File{
  
    public static function delete_files($target) {
        if(is_dir($target)){
            $files = glob($target . '*', GLOB_MARK);
            foreach( $files as $file )
                self::delete_files( $file );      
        } 
        elseif(is_file($target))
            unlink( $target );  
    }

}

?>