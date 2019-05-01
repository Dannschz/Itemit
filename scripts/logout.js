
if(localStorage.getItem('name') == null)
{
    location.href = window.location.origin + '/itemit/signup.html';
}

document.getElementById('logout-btn').addEventListener('click', () => {
    localStorage.removeItem('name');
    location.href = window.location.origin + '/itemit/signup.html';
})
