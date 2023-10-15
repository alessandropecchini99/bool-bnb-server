const button = document.getElementById("button");
const btn = document.getElementById("btn");
const offClose = document.getElementById("off-close");

button.onclick = () => {
    button.classList.toggle("toggled");
};

btn.onclick = () => {
    btn.classList.toggle("toggled");
};

offClose.onclick = () => {
    btn.classList.toggle("toggled");
};
