//
var xhr = createRequest();
function getData(dataSource, divID, cname, mphone, unumber, snumber, stname, sbname, dsbname, pdate, ptime) {
  if (validName(cname) && validPhone(mphone) && validSNumber(snumber) && validStNumber(stname) && validPickupDateTime(pdate,ptime)) {
    if (xhr) {
      var obj = document.getElementById(divID);
      var requestbody = "name=" + encodeURIComponent(cname) + "&phone=" + encodeURIComponent(mphone)
        + "&unitnumber=" + encodeURIComponent(unumber) + "&streetnumber=" + encodeURIComponent(snumber)
        + "&streetname=" + encodeURIComponent(stname) + "&suburb=" + encodeURIComponent(sbname)
        + "&destinationsuburb=" + encodeURIComponent(dsbname) + "&pickupdate=" + encodeURIComponent(pdate)
        + "&pickuptime=" + encodeURIComponent(ptime);
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
  }

} // end function getData()

//Customer Name Validation
function validName(cname) {
  var pattern = /^[a-zA-Z\s]*$/;
  //Checks if the name is null
  if (cname == null || cname.length == 0) {
    alert("Please enter a customer name");
    return false;
  }
  else {
    if (cname.match(pattern)) {
      return true;
    }
    else {
      alert("Please change the format of your customer name. Please do not inlude numbers or special characters");
      return false;
    }
  }
}

//Phonee Validation
function validPhone(mphone) {
  var pattern = /^[0-9]*$/;

  if (mphone == null || mphone.length == 0) {
    alert("Please enter a phone number");
    return false;
  }
  else {

    if (mphone.match(pattern)) 
    {
      if (mphone.length >= 10 && mphone.length <= 12) {
        return true;
      }
      else {
        alert("Please ensure that your phone number is between 10 to 12 digits long");
        return false;
      }
    }
    else {
      alert("Please ensure that your phone number is numbers");
      return false;
    }
    return false;
  }
}

//Street Number validation
function validSNumber(snumber) {
  if (snumber == null || snumber.length == 0) {
    alert("Please enter a street number");
    return false;
  }
  return true;
}

//Street Name validation
function validStNumber(stname) {
  var pattern = /^[a-zA-Z\s]*$/;
  if (stname == null || stname.length == 0) {
    alert("Please enter a street name");
    return false;
  }
  else {
    if (stname.match(pattern)) {
      return true;
    }
    else {
      alert("Please ensure that your street name does not include any number or special characters");
      return false;
    }
  }
}
//
function validPickupDateTime(pdate, ptime) {
  if (pdate != null || ptime != null) {
    //Converting the current date to
    var currentDate = new Date();
    var cd = Date.parse(currentDate);

    enteredDateString = pdate + " " + ptime;
    var enteredDate = Date.parse(enteredDateString);

    if (enteredDate >= cd) {
      return true;
    }
    else {
      alert("Please ensure that the date or time is after the current date and the current time");
    }
  }
}