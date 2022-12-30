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

  function deleteTask(id) {
    // Redirect to the edit page with the id parameter in the URL
    window.location.href = `delete.php?id=${id}`;
  }
