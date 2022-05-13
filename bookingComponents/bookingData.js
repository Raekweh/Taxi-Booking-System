//
var xhr = createRequest();
function getData(dataSource, divID, cname, mphone, unumber, snumber, stname,sbname, dsbname, pdate, ptime) {
  if (xhr) {
    var obj = document.getElementById(divID);
    var requestbody = "name=" + encodeURIComponent(cname) + "&phone=" + encodeURIComponent(mphone)
      + "&unitnumber=" + encodeURIComponent(unumber) + "&streetnumber=" + encodeURIComponent(snumber)
      + "&streetname=" + encodeURIComponent(stname) + "&suburb=" + encodeURIComponent(sbname)
      + "&destinationsuburb=" + encodeURIComponent(dsbname) + "&pickupdate=" +encodeURIComponent(pdate)
      + "&pickuptime=" +encodeURIComponent(ptime);
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