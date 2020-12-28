
function empty_field1(){

 var flag = true;
var inputs = document.getElementsByTagName('input');
var warning = document.getElementsByTagName('h6');

for (i = 0; i < inputs.length-1; ++i) {
  if(inputs[i].value=="" && inputs[i]!=document.getElementById("HomeNumber") ){
    error(inputs[i],warning[i],"Please enter this field")
   
    flag= false;

  }
  
else{
inputs[i].style.borderColor ="";
warning[i].innerHTML ="";
} }

  return flag;}


function empty_field(){

 var flag = true;
var inputs = document.getElementsByTagName('input');
var warning = document.getElementsByTagName('h6');

for (i = 0; i < inputs.length; ++i) {
  if(inputs[i].value=="" && inputs[i]!=document.getElementById("HomeNumber")  && inputs[i]!=document.getElementById("Re-enter") ){
    error(inputs[i],warning[i],"Please enter this field")
   
    flag= false;

  }
  
else{
inputs[i].style.borderColor ="";
warning[i].innerHTML ="";
} }

  return flag;}

  function validate_names(){

 var flag = true;
var full_name = document.getElementsByTagName('input');
var warning = document.getElementsByTagName('h6');

for (i = 0; i <= 2; ++i) {
  var search_name = full_name[i].value.search(/^[A-Za-z]+$/);

  if(full_name[i].value.length<3 && full_name[i].value!="" ){
    error(full_name[i],warning[i],"Name must be longer than 2 characters")
    
    flag= false;

  }
  else if(search_name!=0 && full_name[i].value!=""){
     error(full_name[i],warning[i],"Name must be alphabetical characters only")
    flag= false;
   
  }

}
  return flag;}

  

function validate_MobileNumber(){

 var flag = true;
var phone= document.getElementById("phone").value;
  var search_phone = phone.search(/^[0][1][0-9]{9}$/);

  if(search_phone!=0 && phone!=""){
    error(document.getElementById("phone"),document.getElementById("warn6"),"Mobile number must be 11 numbers");
   
    flag= false;
   
  }
return flag;}

  function validate_GurdianNumber(){

 var flag = true;
var phone= document.getElementById("phone2").value;
  var search_phone = phone.search(/^[0][1][0-9]{9}$/);

  if(search_phone!=0 && phone!=""){
    error(document.getElementById("phone2"),document.getElementById("warn7"),"Mobile number must be 11 numbers");
   
    flag= false;
   
  }
return flag;}




function validate_HomeNumber(){

 var flag = true;
var home= document.getElementById("HomeNumber").value;
  var search_home = home.search(/^[0-9]{7}$/);

  if(search_home!=0 && home!=""){
    error(document.getElementById("HomeNumber"),document.getElementById("warn8"),"Phone number must be 7 numbers");
   
    flag= false;
   
  }

  return flag;}

  function check_password(){
var password1= document.getElementById("password").value;

if(password1==""){
  document.getElementById("Re-enter").blur();
   document.getElementById("password").focus();
document.getElementById("warn5").innerHTML = "Please enter password first";
}
else{
  document.getElementById("warn5").innerHTML = "";
}

}


function validate_1stpassword(){

 var flag = true;
var password1= document.getElementById("password").value;
  var password_length = password1.length;
var search_password= password1.search(/^(?=.*[a-z])(?=.*[A-Z])([0-9]*)(?=.*[!@#\$%\^&\*])(?=.{8,15})/);

if (password_length<8 && password1!="") {
error(document.getElementById("password"),document.getElementById("warn4"),"Password must be atleast 8 characters");
    flag=false;

    }


  else if(search_password && password1!=""){
    error(document.getElementById("password"),document.getElementById("warn4"),"Password must contain both upper and lower case charecters and a specail character");
   
    flag= false;
   
  }

  return flag;}



function validate_2ndpassword(){

 var flag = true;
 var password1= document.getElementById("password").value;
var password2= document.getElementById("Re-enter").value;
  if (password2=="" && password1!="") {
     error(document.getElementById("Re-enter"), document.getElementById("warn5"),"Please confirm password");
   
flag=false;}

  else if (password2!=password1) {
    error(document.getElementById("Re-enter"), document.getElementById("warn5"),"Passwords don't match");

    flag=false;

    }

     return flag;}

     function validate_email(){

 var flag = true;
var email= document.getElementById("email").value;
  var search_email =email.search(/^\w+([\.-]?\w+)*@\alexu.edu.eg$/);

  if(search_email!=0 && email!=""){

    error(document.getElementById("email"),document.getElementById("warn4"),"Email must be in the format email@example.com");
  
    flag= false;
   
  }
 return flag;}

  function validate_NationalId(){

 var flag = true;
var zip= document.getElementById("zip").value;
  var search_zip = zip.search(/^[0-9]{14}$/);

  if(search_zip!=0 && zip!=""){
    error(document.getElementById("zip"),document.getElementById("warn5"),"National ID number must be 14 numbers");
   
    flag= false;
   
  }

  return flag;}
  function validate_StudentId(){

 var flag = true;
var studentid= document.getElementById("studentid").value;
  var search_studentid = studentid.search(/^[0-9]+$/);

  if(search_studentid!=0 && studentid!=""){
    error(document.getElementById("studentid"),document.getElementById("warn10"),"Student ID must be numerical");
   
    flag= false;
   
  }
return flag;}


  function validate_gender(){

 var flag = true;
 if (document.getElementById('gender').value=="")
  {
    error(document.getElementById('gender'),document.getElementById("warn_gender"),"please make a choice");
   
    flag= false;
   
  }
  else{
document.getElementById('gender').style.borderColor ="";
document.getElementById("warn_gender").innerHTML ="";

  }
  

return flag;}

function validate_math(){

 var flag = true;
 if (document.getElementById('math').value=="")
  {
    error(document.getElementById('math'),document.getElementById("warn_math"),"please make a choice");
   
    flag= false;
   
  }
  else{
document.getElementById('math').style.borderColor ="";
document.getElementById("warn_math").innerHTML ="";

  }
  

return flag;}

  
  function error(border,warning,message){

border.style.borderColor = "red";
warning.innerHTML = message;

  }
