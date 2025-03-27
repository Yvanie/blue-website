$(function() {

    const Blogs = document.querySelector('#blog-list');
    Getter(baseUrl+'/blogs/lireRecent', (response)=>{
        response.data.forEach((blog)=>{
            let dateCreate = new Date(blog.createAt);
            let action="";
            if(blog.createAt == blog.updateAt){
                dateCreate = new Date(blog.createAt);
                action += "créé le ";
                action+= dateCreate.getDate() + "/" + (dateCreate.getMonth() + 1) + "/" + dateCreate.getFullYear();
            }else{
                dateCreate = new Date(blog.updateAt);
                action += "mise à jour le ";
                action+= dateCreate.getDate() + "/" + (dateCreate.getMonth() + 1) + "/" + dateCreate.getFullYear();
            }
            Blogs.innerHTML+=`<div class="blog-post">
            <img src="${blog.image}" alt="${blog.title}" class="blog-image" />
            <div class="post-date-author">
                <p class="author">${blog.authors}</p>
                <p class="date">${action}</p>
            </div>
            <hr class="divider">
            <h2>${decodeHTMLEntities(blog.title)}</h2>
            <p class="blog-description limited-description">
               ${decodeHTMLEntities(blog.content)}
            </p>
            <div class="button-container">
                <a href="index.php?p=blogs&id=${blog.idBlogs}" class="btn">
                    <i class="fas fa-book-open"></i> Read More
                </a>
            </div>
        </div>`;
        })
    })
});