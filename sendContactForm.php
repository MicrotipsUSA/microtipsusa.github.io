<?php

if(isset($_POST[fullName]) && isset($_POST[companyName]) && isset($_POST[companyLocation]) && isset($_POST[contactEmail]) && isset($_POST[contactPhoneNumber]) && isset($_POST[message])){
  mail('jordanruhl@gmail.com', 'all good', 'all good');
}
else {
  mail('jordanruhl@gmail.com', 'ALL NOT GOOD', 'ALL NOT GOOD');
}

?>