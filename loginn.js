const rigesterbtn = document.getElementById('register');


rigesterbtn.addEventListener('click', () => {

  document.getElementById('toggle-right').style.opacity = "0";
  document.getElementById('toggle-right').style.right = "0%";
  document.getElementById('toggle-right').style.height = "10%";
  document.getElementById('toggle-right').style.width = "10%";
  document.getElementById('toggle-left').style.height = "100%";
  document.getElementById('toggle-left').style.width = "50%";
  document.getElementById('toggle-left').style.opacity = "1";
  document.getElementById('toggle-left').style.right = "50%";
})




const loginbtn = document.getElementById('login');


loginbtn.addEventListener('click', () => {
  document.getElementById('toggle-right').style.opacity = "1";
  document.getElementById('toggle-right').style.right = "0%";
  document.getElementById('toggle-right').style.height = "100%";
  document.getElementById('toggle-right').style.width = "50%";
  document.getElementById('toggle-left').style.height = "10%";
  document.getElementById('toggle-left').style.width = "10%";
  document.getElementById('toggle-left').style.opacity = "0";
  document.getElementById('toggle-left').style.right = "99%";
})







if (window.innerWidth < 770) {
    const title = document.getElementById('h1');
    const buttonUp = document.getElementById('buton_up');
    const signInDiv = document.getElementById('sign-inn');
    const signUpDiv = document.getElementById('sign-upp');
    buttonUp.style.display = "flex";
  
    title.innerText = "If you don't have an account";
  
    buttonUp.addEventListener('focus', () => {
      signInDiv.style.display = "none";
      signInDiv.style.width = "50%";
  
      signUpDiv.style.display = "flex";
      console.log("hellooo");
      title.innerText = "Welcome to sign up!";
    });
  
  
  
  
  
    const title1 = document.getElementById("h2");
    const buttonUp1 = document.getElementById("buto");
    buttonUp1.style.display = "flex";
  
    title1.innerText = "If you don't have an account";
  
    buttonUp1.addEventListener('click', () => {
      signInDiv.style.transition = "all 1s ease-in-out"
      signInDiv.style.display = "flex";
      signInDiv.style.width = "50%";
      signUpDiv.style.backgroundColor = "#ccc";
      signUpDiv.style.display = "none";
      signUpDiv.style.width = "50%";
  
      title1.innerText = "Welcome to sign up!";
    });
  
  
  }





/*

if (window.innerWidth > 750) {
    const rigesterbtn = document.getElementById('register');
    const loginbtn = document.getElementById('login');
  
    rigesterbtn.addEventListener('click', () => {
      document.getElementById('toggle-right').style.opacity = "0";
      document.getElementById('toggle-right').style.right = "90%";
      document.getElementById('toggle-left').style.opacity = "1";
      document.getElementById('toggle-left').style.right = "50%";
    });
  
    loginbtn.addEventListener('click', () => {
      document.getElementById('toggle-right').style.opacity = "1";
      document.getElementById('toggle-right').style.right = "0%";
      document.getElementById('toggle-left').style.opacity = "0";
      document.getElementById('toggle-left').style.right = "0%";
    });
  }



*/