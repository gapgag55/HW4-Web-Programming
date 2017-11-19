$('#form').on('submit', function (e) {
  e.preventDefault()

  /*
   * Encode form to send to Backend Server
   */
  var formData = new FormData($(this)[0])

  /*
   * Using Ajax to handle with POST Method
   */
  var http = new XMLHttpRequest();
  
  http.onreadystatechange = function() {
      if(http.readyState == 4 && http.status == 200) {
        output( http.responseText )
      }
  }

  http.open("POST", $(this).attr('action'), true);
  http.send(formData);

  return false;
})

/*
 * Response Function
 */
function output( response ) {
  var contentHere = $('#contentHere')

   /*
    * When Backend send back 
    * Let converse string to JSON first
    * (Backend send file as JSON string) 
    */
  let extractedArr = '';
  response = JSON.parse(response)

  /*
   * Check error Handling from Server
   */
  if (response.error) {
    return contentHere.html(`<h2>${response.message}</h2>`)
  }
  
   /*
    * Let's get extracted Data into html
    * [{'good': 2}, {do: 4}]
    */
  $.each(response.extractedArr, function (key, val) {
    extractedArr += `
      <tr>
        <td>${key}</td>
        <td>${val}</td>
      </tr>`
  });

   /*
    * Standard output HTML with data from Backend
    * 
    * - content: content from file
    * - extracted: removed data based on criteria by using regular expression
    * - extractedArr: counted word
    * 
    */
  let output = `
    <h2>Please find the content of the uploaded file below:</h2>
    ${response.content}
    <h3>Extracted words:</h3>
    ${response.extracted}
    <p><button onclick="displayFrequency()">Display Frequency</button>
    <div id="frequency" style="display: none">
    <h3 style="margin: 20px 0;">Table of words and frequencies of the uploaded file</h3>
    <table border="1">
      <tr>
        <th>Word</th>
        <th>Frequency</th>
      </tr>
      ${extractedArr}
    </table>
  </div>
  `

   /*
    * Let push html to DOM
    */
  contentHere.html(output)
}

/*
 * Function to display extracted table
 * when user clicked on button
 */
function displayFrequency() {
  let elem = document.getElementById('frequency');
  elem.style.display = 'table';
}