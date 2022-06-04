//Student Name: Raymond Li
//Student ID: 18028813

//booking.js is used to post information from the html to the php along with updating the html when changes are made without reloading into another page.
//getDate function is used to post information to booking.php while updating the div in the html when changes are made.
//validName function is used to check if the user only inputs characters and spaces.
//validPhone function is used to check if the user only inputs numbers.
//validSNumber functin is used to check if the street number is not empty.
//validStNumber function is used to check if the user is only inputting characters and spaces.
//validPickupDateTime function is used to check if the date and time is before the current date and time.

var xhr = createRequest();
function getData(dataSource, divID, cname, mphone, unumber, snumber, stname, sbname, dsbname, pdate, ptime) {
  if (validName(cname) && validPhone(mphone) && validSNumber(snumber) && validStNumber(stname) && validPickupDateTime(pdate,ptime)) 
  {
    if (xhr) 
    {
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
        if (xhr.readyState == 4 && xhr.status == 200) 
        {
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
  //Checks if the name is null or an empty string
  if (cname == null || cname.trim().length == 0) 
  {
    alert("Please enter a customer name");
    return false;
  }
  else 
  {
    if (cname.match(pattern)) 
    {
      return true;
    }
    else 
    {
      alert("Please change the format of your customer name. Please do not inlude numbers or special characters");
      return false;
    }
  }
}

//Phonee Validation
function validPhone(mphone) 
{
  var pattern = /^[0-9]*$/;
  //Check if the phone number is null or an empty string
  if (mphone == null || mphone.trim().length == 0)
   {
    alert("Please enter a phone number");
    return false;
  }
  else {
    if (mphone.match(pattern)) 
    {
      if (mphone.length >= 10 && mphone.length <= 12)
       {
        return true;
      }
      else 
      {
        alert("Please ensure that your phone number is between 10 to 12 digits long");
        return false;
      }
    }
    else 
    {
      alert("Please ensure that your phone number is numbers");
      return false;
    }
  }
}

//Street Number validation
function validSNumber(snumber) 
{
  //Check if the street number is null or an empty string
  if (snumber == null || snumber.trim().length == 0)
   {
    alert("Please enter a street number");
    return false;
  }
  return true;
}

//Street Name validation
function validStNumber(stname) 
{
  var pattern = /^[a-zA-Z\s]*$/;
  //Checks if the street number is null or an empty string
  if (stname == null || stname.trim().length == 0) 
  {
    alert("Please enter a street name");
    return false;
  }
  else
   {
    if (stname.match(pattern)) 
    {
      return true;
    }
    else 
    {
      alert("Please ensure that your street name does not include any number or special characters");
      return false;
    }
  }
}

//Date and Time validation
function validPickupDateTime(pdate, ptime) 
{
  //Checks if the date or time is null
  if (pdate != null || ptime != null) 
  {
    //Converting the current date to
    var currentDate = new Date();
    var cd = Date.parse(currentDate);

    enteredDateString = pdate + " " + ptime;
    var enteredDate = Date.parse(enteredDateString);

    //Checking if the entered date and time is after the current date and time
    if (enteredDate >= cd) 
    {
      return true;
    }
    else
     {
      alert("Please ensure that the date or time is after the current date and the current time");
    }
  }
}