
            function check_out(){
                let wrong=false

                //Name
                let getName=document.getElementById('name').value;
                if(getName.length==0){
                    document.getElementById('wrongName').innerHTML="Tên không được để trống";
                    wrong=true;
                } 
                let regexName=/^([A-ZÁÀÃẢĂẮẰẲẴẶÂẤẦẨẪẬĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÔỐỒỔỖỘƠỚỜỞỠỢÓÒÕỎỌƯỨỪỬỮỰÚÙỦŨỤ][a-zắằẳẵặăấầẩẫậáàãảạđếềểễệêéèẻẽẹíìỉĩịốồổỗộôớờởỡợơóòõỏọứừửữựưúùủũụýỳỷỹỵ]{1,6}\s?)+$/
                if(regexName.test(getName)==false){
                    document.getElementById('wrongName').innerHTML="Tên không hợp lệ!!!";
                    wrong=true;
                } else {
                    document.getElementById('wrongName').innerHTML="";
                }

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

                //phone
                let getPhone=document.getElementById('phone').value;
                let regexPhone=/([\+84|84|0]+(3|5|7|8|9|1[2|6|8|9]))+([0-9]{8})\b/;
                if(regexPhone.test(getPhone)==false){
                    document.getElementById('wrongPhone').innerHTML="Sdt không hợp lệ!!!";
                    wrong=true;
                } else{
                    document.getElementById('wrongPhone').innerHTML="";
                }
                //address
                let getAddress=document.getElementById('address').value;
                if(getAddress.length==0){
                    document.getElementById('wrongAddress').innerHTML="Địa chỉ không được để trống";
                    wrong=true;
                }
                else{
                    document.getElementById('wrongAddress').innerHTML="";
                }



                if(wrong){
                    return false;
                } 

     
            }
