function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }
  
  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
  }

  function editTask(id) {
    // Redirect to the edit page with the id parameter in the URL
    window.location.href = `edit.php?id=${id}`;
  }

  function deleteTask() {
    // Get the delete button
    const deleteButton = document.querySelector('.delete-btn');
  
    // Attach a click event to the delete button
    deleteButton.addEventListener('click', event => {
      // Get the task ID from the row
      const taskId = event.target.parentNode.parentNode.firstChild.textContent;
  
      // Send an HTTP DELETE request to the server
      fetch(`delete.php?id=${taskId}`, {
        method: 'DELETE'
      }).then(response => {
        // Refresh the page after the delete action is completed
        window.location.reload();
      });
    });
  }
// Call the delete task function when the DOM is ready
document.addEventListener('DOMContentLoaded', deleteTask);  