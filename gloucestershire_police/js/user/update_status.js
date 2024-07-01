document.getElementById('updateStatusForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var bikeId = document.getElementById('bikeId').value;
            var status = document.getElementById('status').value;
            
            console.log(bikeId)
            console.log(status)

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Optional: Display a message or handle the response from the server
                    alert("Status updated successfully!");
                    // Optionally, refresh the page to see the updated status
                    window.location.reload();
                }
            };
            xhttp.open("GET", "../../php/admin/update_status.php?id=" + encodeURIComponent(bikeId) + "&status=" + encodeURIComponent(status), true);
            xhttp.send();
        });