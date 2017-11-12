$('#form').on('submit', function (e) {
  e.preventDefault()

  var formData = new FormData($(this)[0])
  var contentHere = $('#contentHere')

  $.ajax({
    url: $(this).attr('action'),
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      let extractedArr = '';
      response = JSON.parse(response)
      
      $.each(response.extractedArr, function (key, val) {
        extractedArr += `
          <tr>
            <td>${key}</td>
            <td>${val}</td>
          </tr>`
      });

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
      contentHere.html(output)

    },
    error: function (response) {
      contentHere.html('Your file does not .txt') 
    }
  });
})

function displayFrequency() {
  let elem = document.getElementById('frequency');
  elem.style.display = 'table';
}