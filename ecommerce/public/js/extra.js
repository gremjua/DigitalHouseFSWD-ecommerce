function showSnackBar() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");
  
    // Add the "show" class to DIV
    x.className = "show";
  
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
}

function makeComment () {
    var form = document.querySelector('#commentForm');
    var button = document.querySelector('#commentBtn');

    form.style.display = 'block';
    button.style.display = 'none';

}