# Taxi Booking System 

# -----Booking Files-----
#  - booking.html
#  - booking.js
#  - booking.php

# -----Admin Files-----
#  - admin.html
#  - admin.js
#  - admin.php

# -----Other Files-----
#  - sqlinfo.php
#  - mysqlcommand.txt
#  - style.css

# -----Instructions-----
# Booking.html
# 1. The user will enter a Customer name, Phone number, Unit number, Street number, Street name, suburb, Destintation suburb, Pickup date and Pickup time.
# 2. The required fields are Customer name, Phone number, Street number, Street name, Pickup date and Pickup time.
# 3. The Customer name field must not include any special or numerical characters.
# 4. The Phone number field must consist of numerical characters.
# 5. The Pickup date and Pick up time can not be earlier than the current date/time.
# 6. Click the booking button to book the taxi.
# 7. The confirmation booking information will contain the uniquely generated booking reference number, pickup date and pickup time.

# Admin.html
# 1. Enter the booking Reference number to search
# 2. If the booking reference number is in the correct format (BRN00000) which is BRN with 5 digits at the end then query will try to find a match.
# 3. if the booking reference number is in the incorrect format, the user will be notified to correct their format
# 4. If the admin searches with no input, the query will search for all bookings that are unsigned within the current date and between the current time and 2 hours ahead.
