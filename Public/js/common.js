const baseUrl = 'http://localhost:3500';
async function Poster(url, cb, objet){
    const response = await fetch(url, {
        method: 'POST',
        body: objet
    });
    const data= await response.json()
    cb(data);
}

async function Getter(url, cb){
    const response = await fetch(url);
    const data= await response.json()
    cb(data);
}

const Msg=function (type, message){
    type= (type=="error")? "danger":type;
    return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>`;
}
function decodeHTMLEntities(str) {
    if (str && typeof str === "string") {
      str = str
        .replace(/<script[^>]*>([\S\s]*?)<\/script>/gim, "")
        .replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gim, "");
      const element = document.createElement("div");
      element.innerHTML = str;
      str = element.textContent;
      element.textContent = "";
    }
    return str;
  }