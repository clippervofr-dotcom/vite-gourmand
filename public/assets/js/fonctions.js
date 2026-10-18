function echapperHTML(texte) {
    const div = document.createElement('div');
    div.textContent = texte ?? '';
    return div.innerHTML.replaceAll('"', '&quot;').replaceAll("'", '&#39;');
}

function formaterPrix(montant) {
    return Number(montant).toFixed(2);
}

function capitalizeFirstLetter(str) {
    if (str.length === 0) return str;
    if (!/[a-zA-Z]/.test(str.charAt(0))) return str;
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').content;
}

