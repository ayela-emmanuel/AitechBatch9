




const grid = document.getElementById('grid');

get_products(1)
const NGN = new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN' });


async function renderProducts(products){
    console.log(products)
    for (let index = 0; index < products.length; index++) {
        const p = products[index];

        const price = NGN.format(Number(p.price || 0));
        const img = p.img;
        const qty = Number(p.qty ?? 0);
        const disabled = qty <= 0 ? 'disabled' : '';
        const badge = qty > 0 ? `<span class="badge badge-qty ms-2">${qty} in stock</span>` : `<span class="badge text-bg-warning ms-2">Out of stock</span>`;
        const shortDesc = (p.description || '').slice(0, 90) + ((p.description || '').length > 90 ? '…' : '');

        
        grid.innerHTML += `
        <div class="col">
            <div class="card h-100 shadow-sm">
              <img class="product-img" src="${img}" alt="${(p.name||'Product').replace(/"/g,'&quot;')}">
              <div class="card-body d-flex flex-column">
                <h6 class="card-title mb-1">${p.name || 'Product'}</h6>
                <div class="d-flex align-items-center mb-2">
                  <span class="fw-semibold">${price}</span>
                  ${badge}
                </div>
                <p class="card-text text-muted small flex-grow-1">${shortDesc}</p>
                <div class="d-flex gap-2">
                  <button class="btn btn-primary w-100" ${disabled} onclick="addToCart(${p.id ?? 0})">
                    <i class="bi bi-bag-plus"></i> Add to Cart
                  </button>
                  <a class="btn btn-outline-secondary" href="/product/${encodeURIComponent(p.id ?? '')}">
                    <i class="bi bi-eye"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        `;
    }

    
}





async function get_products(page = 1, search) {
    var result = await  fetch(`api/products.php?page=${page}`, {method:"GET"})
    .then(HandleResponse).then(d=>{renderProducts(d.data)});
}

async function  HandleResponse(res) {
    if(res.ok){
        return await  res.json();
    }else{
        data = await res.json();
        alert(data.message)
    }
}

function addToCart(pid){
        fetch(`api/addtocart.php?pid=${pid}`, {method:"GET"})
    .then(HandleResponse);
}