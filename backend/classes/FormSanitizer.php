<?php

class FormSanitizer{
     
  public static  function formSanitizerString($data){
        // Remove characters from both sides of a string 
            // trim()
        //Strip the string from HTML tags
            //strip_tags()
        $data=trim(strip_tags($data));
        // Remove Property(styles) Attrbuite 
            //htmlspecialchars()
        $data=htmlspecialchars($data);
        return $data;
    }

    public static  function formSanitizerName($data){
        $data=trim(strip_tags($data));
        $data=htmlspecialchars($data);
        $data=strtolower($data);
        $data=ucfirst($data);
        return $data;
    }
}

?>