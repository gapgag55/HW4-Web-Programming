$('#form').on('submit', function (e) {
  e.preventDefault()

  /*
   * Encode form to send to Backend Server
   */
  var formData = new FormData($(this)[0])
  var contentHere = $('#contentHere')

  /*
   * Using Ajax to handle with POST Method
   */
  $.ajax({
    url: $(this).attr('action'),
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log( response )

      /*
       * When Backend send back 
       * Let converse string to JSON first
       * (Backend send file as JSON string) 
       */
      let extractedArr = '';
      response = JSON.parse(response)
      
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

    },
    error: function (response) {
      /*
       * When Backend says 409 status code 
       * where means, user has uploaded incorrect file.
       */
      contentHere.html('Your file does not .txt') 
    }
  });

  return false;
})

/*
 * Function to display extracted table
 * when user clicked on button
 */
function displayFrequency() {
  let elem = document.getElementById('frequency');
  elem.style.display = 'table';
}