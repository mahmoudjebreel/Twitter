let pass=document.getElementById("pass");
let pass2=document.getElementById("cpass");
function showPassword(){
    // Check If The User Is Click Checkbox Show Password
    if(pass.type==='password' || pass2.type==="password"){
        // Show password for user
        pass.type='text';
        pass2.type="text";
    }else{
        // hide password for user
        pass.type='password';
        pass2.type="password";
    }
}

function showLoginPassword(){
        // Check If The User Is Click Checkbox Show Password
    if(pass.type==='password'){
        // Show password for user
        pass.type='text';
     
    }else{
        // hide password for user
        pass.type='password';
    }
}