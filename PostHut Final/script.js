const likeBtn = document.querySelector(".like_btn"); 
const likeBtn2 = document.querySelector(".like_btn2"); 
const likeBtn3 = document.querySelector(".like_btn3"); 
let likeIcon = document.querySelector("#icon"); 
let count = document.querySelector("#count"); 
let count2 = document.querySelector("#count2"); 
let count3 = document.querySelector("#count3"); 
 
let clicked1 = false; 
let clicked2 = false; 
let clicked3 = false; 
 
 
likeBtn.addEventListener("click", () => { 
    if (!clicked1)  
    { 
        clicked1 = true; 
        likeIcon.innerHTML = '<i class ="fas fa-thumbs-up"></i>' 
        count.textContent++; 
    } 
    else 
    { 
        clicked1 = false; 
        likeIcon.innerHTML = '<i class ="fas fa-thumbs-up"></i>' 
        count.textContent--; 
    } 
}); 
 
likeBtn2.addEventListener("click", () => { 
    if (!clicked2)  
    { 
        clicked2 = true; 
        likeIcon.innerHTML = '<i class ="fas fa-thumbs-up"></i>' 
        count2.textContent++; 
    } 
    else 
    { 
        clicked2 = false; 
        likeIcon.innerHTML = '<i class ="fas fa-thumbs-up"></i>' 
        count2.textContent--; 
    } 
}); 
 
likeBtn3.addEventListener("click", () => { 
    if (!clicked3)  
    { 
        clicked3 = true; 
        likeIcon.innerHTML = '<i class ="fas fa-thumbs-up"></i>' 
        count3.textContent++; 
    } 
    else 
    { 
        clicked3 = false; 
        likeIcon.innerHTML = '<i class ="fas fa-thumbs-up"></i>' 
        count3.textContent--; 
    } 
});
