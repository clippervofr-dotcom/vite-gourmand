function echapperHTML(texte) {
    const div = document.createElement('div');
    div.textContent = texte;
    return div.innerHTML;
}

function capitalizeFirstLetter(str) {
    if (str.length === 0) return str;
    if (!/[a-zA-Z]/.test(str.charAt(0))) return str;
    return str.charAt(0).toUpperCase() + str.slice(1);
}