function check_out(){
                let wrong=false
                //Email
                let getEmail=document.getElementById('email').value;
                if(getEmail.length==0){
                    document.getElementById('wrongEmail').innerHTML="Email không được để trống";
                    wrong=true;
                }

                //Password
                let getPasswords=document.getElementById('password').value;

                let regexPassword=/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,16}$/;
                if(regexPassword.test(getPasswords)==false){
                    document.getElementById('wrongPassword').innerHTML="Mật khẩu không hợp lệ!!!";
                    wrong=true;
                } else{
                    document.getElementById('wrongPassword').innerHTML="";
                }

                if(wrong){
                    return false;
                } 
}