<?php 

class UploadController {
  public $base_url;
  public $content;

  public function __construct() {
    $this->base_url = "uploads/";
    $this->content  = "";
  }

  public function upload() { 

      /*
       * Check that user has uploaded file
       */
      if ($_FILES) {

        $FILE = $_FILES['file'];
    
        // ERROR HANDLING
        if ( $FILE['type'] != 'text/plain' ) {

          /*
           * Response back HTTP Status Code 409
           * Conflict file
           * When user uploads indirectly filed extension from .txt
           */
          echo json_encode(array(
            'message' => 'Your file doesn\'t supperted our system',
            'error'   => true
          ));

        } else {
          /*
           * Movie File into Upload Folder
           */ 
          $this->base_url .= $FILE['name'];  

          move_uploaded_file($FILE['tmp_name'], $this->base_url);
          
          /*
           * Read File by using readUpload Method 
           */
          $this->readUpload();
        }
      }
  }

  public function readUpload() {

    $file  = fopen($this->base_url, "r") or die("Unable to open file!");
    while(! feof($file))
    {
      $this->content .= fgets($file). "<br/>";
    }
    fclose($file);

    $this->extractWords();
  }

  public function extractWords() {
    /* 
     * Extracted Word 
     * Note: Extract by regular expression 
     * Note: Array to String by using implode
     */
    $extracted = implode(" ",
      array_map(
        'strtolower',
        preg_split(
        "((?:a|an|the|that|those|these|is|am|are|isn't|aren't|not|has|have|had|hasn't|haven't|hadn't|will|won't|shall|after|in|on|with|to|into)\s+|([0-9]|\'s|s\'|\'re|\'ll|\\r|\\n|\#|\%|\&|\*|!|\?|\.|\,|\s+|<br/>))"
        , $this->content)
      )
    );

    $extractedArr = array_count_values(
      str_word_count($extracted, 1)
    );

    /*
     * Send Data to Client
     */
    echo json_encode(array(
      'content' => $this->content,
      'extracted' => $extracted,
      'extractedArr' => $extractedArr
    ));

  }
}

$controller = new uploadController();
$controller->upload();