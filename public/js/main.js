///////////////////handling themes and language////////////////
function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return null;
  }

//theme handling
if (!getCookie('theme')){
    document.cookie = "theme=light; Expires=Sat, 17 Aug 2222 17:30:08 UTC;";
}

if (getCookie('theme') === 'dark') {
    document.documentElement.dataset.bsTheme = 'dark';
    document.getElementById('light-toggler').style.display = 'block';
} else {
    document.documentElement.dataset.bsTheme = 'light';
    document.getElementById('dark-toggler').style.display = 'block';
}

document.getElementById('dark-toggler').onclick = () => {
    document.cookie = "theme=dark; Expires=Sat, 17 Aug 2222 17:30:08 UTC;";
    document.getElementById('dark-toggler').style.display = 'none';
    document.getElementById('light-toggler').style.display = 'block';
    document.documentElement.dataset.bsTheme = 'dark';
}

document.getElementById('light-toggler').onclick = () => {
    document.cookie = "theme=light; Expires=Sat, 17 Aug 2222 17:30:08 UTC;";
    document.documentElement.dataset.bsTheme = 'light';
    document.getElementById('light-toggler').style.display = 'none';
    document.getElementById('dark-toggler').style.display = 'block';
}

//lang handling
if (!getCookie('lang')){
  document.cookie = "lang=en; Expires=Sat, 17 Aug 2222 17:30:08 UTC;";
}

if (getCookie('lang') === 'ar') {
  document.documentElement.dir = 'rtl';
  // document.getElementById('light-toggler').style.display = 'block';
} else {
  document.documentElement.dir = 'ltr';
  // document.getElementById('dark-toggler').style.display = 'block';
}

document.getElementById('en-toggler').onclick = () => {
  document.cookie = "lang=en; Expires=Sat, 17 Aug 2222 17:30:08 UTC;";
  location.reload();
}

document.getElementById('ar-toggler').onclick = () => {
  document.cookie = "lang=ar; Expires=Sat, 17 Aug 2222 17:30:08 UTC;";
  location.reload();
}
////////////<<<<<<handling themes  and language>>>>>>///////////




function deleteCookies(name, id) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
    document.cookie = id + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
    location.replace(location.href.replace(/\/[^\/]*$/, '/login.php'));
}



///////////////////handling modals buttons////////////////
document.getElementById('products').onclick = function(e) {
  ///////////////////handling edit product modals button////////////////
  if(e.target.dataset.bsTarget === '#editProduct' || e.target.parentElement.dataset.bsTarget === '#editProduct') {
    const parentRow = e.target.parentElement.parentElement.parentElement;
    const modal = document.getElementById('editProduct');
    const productID = parentRow.querySelector('.productID').innerHTML.trim();
    const productName = parentRow.querySelector('.productName').innerHTML.trim();
    const category = parentRow.querySelector('.category').innerHTML.trim();
    const stock = parentRow.querySelector('.stock').innerHTML.trim();
    const price = parentRow.querySelector('.price').innerHTML.trim();
    const description = parentRow.querySelector('.description').innerHTML.trim();
    const currentProductImage = parentRow.querySelector('.productImage').src.trim().split('http://')[1];
        
    modal.querySelector('input[name=currentProductImage]').parentElement.querySelector('img').src = 'http://' + currentProductImage;
    modal.querySelector('input[name=currentProductImage]').value = currentProductImage;
    modal.querySelector('input[name=productID]').value = productID;
    modal.querySelector('input[name=productName]').value = productName;
    modal.querySelector('select[name=category]').value = category;
    modal.querySelector('input[name=stock]').value = stock;
    modal.querySelector('input[name=price]').value = price;
    modal.querySelector('textarea[name=description]').value = description;
    ////////////<<<<<<handling edit product modals button>>>>>>///////////

///////////////////handling delete product modals button////////////////
  } else if (e.target.dataset.bsTarget === '#deleteProduct' || e.target.parentElement.dataset.bsTarget === '#deleteProduct') {
    const parentRow = e.target.parentElement.parentElement.parentElement;
    const modal = document.getElementById('deleteProduct');
    const productID = parentRow.querySelector('.productID').innerHTML.trim();
    modal.querySelector('input[name=productID]').value = productID;
  }
////////////<<<<<<handling delete product modals button>>>>>>///////////
}
////////////<<<<<<handling modals buttons>>>>>>///////////

