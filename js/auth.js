


function register() {
    var form = document.forms["reg_form"]
    var firstname = form["firstname"].value;
    var lastname = form["lastname"].value;
    var email = form["email"].value;
    var age = form["age"].value;
    var address = form["address"].value;
    var password  = form["password"].value;

    // Validate All The Data

    var data  = {
        "firstname":firstname,
        "lastname":lastname,
        "email":email,
        "age":age,
        "address":address,
        "password":password
    }
    data = JSON.stringify(data);

    fetch("api/reg.php", {method:"POST", body:data})
    .then(HandleResponse)
    .then((data)=>{

    })

    
}

function login() {
    var form = document.forms["login_form"]
    var email = form["email"].value;
    var password  = form["password"].value;
    var data  = {
        "email":email,
        "password":password
    }
    data = JSON.stringify(data);
    fetch("api/login.php", {method:"POST", body:data})
    .then(HandleResponse)
    .then((data)=>{

    })
}




async function  HandleResponse(res) {
    if(res.ok){
        return res.json();
    }else{
        data = await res.json();
        alert(data.message)
    }
}

