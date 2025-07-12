const openmessenger=document.getElementById("messenger");
const openliked=document.getElementById("liked");


const changebutton=document.getElementById("addprojet");
const changeinfo=document.querySelector(".update_information");

changebutton.addEventListener("click",(e)=>{
    e.stopPropagation();
    changeinfo.classList.add("active");

})

const close=document.getElementById('close');
close.addEventListener("click",(e)=>{
    e.stopPropagation();
    changeinfo.classList.remove("active");

})

document.addEventListener("click", (e) => {
    if (!changeinfo.contains(e.target) && e.target !== changebutton) {
      changeinfo.classList.remove("active");
    }
  });




const messengerIcon = document.getElementById("messenger");
const messengerBox = document.querySelector(".messenger.messa");

messengerIcon.addEventListener("click", (e) => {
  e.stopPropagation();
  messengerBox.classList.toggle("active");
});

// Close when clicking outside
document.addEventListener("click", (e) => {
  if (!messengerBox.contains(e.target) && e.target !== messengerIcon) {
    messengerBox.classList.remove("active");
  }
});





const likeIcon = document.getElementById("liked");
const likeBox = document.querySelector(".messenger.liked");

likeIcon.addEventListener("click", (e) => {
  e.stopPropagation();
  likeBox.classList.toggle("active");
});

// Close when clicking outside
document.addEventListener("click", (e) => {
  if (!likeBox.contains(e.target) && e.target !== likeIcon) {
    likeBox.classList.remove("active");
  }
});


const personicon=document.querySelectorAll(".messa .person");
const messagebox=document.querySelector(".comunnication");
personicon.forEach((person)=>{
person.addEventListener("click", (e)=>{
    e.stopPropagation();
    messagebox.classList.add("active");
});
});
document.addEventListener("click",(e)=>{
    if(!messagebox.contains(e.target) && !e.target.closest(".person") &&!e.target.closest(".chat_input")){
        messagebox.classList.remove("active");
    }
})














const projecticon = document.querySelectorAll(".containe_projet .projet");
const projectbox = document.querySelector(".projectproject");
const projectImage = projectbox.querySelector(".scroll.projet .image img");
const projectName = projectbox.querySelector(".infoprojet h2");
const projectTitle = projectbox.querySelector(".infoprojet h3");
const projectDescription = projectbox.querySelector(".infoprojet span:nth-of-type(1)");
const projectDate = projectbox.querySelector(".infoprojet span:nth-of-type(2)");
projecticon.forEach((projet) => {
    projet.addEventListener("click", (e) => {
        e.stopPropagation();
                const imgSrc = projet.querySelector("img").src;
        const name = projet.querySelector("h2").innerText;
        const title = projet.querySelector("h3").innerText;
        const description = projet.getAttribute("data-description"); 
        const date = projet.getAttribute("data-date");  
        projectImage.src = imgSrc;
        projectName.textContent = name;
        projectTitle.textContent = title;
        projectDescription.textContent = description || "No description available.";
        projectDate.textContent = date ? "Created at " + date : "";
        projectbox.classList.add("active");
    });
});
document.addEventListener("click", (e) => {
    if (!projectbox.contains(e.target) && !e.target.closest(".projet")) {
        projectbox.classList.remove("active");
    }
});


const profileIcons = document.querySelectorAll(".container_profile .profile");
const profileBox = document.querySelector(".projectproject.profile");

// Info inside profile popup
const profilePhoto = profileBox.querySelector(".image_profile img");
const profileName = profileBox.querySelector(".information h1");
const profileFiliere = profileBox.querySelector(".information h2");
const profileCompetence = profileBox.querySelector(".information h3");
const profileProjectsContainer = profileBox.querySelector(".project_box");

// Get all hidden projects
const allProjects = document.querySelectorAll(".containe_projet .projet");

profileIcons.forEach((profile) => {
  profile.addEventListener("click", (e) => {
      e.stopPropagation();

      const userId = profile.dataset.id;
      const photo = profile.dataset.photo;
      const name = profile.dataset.name;
      const filiere = profile.dataset.filiere;
      const competence = profile.dataset.competence;

      profilePhoto.src = photo;
      profileName.textContent = name;
      profileFiliere.textContent = filiere;
      profileCompetence.textContent = competence;

      profileBox.classList.add("active");

      // Clear old projects
      profileProjectsContainer.innerHTML = "";

      // Find and show all projects created by this user
      allProjects.forEach((project) => {
          if (String(project.dataset.idUtilisateur) === String(userId)) {
              const projectElement = document.createElement('div');
              projectElement.classList.add('scroll');
              projectElement.innerHTML = `
                  <div class="image">
                      <img src="${project.dataset.photo}" alt="">
                      <h2>${project.dataset.nom} ${project.dataset.prenom}</h2>
                      <h3>${project.dataset.titre}</h3>
                      <span>${project.dataset.description}</span>
                  </div>
              `;
              profileProjectsContainer.appendChild(projectElement);
          }
      });
  });
});


// Close profile box if clicking outside
document.addEventListener("click", (e) => {
    if (!profileBox.contains(e.target) && !e.target.closest(".profile")) {
        profileBox.classList.remove("active");
    }
});



const messageicon=document.querySelectorAll(".interaction .fa-message");
messageicon.forEach((person)=>{
person.addEventListener("click", (e)=>{
    e.stopPropagation();
    messagebox.classList.add("active");
});
});




const messageIcons = document.querySelectorAll(".interaction .fa-message");
const communicationForm = document.querySelector(".comunnication");
const destinatireInput = communicationForm.querySelector("#destinataire_id");

messageIcons.forEach((icon) => {
    icon.addEventListener("click", (e) => {
      e.stopPropagation();
  
      const userId = icon.closest(".profile").dataset.id;
      destinatireInput.value = userId;
  
      communicationForm.classList.add("active");
    });
  });
  
  document.addEventListener("click", (e) => {
    if (!communicationForm.contains(e.target) && !e.target.closest(".fa-message")) {
      communicationForm.classList.remove("active");
    }
  });





  const likeButtons = document.querySelectorAll(".like-button");

likeButtons.forEach(button => {
  button.addEventListener("click", (e) => {
    e.stopPropagation();
    const likedUserId = button.dataset.id;

    fetch("like_user.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: "liked_user_id=" + encodeURIComponent(likedUserId)
    })
    .then(res => res.text())
    .then(response => {
      console.log("User liked successfully");
      button.style.color = "red"; // show liked visually
    });
  });
});


document.addEventListener("click", (e) => {
    if (e.target.closest(".unlike-button")) {
      const button = e.target.closest(".unlike-button");
      const likedUserId = button.dataset.id;
  
      fetch("unlike_user.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "liked_user_id=" + encodeURIComponent(likedUserId)
      })
      .then(res => res.text())
      .then(() => {
        // Option 1: Remove the element from the DOM
        button.closest(".person").remove();
  
        // Option 2: Reload liked list (if using AJAX later)
      });
    }
  });



 
// Optional: Close communication form if clicking outside
/*
document.addEventListener("click", (e) => {
    if (!communicationForm.contains(e.target) && !e.target.closest(".fa-message")) {
        communicationForm.style.display = 'none';
    }
});

const profileicon=document.querySelectorAll(".container_profile .profile");
const profilebox=document.querySelector(".projectproject.profile");
profileicon.forEach((profile)=>{
profile.addEventListener("click", (e)=>{
    e.stopPropagation();
    profilebox.classList.add("active");
});
});
document.addEventListener("click",(e)=>{
    if(!profilebox.contains(e.target) && !e.target.closest(".profile") ){
        profilebox.classList.remove("active");
    }
})*/





if(window.innerWidth<1025){
    messengerIcon.addEventListener("click", (e) => {
        e.stopPropagation();
        messengerBox.classList.add("active");
        messagebox.classList.remove("active");
        likeBox.classList.remove("active");

      });


      likeIcon.addEventListener("click", (e) => {
        e.stopPropagation();

 messengerBox.classList.remove("active");
        messagebox.classList.remove("active");
        likeBox.classList.add("active");


      });




}




