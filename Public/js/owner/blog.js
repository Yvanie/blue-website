$(function() {
    const Blog = document.querySelector('#blog-list');
    if(Blog){
    Getter(baseUrl+'/blogs/lireAll', (response)=>{
        response.data.forEach((blog)=>{
            Blog.innerHTML+=`<div class="blog-post">
            <img src="${blog.image}" alt="${blog.title}" class="blog-image" />
            <div class="post-date-author">
                <p class="author">${blog.authors}</p>
                <p class="date">${blog.createAt}</p>
            </div>
            <hr class="divider">
            <h2>${blog.title}</h2>
            <p class="blog-description limited-description">
               ${blog.content}
            </p>
            <div class="button-container">
                <a href="index.php?p=blogs&id=${blog.idBlogs}" class="btn">
                    <i class="fas fa-book-open"></i> Read More
                </a>
            </div>
        </div>`;
        });
    });}
    //nous allons recuperer l'id de l'article
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    if(id){
        Getter(baseUrl+'/blogs/lireOne/'+id, (response)=>{
            $('.sp-title').html(response.title);
            $('.sp-author').html(response.authors);
            $('.sp-image').attr('src', response.image);
            $('.sp-date').html(response.createAt);
            $('.sp-body').html(response.content);
    });

    }
    
});