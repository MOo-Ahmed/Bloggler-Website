let showAllPostsBtn = document.getElementById('showAllPosts');
let timelineSection = document.querySelector('.timeline');

$(document).ready(function(){
    function fetchPostsFromDB(){
        $.ajax({
            url: 'processShowAllPosts.php',
            type: 'POST',
            data: { id: document.getElementById("session_id").value},
            success: function(data){
                var res = JSON.parse(data);
                showPosts(res);
            }
        });
    }

    function hideCurrentPosts (){
        var  c = document.querySelector('.timeline').children;
        var i;
        for (i = 0; i < c.length; i++) {
            c[i].style.display = "none";
        }
    }

    function showPosts(data){
        for (var i = 0 ; i < data.length; i++) {
            var  timelineSection = document.querySelector('.timeline');
            var tempPost = document.createElement("div");
            tempPost.classList.add('card', "mb-2");
            var postHeader = document.createElement("div");
            postHeader.className = 'card-header';
            var postBody = document.createElement("div");
            postBody.className = 'card-body';
            
            var content = document.createElement("p") ;
            content.className = "card-text" ;
            var username = document.createElement("h4");
            username.classList.add("card-title" , "text-muted") ;
            var date = document.createElement("div") ;
            date.classList.add("float-right" , "text-muted") ;
            username.innerHTML = data[i].Name ;
            date.innerHTML = data[i].PostDate ;
            content.innerHTML = data[i].Body ;
            postHeader.appendChild(username);
            postHeader.appendChild(date) ;
            postBody.appendChild(content);
            tempPost.appendChild(postHeader);
            tempPost.appendChild(postBody);
            timelineSection.appendChild(tempPost) ;
        }
    }

    fetchPostsFromDB();

    $(document).on('click', '#showAllPosts', function(){
        hideCurrentPosts();
        fetchPostsFromDB();
    });
});