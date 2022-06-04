//Student Name: Raymond Li
//Student ID: 18028813

//Admin.js is used to POST information from the html to the php along with updating the html when changes are made without reloading into another page.
//adminData function is used to POST booking reference number code to admin.php while updaing the div in the html when changes are made.
var xhr = createRequest();
function adminData(dataSource, divID, bsearch) {
  if (xhr) {
    var obj = document.getElementById(divID);
    var requestbody = "bookingsearch=" + encodeURIComponent(bsearch);
    xhr.open("POST", dataSource, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
      alert(xhr.readyState); // to let us see the state of the computation 
      if (xhr.readyState == 4 && xhr.status == 200) {
        obj.innerHTML = xhr.responseText;
      } // end if 
    } // end anonymous call-back function 
    xhr.send(requestbody);
  } // end if 
} // end function getData()