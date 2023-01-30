<script>
  document.querySelector("form").addEventListener("submit", function(event){
    event.preventDefault();
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "submit_form.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
if (xhr.readyState === 4 && xhr.status === 200) {
// Get the unique URL from the server's response
    var unique_url = xhr.responseText;
// Display the unique URL on the page
    document.getElementById("unique_url").innerHTML = unique_url;
}
};
// Send the form data to the server
    xhr.send(new FormData(event.target));
});
</script>