<?php 

class UploadController {
  public $uploaded;
  public $base_url;

  public $content;

  public function __construct() {
    $this->uploaded = false;
    $this->base_url = "uploads/";
    $this->content  = "";
  }

  public function index() {
    $this->upload();

    return view('index', array(
      'content' => $this->content,
      'upload'  => $this->uploaded
    ));
  }

  public function upload() { 
      if ($_FILES) {
        $FILE = $_FILES['file'];
    
        // ERROR HANDLING
        if ( $FILE['type'] != 'text/plain' ) {

          // Get the current response code and set a new one
          var_dump(http_response_code(409));

        } else {
          // MOVE FILE   
          $this->base_url .= "{$FILE['name']}";  

          $this->uploaded = move_uploaded_file(
            $FILE['tmp_name'], 
            $this->base_url
          );
          
          // READ FILE
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
    // Extracted Word 
    // Note: Extract by regular expression 
    // Note: Array to String by using implode
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

    // Send to Client
    echo json_encode(array(
      'content' => $this->content,
      'extracted' => $extracted,
      'extractedArr' => $extractedArr
    ));
  }
}