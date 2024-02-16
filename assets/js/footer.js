// Function to load and insert HTML content from an external file
function includeHTML(file, elementId) {
    fetch(file)
      .then(response => response.text())
      .then(data => {
        document.getElementById(elementId).innerHTML = data;
      });
  }
  
  // Load the header and footer
  includeHTML('footer.html', 'footer');